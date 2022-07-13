<?php
// session_start();
// require_once("../config/koneksidb.php");
// require_once("../config/config.php");
// security_login();
?>
<?php
$qry_menu = mysqli_query($koneksidb, "SELECT * FROM mst_menu");
//foreach ($qry_menu as $l) :
while ($row = mysqli_fetch_array($qry_menu)) {
?>
<a href="?modul=<?= $row['link']; ?>" style="text-decoration: none;" class="links1">
	<li class="list-group-item links rounded-3 mt-1"><?= $row['icon']; ?></i> <?= $row["nm_menu"]; ?></li>
</a>
<?php
}
//endforeach;
?>