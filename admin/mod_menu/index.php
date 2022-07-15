<?php
include_once("menuCtrl.php");
if (!isset($_GET['action'])) {
?>
	<a href="?modul=mod_menu&action=add" class="btn btn-primary btn-xs mb-1">Tambah Data</a>
	<table class="table table-bordered">
		<tr>
			<th>Nama menu</th>
			<th>Link</th>
			<th>Icon</th>
			<th>Action</th>
		</tr>
		<?php
		$query = mysqli_query($koneksidb, "SELECT * FROM mst_menu");
		foreach ($query as $q) :
		?>
			<tr>
				<td><?= $q['nama_menu']; ?></td>
				<td><?= $q['link']; ?></td>
				<td><?= $q['icon']; ?></td>
				<td><a href="?modul=mod_menu&action=edit&id=<?= $q['id_menu']; ?>" class="btn btn-xs btn-primary"><i class="bi bi-pencil-square"></i> Edit</a>
					<a href="?modul=mod_menu&action=delete&id=<?= $q['id_menu']; ?>" class="btn btn-xs btn-danger"><i class="bi bi-trash"></i> Delete</a>
				</td>
			</tr>
		<?php
		endforeach;
		?>
	</table>
	<hr>
<?php } else if (isset($_GET['action']) && ($_GET['action'] == "add" || $_GET['action'] == "edit")) {
?>
<?php 
	if ($proses == "insert") {
	?>
		<form action="?modul=mod_menu&action=save" id="formmenu" method="POST">
			<div class="row pt-3">
				<label class="col-md-2">Nama Menu</label>
				<div class="col-md-5">
                    <input type="hidden" name="proses" value="<?= $proses;?>">
                    <input type="hidden" name="idmenu" value="<?= $$dt['id_menu '];?>">
					<input type="text" name="nmmenu" id="nmmenu" class="form-control">
				</div>
			</div>
			<div class="row pt-3">
				<label class="col-md-2">Link</label>
				<div class="col-md-5">
					<input type="text" name="link" id="link" class="form-control">
				</div>
			</div>
			<div class="row pt-3">
				<label class="col-md-2">Icon</label>
				<div class="col-md-5">
					<input type="text" name="icon" id="icon" class="form-control">
				</div>
			</div>
			<div class="row pt-3">
				<label class="col-md-2"></label>
				<div class="col-md-5">
					<button type="submit" class="btn btn-primary">Simpan</button>
					<a href="home.php?modul=mod_menu"><button type="button" class="btn btn-warning">Kembali</button></a>
				</div>
			</div>
		</form>
	<?php
	} else {
	?>
		<form action="?modul=mod_menu&action=save" method="POST">
			<?php
			$qry = mysqli_query($koneksidb, "select * from mst_menu where id_menu='$id' LIMIT 0,1");
			$dt = mysqli_fetch_array($qry);
			?>
			<div class="row pt-3">
				<label class="col-md-2">Nama Menu</label>
				<div class="col-md-5">
					<input type="hidden" name="proses" value="<?= $proses; ?>">
					<input type="hidden" name="idmenu" value="<?= $dt['id_menu']; ?>">
					<input type="text" class="form-control" name="nmmenu" value="<?= $dt['nama_menu']; ?>">
				</div>
			</div>
			<div class="row pt-3">
				<label class="col-md-2">Link</label>
				<div class="col-md-5">
					<input type="text" class="form-control" name="link" value="<?= $dt['link']; ?>">
				</div>
			</div>
			<div class="row pt-3">
				<label class="col-md-2">Icon</label>
				<div class="col-md-5">
					<input type="text" class="form-control" name="icon" value="<?= $dt['icon']; ?>">
				</div>
			</div>
			<div class="row pt-3">
				<label class="col-md-2"></label>
				<div class="col-md-5">
					<button type="submit" class="btn btn-primary">Simpan</button>
					<a href="home.php?modul=mod_menu"><button type="button" class="btn btn-warning">Kembali</button></a>
				</div>
			</div>
		</form>
	<?php
	}
	?>
<?php
}
?>