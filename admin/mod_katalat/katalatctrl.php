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
	$qry = mysqli_query($koneksidb,"select * from kategorialat where id_katalat='$ids'");
	$dt = mysqli_fetch_array($qry);
    // $id=$dt['id_studio'];
	$upidkatalat = $dt['id_katalat'];
	$upkode = $dt['kode_katalat'];
	$upnmkatalat = $dt['nm_katalat'];

	$proses = "update";
}
else if(isset($_GET['action']) && $_GET['action'] == "save"){
	$proses = $_POST['proses'];
if($proses=="insert"){
    $idkatalat = $_POST['idkatalat'];
	$nmkatalat = $_POST['nmkatalat'];
	$kdalat = $_POST['kodekatalat'];
        mysqli_query($koneksidb,"INSERT INTO kategorialat (kode_katalat,nm_katalat) values ('$kdalat','$nmkatalat')")or die(mysqli_error($koneksidb));
	    echo '<meta http-equiv="refresh" content="0; url='.ADMIN_URL.'?modul=mod_katalat">';
    }
    else if ($proses == "update") {
		$id = $_POST['idkatalat'];
		$nmmenu = $_POST['nmkatalat'];
		mysqli_query($koneksidb, "update kategorialat set nm_katalat='$nmmenu' where id_katalat = $id ") or die(mysqli_error($koneksidb));
		echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_katalat">';
    }
}else if(isset($_GET['action']) && $_GET['action'] == "delete"){
    $id=$_GET['id'];
    mysqli_query($koneksidb,"DELETE FROM kategorialat where id_katalat='$id'");
    echo '<meta http-equiv="refresh" content="0; url='.ADMIN_URL.'?modul=mod_katalat">';

}
function pesan($alert)
{
    echo '<script language="javascript">';
    echo 'alert("' . $alert . '")';  //not showing an alert box.
    echo '</script>';
    echo '<meta http-equiv="refresh" content="0; url='.ADMIN_URL.'?modul=mod_alat">';
}
?>