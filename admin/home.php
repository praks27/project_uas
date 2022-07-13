<?php
session_start();
require_once("../config/koneksi.php");
require_once("../config/config.php");
security_login();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Halaman Admin </title>
	<!-- link bootstrap -->
	<link href="../asset/boostrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../asset/styles.css" rel="stylesheet">
	<!-- link icon bootstrap -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
	<script src="https://cdn.tiny.cloud/1/ctai2l7ettpdz3uyphr0lz4x23v2z3otpascq7sk3miw64e3/tinymce/6/tinymce.min.js"
		referrerpolicy="origin"></script>
	<script>
	tinymce.init({
		selector: 'textarea#deskripsi',
		plugins: [
			'a11ychecker', 'advlist', 'advcode', 'advtable', 'autolink', 'checklist', 'export',
			'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks',
			'powerpaste', 'fullscreen', 'formatpainter', 'insertdatetime', 'media', 'table', 'help',
			'wordcount'
		],
		toolbar: 'undo redo | formatpainter casechange blocks | bold italic backcolor | ' +
			'alignleft aligncenter alignright alignjustify | ' +
			'bullist numlist checklist outdent indent | removeformat | a11ycheck code table help'
	});
	</script>

	<style>
	body {
		padding-top: 60px;
	}
	</style>
</head>

<body>
	<nav class="navbar fixed-top navbar-light bg-primary">
		<div class="container-fluid">
			<a class="navbar-brand text-white">Welcome,<?= $_SESSION['namauser']; ?> </a>
			<form class="d-flex">
				<!-- <input class="form-control me-2" type="text" readonly value="<?= $_SESSION['namauser']; ?>"> -->
				<a href="logout.php" class="btn btn-warning text-white"> Logout</a>
			</form>
		</div>
	</nav>

	<section class="mt-4">
		<div class="row">
			<div class="col-md-3">
				<div class="container">
					<div class="list-group">
						<!-- <a href="?modul=mod_menu" class="list-group-item list-group-item-action "> -->
						<!-- <i class="bi bi-person"></i> Menu -->
						<?php
						include_once("menu.php");
						?>
						<!-- </a> -->
					</div>
				</div>
			</div>
			<div class="col-lg-8">
				<div class="container">
					<br>
					<?php
					if (isset($_GET['modul'])) {
						include_once $_GET['modul'] . "/index.php";
					}
					else{
						// include_once "dashboard.php";
					}
					?>
				</div>
			</div>
		</div>
	</section>

	<!-- Letakkan script JS disini -->
	<script src="../asset/boostrap/js/bootstrap.bundle.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../asset/userlogin.js"></script>
    <script src="../asset/alat.js"></script>
</body>

</html>