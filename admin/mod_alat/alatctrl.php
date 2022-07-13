<?php 
security_login();

if(!isset($_GET['action'])){
	$data_alat = mysqli_query($koneksidb,"select * from mst_alatsewa");
	//untuk contoh generate kode		
}
else if(isset($_GET['action']) && $_GET['action'] == "add"){
	$proses = "insert";
}
else if(isset($_GET['action']) && $_GET['action'] == "edit"){
    $ids=$_GET['id'];
	$qry = mysqli_query($koneksidb,"select * from mst_alatsewa where id_alat='$ids'");
	$dt = mysqli_fetch_array($qry);
    $id=$dt['id_alat'];
	$upidalat = $dt['id_alat'];
	$upkode = $dt['kode_alat'];
	$upnmalat = $dt['nm_alat'];
	// $upkatalat = $dt['id_katalat'];
	$upstock = $dt['stock'];
	$upharga = $dt['hrg_alat'];

	    $proses = "update";
}
else if(isset($_GET['action']) && $_GET['action'] == "save"){
	$proses = $_POST['proses'];
if($proses=="insert"){
    $idalat = $_POST['idalat'];
	$nmalat = $_POST['nmalat'];
	$kda = $_POST['kodealat'];
	$katalat = $_POST['katalat'];
	$stock = $_POST['stock'];
	$hrgsewa = $_POST['hargasewa'];
    $file = $_FILES['img'];
		$target_dir = "../asset/img/";
		$target_file =  $target_dir.basename($file['name']);
		$type_file = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
		// echo $type_file."<br/>";
		$is_upload = 1;
		/* cek batas limit file maks.3MB*/
		if($file['size'] > 2000000){
			$is_upload = 0;
			pesan("File lebih dari 2MB!!");		
		}
		/**cek tipe file */
		if($type_file != "jpg" && $type_file != "png" ){
			$is_upload = 0;
			pesan("hanya tipe file jpg yang diperbolehkan!!");	
		}
		$namafile = "";
		/**proses upload */
		if($is_upload == 1){
			if(move_uploaded_file($file['tmp_name'], $target_file)){
				$namafile = $file['name'];
                mysqli_query($koneksidb,"INSERT INTO mst_alatsewa (kode_alat,nm_alat,id_katalat,stock,hrg_alat,gambar) values ('$kda','$nmalat','$katalat','$stock','$hrgsewa','$namafile')")or die(mysqli_error($koneksidb));
	            echo '<meta http-equiv="refresh" content="0; url='.ADMIN_URL.'?modul=mod_alat">';
             
            }
			else if($is_upload == 0){
				pesan("GAGAL upload file gambar!!");
			}
        }
    }
	else if($proses == "update"){
        if ($_FILES['img']['name'] == "") {
            $id = $_POST['idalat'];
            $nmalat = $_POST['nmalat'];
            $stock = $_POST['stock'];
            $hargasewa = $_POST['hargasewa'];
            $katalat = $_POST['katalat'];
            $namafile = $_POST['gambarlama'];
            mysqli_query($koneksidb, "UPDATE mst_alatsewa SET nm_alat='$nmalat',stock='$stock',hrg_alat='$hargasewa',id_katalat='$katalat',gambar='$namafile' WHERE id_alat = '$id' ") or die(mysqli_error($koneksidb));
            echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_alat">';
        } else {
            $file = $_FILES['img'];
            $target_dir = "../asset/img/";
            $target_file =  $target_dir . basename($file['name']);
            $type_file = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
            // echo $type_file . "<br/>";
            $is_upload = 1;
            /* cek batas limit file maks.3MB*/
            if ($file['size'] > 3000000) {
                $is_upload = 0;
                pesan("File lebih dari 3MB!!");
            }
            /**cek tipe file */
            if ($type_file != "jpg" && $type_file != "png") {
                $is_upload = 0;
                pesan("hanya tipe file jpg/png yang diperbolehkan!!");
            }
            $namafile = "";
            /**proses upload */
            if ($is_upload == 1) {
                if (move_uploaded_file($file['tmp_name'], $target_file)) {
                    $namafile = $file['name'];
                    $id = $_POST['idalat'];
                    $nmalat = $_POST['nmalat'];
                    $stock = $_POST['stock'];
                    $hargasewa = $_POST['hargasewa'];
                    $katalat = $_POST['katalat'];
                    if ($namafile == $_POST['gambarlama']) {
                        $edit = mysqli_query($koneksidb, "UPDATE mst_alatsewa SET nm_alat='$nmalat',stock='$stock',hrg_alat='$hargasewa',id_katalat='$katalat',gambar='$namafile' WHERE id_alat = '$id' ") or die(mysqli_error($koneksidb));
                    } else {
                        $old = $_POST['gambarlama'];
                        $edit = mysqli_query($koneksidb, "UPDATE mst_alatsewa SET nm_alat='$nmalat',stock='$stock',hrg_alat='$hargasewa',id_katalat='$katalat',gambar='$namafile' WHERE id_alat = '$id' ") or die(mysqli_error($koneksidb));
                        unlink("../asset/img/$old");
                    }
                    echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_alat">';
                } else {
                    pesan("GAGAL upload file gambar!!");
                }
            }
        }
    }
	
}else if(isset($_GET['action']) && $_GET['action'] == "delete"){
    $id=$_GET['id'];
    $qalat = mysqli_query($koneksidb,"SELECT gambar FROM mst_alatsewa WHERE id_alat='$id'");
    $qa = mysqli_fetch_array($qalat);
    $gambar=$qa['gambar'];
    mysqli_query($koneksidb,"DELETE FROM mst_alatsewa where id_alat='$id'");
    unlink("../asset/img/$gambar");
    echo '<meta http-equiv="refresh" content="0; url='.ADMIN_URL.'?modul=mod_alat">';

}
function pesan($alert)
{
    echo '<script language="javascript">';
    echo 'alert("' . $alert . '")';  //not showing an alert box.
    echo '</script>';
    echo '<meta http-equiv="refresh" content="0; url='.ADMIN_URL.'?modul=mod_alat">';
}
?>