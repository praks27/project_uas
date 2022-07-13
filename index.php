<?php 
    require_once ("config/config.php");
    require_once ("config/koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>HOMIE MUSIC</title>
	<link href="asset/boostrap/css/bootstrap.min.css" rel="stylesheet" />
	<script src="asset/boostrap/js/bootstrap.bundle.min.js"></script>
	<link rel="stylesheet" href="asset/styles.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>

<body>
	<!-- navbar -->
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="color: white !important">
		<div class="container pe-5 ps-5">
			<ul class="navbar-nav ms-auto mb-2 mb-lg-0 fontnav text-white">
				<li class="nav-item">
					<a href="index.php" class="nav-link">HOMIE</a>
				</li>
				<li class="nav-item">
					<a href="?page=halamanProduk" class="nav-link">PRODUCT</a>
				</li>
			</ul>

			<div class="collapse navbar-collapse text-white" id="navbarSupportedContent">
				<ul class="navbar-nav ms-auto mb-2 mb-lg-0 fontnav">
					<li class="nav-item">
						<a class="nav-link" href="?page=daftarmember">Daftar Member</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
	<!-- header banner -->
	<section id="header">
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="asset/img/band-performing-studio.jpg" class="d-block w-100 " height="400vh">
                <div class="carousel-caption d-none d-md-block">
                    <h3 class="subtitle1">HOMIE MUSIC</h3>
                    <p class="subtitle2">Studio music & penyewaan alat music</p>
                </div>
            </div>
        </div>
</div>
	</section>
	<!-- konten -->
	<section id="konten ">
		<?php 
			if(isset($_GET['page'])){
				include_once("".$_GET['page'].".php");
			}
			else{
				include_once("home.php");
			}
		 ?>
	</section>
	<!-- footer -->
	<section id="footer" class="bg-dark text-white">
		<div class="container pt-4">
			<div class="row">
				<div class="col-md-4">
					<address class="fw-bold mb-0">HOMIE MUSIC :</address>
					<p class="mb-0">Jalan Merdeka No.101 , Manyar Surabaya</p>
					<p>WA : 081-3393-64971</p>
				</div>
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<address class="fw-bold">Follow us :</address>
					<p>
						<span class="pe-3 "><i class="bi bi-instagram"></i> @homiemusic</span>
						<span class="pe-3"><i class="bi bi-facebook"></i> homiemusicbest</span>
					</p>
				</div>
			</div>
		</div>
	</section>
	<!-- modal -->
	<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<form class="bg-light p-5" action="ceklogin.php" method="POST">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Form Login</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div class="mb-4">
							<label for="username" class="form-label">Username</label>
							<input type="text" name="username" class="form-control" id="logusername" />
						</div>
						<div class="mb-4">
							<label for="password" class="form-label">Password</label>
							<input type="password" name="password" class="form-control" id="logpassword" />
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" id="btnbatal" class="btn btn-secondary"
							data-bs-dismiss="modal">Batal</button>
						<button type="submit" name="btnlogin" id="btnkeluar" class="btn btn-primary">Login</button>
					</div>
					<div class="row mb-3">
						<div class="col-md-5 text-end">
							<a href="?page=lupapassword" class="btn btn-primary">Lupa Password?</a>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>

	<!-- js -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="asset/daftar.js"></script>
    
</body>

</html>