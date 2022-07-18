<?php 
security_login();

if(!isset($_GET['action'])){
	$data_alat = mysqli_query($koneksidb,"select * from mst_studio");
	//untuk contoh generate kode		
}
else if(isset($_GET['action']) && $_GET['action'] == "add"){
	$proses = "insert";
}
else if(isset($_GET['action']) && $_GET['action'] == "edit"){
    $ids=$_GET['id'];
	$qry = mysqli_query($koneksidb,"select * from mst_studio where id_studio='$ids'");
	$dt = mysqli_fetch_array($qry);
    // $id=$dt['id_studio'];
	$upidstudio = $dt['id_studio'];
	$upkode = $dt['kode_studio'];
	$upnmstudio = $dt['nm_studio'];
	// $upkatalat = $dt['id_katalat'];
	$upjmlstudio = $dt['jml_studio'];
	$upharga = $dt['hrg_sewastudio'];
	$proses = "update";
}
else if(isset($_GET['action']) && $_GET['action'] == "save"){
	$proses = $_POST['proses'];
if($proses=="insert"){
    $idstudio = $_POST['idstudio'];
	$nmstudio = $_POST['nmstudio'];
	$kds = $_POST['kodestudio'];
	$katstudio = $_POST['katstudio'];
	$jmlstudio = $_POST['jmlstudio'];
	$hrgsewa = $_POST['hargasewa'];
	$desk = $_POST['deskripsi'];
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
                mysqli_query($koneksidb,"INSERT INTO mst_studio (kode_studio,nm_studio,id_katstudio,jml_studio,hrg_sewastudio,deskripsi,gambar) values ('$kds','$nmstudio','$katstudio','$jmlstudio','$hrgsewa','$desk','$namafile')")or die(mysqli_error($koneksidb));
	            echo '<meta http-equiv="refresh" content="0; url='.ADMIN_URL.'?modul=mod_studio">';
             
            }
			else if($is_upload == 0){
				pesan("GAGAL upload file gambar!!");
			}
        }
    }
	else if($proses == "update"){
        $file = $_FILES['img'];
        if ($_FILES['img']['name'] == "") {
            $id = $_POST['idstudio'];
            $nmstudio = $_POST['nmstudio'];
            $jmlstudio = $_POST['jmlstudio'];
            $hargasewa = $_POST['hargasewa'];
            $katstudio = $_POST['katstudio'];
            $namafile = $_POST['gambarlama'];
            $desk = $_POST['deskripsi'];
            mysqli_query($koneksidb, "UPDATE mst_studio SET nm_studio='$nmstudio',jml_studio='$jmlstudio',hrg_sewastudio='$hargasewa',id_katstudio='$katstudio',deskripsi='$desk',gambar='$namafile' WHERE id_studio = '$id' ") or die(mysqli_error($koneksidb));
            echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_studio">';
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
                    $id = $_POST['idstudio'];
                    $nmstudio = $_POST['nmstudio'];
                    $jmlstudio = $_POST['jmlstudio'];
                    $hargasewa = $_POST['hargasewa'];
                    $katstudio = $_POST['katstudio'];
                    $desk = $_POST['deskripsi'];
                    if ($namafile == $_POST['gambarlama']) {
                        $edit = mysqli_query($koneksidb, "UPDATE mst_studio SET nm_studio='$nmstudio',jml_studio='$jmlstudio',hrg_sewastudio='$hargasewa',id_katstudio='$katstudio',deskripsi='$desk',gambar='$namafile' WHERE id_studio = '$id' ") or die(mysqli_error($koneksidb));
                    } else {
                        $old = $_POST['gambarlama'];
                        $edit = mysqli_query($koneksidb, "UPDATE mst_studio SET nm_studio='$nmstudio',jml_studio='$jmlstudio',hrg_sewastudio='$hargasewa',id_katstudio='$katstudio',deskripsi='$desk',gambar='$namafile' WHERE id_studio = '$id' ") or die(mysqli_error($koneksidb));
                        unlink("../asset/img/$old");
                    }
                    echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_studio">';
                } else {
                    pesan("GAGAL upload file gambar!!");
                }
            }
        }
    }
	
}else if(isset($_GET['action']) && $_GET['action'] == "delete"){
    $id=$_GET['id'];
    $qalat = mysqli_query($koneksidb,"SELECT gambar FROM mst_studio WHERE id_studio='$id'");
    $qa = mysqli_fetch_array($qalat);
    $gambar=$qa['gambar'];
    mysqli_query($koneksidb,"DELETE FROM mst_studio where id_studio='$id'");
    unlink("../asset/img/$gambar");
    echo '<meta http-equiv="refresh" content="0; url='.ADMIN_URL.'?modul=mod_studio">';

}
function pesan($alert)
{
    echo '<script language="javascript">';
    echo 'alert("' . $alert . '")';  //not showing an alert box.
    echo '</script>';
    echo '<meta http-equiv="refresh" content="0; url='.ADMIN_URL.'?modul=mod_studio">';
}
?>