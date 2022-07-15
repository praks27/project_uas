<?php 
security_login();

if(!isset($_GET['action'])){
	$data_alat = mysqli_query($koneksidb,"select * from kategoristudio");
	//untuk contoh generate kode		
}
else if(isset($_GET['action']) && $_GET['action'] == "add"){
	$proses = "insert";
}
else if(isset($_GET['action']) && $_GET['action'] == "edit"){
    $ids=$_GET['id'];
	$qry = mysqli_query($koneksidb,"select * from kategoristudio where id_katstudio='$ids'");
	$dt = mysqli_fetch_array($qry);
    // $id=$dt['id_studio'];
	$upidkatalat = $dt['id_katstudio'];
	$upkode = $dt['kode_katstudio'];
	$upnmkatstudio = $dt['jenis_studio'];

	$proses = "update";
}
else if(isset($_GET['action']) && $_GET['action'] == "save"){
	$proses = $_POST['proses'];
if($proses=="insert"){
    $idkatstudio = $_POST['idkatstudio'];
	$jenis = $_POST['jenisstudio'];
	$kdstudio = $_POST['kodekatstudio'];
        mysqli_query($koneksidb,"INSERT INTO kategoristudio (kode_katstudio,jenis_studio) values ('$kdstudio','$jenis')")or die(mysqli_error($koneksidb));
	    echo '<meta http-equiv="refresh" content="0; url='.ADMIN_URL.'?modul=mod_katstudio">';
    }
    else if ($proses == "update") {
		$id = $_POST['idkatstudio'];
		$jenis = $_POST['jenisstudio'];
		mysqli_query($koneksidb, "update kategoristudio set jenis_studio='$jenis' where id_katstudio = $id ") or die(mysqli_error($koneksidb));
		echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_katstudio">';
    }
}else if(isset($_GET['action']) && $_GET['action'] == "delete"){
    $id=$_GET['id'];
    mysqli_query($koneksidb,"DELETE FROM kategoristudio where id_katstudio='$id'");
    echo '<meta http-equiv="refresh" content="0; url='.ADMIN_URL.'?modul=mod_katstudio">';

}
function pesan($alert)
{
    echo '<script language="javascript">';
    echo 'alert("' . $alert . '")';  //not showing an alert box.
    echo '</script>';
    echo '<meta http-equiv="refresh" content="0; url='.ADMIN_URL.'?modul=mod_katstudio">';
}
?>