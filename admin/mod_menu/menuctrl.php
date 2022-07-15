<?php
security_login();

if (!isset($_GET['action'])) {
	$data_menu = mysqli_query($koneksidb, "select * from mst_menu ");
	// $data_produk = mysqli_query($koneksidb, "select * from mst_produk ");
} else if (isset($_GET['action']) && $_GET['action'] == "add") {
	$nmmenu = "";
	$proses = "insert";
	$idmenu = 0;
} else if (isset($_GET['action']) && $_GET['action'] == "edit") {
	$idq = $_GET['id'];
	$qry = mysqli_query($koneksidb, "select * from mst_menu where id_menu='$idq'");
	$dt = mysqli_fetch_array($qry);
	$id = $dt['id_menu'];
	$nmmenu = $dt['nama_menu'];
	$link = $dt['link'];
	$icon = $dt['icon'];
	$proses = "update";
} else if (isset($_GET['action']) && $_GET['action'] == "save") {
	$proses = $_POST['proses'];
	if ($proses == "insert") {
		$nmmenu = $_POST['nmmenu'];
		$link = $_POST['link'];
		$icon = $_POST['icon'];
		mysqli_query($koneksidb, "insert into mst_menu(nama_menu,link,icon)values('$nmmenu','$link','$icon')") or die(mysqli_error($koneksidb));
		echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_menu">';
	} else if ($proses == "update") {
		$id = $_POST['idmenu'];
		$nmmenu = $_POST['nmmenu'];
		$link = $_POST['link'];
		$icon = $_POST['icon'];
		mysqli_query($koneksidb, "update mst_menu set nama_menu='$nmmenu', link='$link', icon='$icon' where id_menu = $id ") or die(mysqli_error($koneksidb));
		echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_menu">';
	}
}else if(isset($_GET['action']) && ($_GET['action'])=="delete"){
    $id=$_GET['id'];
    mysqli_query($koneksidb,"DELETE FROM mst_menu WHERE id_menu='$id'");
    echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_menu">';

}
