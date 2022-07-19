<!-- lupa passwordCtrl -->
<?php
session_start();
	if(isset($_POST['oke'])){
		$txt_user = $_POST['txtnnama'];
		$txt_pass = md5($_POST['txtnpass']);
		$datein = date('Y-m-d');
		$quser = mysqli_query($koneksidb, "SELECT u.username FROM mst_user u WHERE u.username LIKE '".$_POST['txtnnama']."' ");
		$row = mysqli_fetch_array($quser);
			if($txt_user != $row['username']){
				$_SESSION["ckuser"] = "gagal";
				header("Location: index.php?page=lupapassword");
        	} else{
				$qinsert = mysqli_query($koneksidb, "INSERT INTO tst_request (username, password_baru, tgl_request) 
				VALUES ('$txt_user', '$txt_pass', '$datein')")or die(mysqli_error($koneksidb));
					header("Location: index.php?page=home");
					if($qinsert){
						mysqli_query($koneksidb,"UPDATE mst_user SET password='$txt_pass' WHERE username='$txt_user'") or die(mysqli_error($koneksidb));
					}
			} ;
	}
?>
<!-- form lupa password -->
<?php
if(!isset($_GET['action'])){
?>
<div class="container pb-5">
	<div class="row">
		<div class="col-md-1 pt-4"></div>
		<div class="col-md-10 pt-4">
			<div class="subkategori p-3" id="">
				<h5 class="text-center pb-2"><b>Form Lupa Password</b></h5>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-10">
						<form action="#" id="formlupa" method="post">
						<div class="row pb-1">
							<label for="txtnama" class="col-md-3">Username</label>
							<div class="col-md-6">
								<input type="text" name="txtnnama" id="txtnnama" class="form-control"/>
							</div>
						</div>
						<div class="row pb-1">
							<label for="txtpass" class="col-md-3">Password Baru</label>
							<div class="col-md-6">
								<input type="Password" name="txtnpass" id="txtnpass" class="form-control" />
							</div>
						</div>
						<div class="row"> 
							<div class="col-md-3"></div>
							<div class="col-md-6">
							<?php
								if(isset($_SESSION['ckuser'])):
							?>
								<div id="liveAlertPlaceholder">Username Belum Terdaftar, Silahkan Daftar Dulu</div>
							<?php 
								endif;
							?>
								<button type="button" name="txtkonfirm" id="txtkonfirm" class="btn btn-warning form-control" data-bs-toggle="modal">
 							 		Request
								</button>
							</div>
						</div>
						<!-- form modal -->
						<div class="modal fade" id="konfirmasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
							<div class="modal-dialog">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="staticBackdropLabel">Form Lupa Password</h5>
							        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							      </div>
							      <div class="modal-body">
							        Apa anda yakin ingin melanjutkan?
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
							        <button type="submit" name="oke" class="btn btn-warning">Yes</button>
							      </div>
							    </div>
							  </div>
							</div>
						</form>
					</div>
				</div>
			</div>
            </div>
        </div>
</div>
<?php }?>