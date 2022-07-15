<?php
// session_start();
// require_once("../config/koneksidb.php");
// require_once("../config/config.php");
// security_login();
?>
<?php
$iduser = $_SESSION['iduser'];
$qry_menuakses = mysqli_query($koneksidb, "SELECT a.*,b.*,c.* FROM hakakses_menu a INNER JOIN mst_user b ON a.id_user=b.id_user INNER JOIN mst_menu c ON c.id_menu=a.id_menu WHERE a.id_user='$iduser'");

while ($row = mysqli_fetch_array($qry_menuakses)) {
?>
<a href="?modul=<?= $row['link']; ?>" style="text-decoration: none;" class="links1">
	<li class="list-group-item links rounded-3 mt-1"><?= $row['icon']; ?></i> <?= $row["nama_menu"]; ?></li>
</a>
<?php
}
//endforeach;
?>