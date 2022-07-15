<?php
include_once("katalatctrl.php");
if (!isset($_GET['action'])) {
?>
    <h3 class="fontheader">DATA STUDIO MUSIC</h3>
	<a href="?modul=mod_katalat&action=add" class="btn btn-primary btn-xs mb-1">Tambah Data</a>
	<table class="table table-bordered">
		<tr>
			<th>Kode Kategori Alat</th>
			<th>Nama Kategori Alat</th>
			<th>Action</th>
		</tr>
		<?php
        $listkatalat=mysqli_query($koneksidb,"SELECT * from kategorialat ");
		while ($list = mysqli_fetch_array($listkatalat)) {
		?>
        <tr>

            <td><?=$list['kode_katalat']; ?></td>
            <td><?=$list['nm_katalat']; ?></td>
            <td> 
                <a href="?modul=mod_katalat&action=edit&id=<?=$list['id_katalat']; ?>" class="btn btn-primary">
                        <i class="bi bi-pencil-square"></i>edit</a>
                <a href="?modul=mod_katalat&action=delete&id=<?=$list['id_katalat']; ?>" class="btn btn-danger">
                        <i class="bi bi-trash"></i>delete</a>
            </td>
        </tr>
        <?php } ?>
	</table>
	<?php } else if (isset($_GET['action']) && ($_GET['action'] == "add" || $_GET['action'] == "edit")) {
                $query_cekkode = mysqli_query($koneksidb,
                "select kode_katalat from kategorialat ORDER BY kode_katalat DESC LIMIT 0,1");
                   $cekkode = mysqli_fetch_array($query_cekkode);
                   if(mysqli_num_rows($query_cekkode) == 0 ){
                    $kodeakhir="KAL";
                }else{
                    $kodeakhir=$cekkode['kode_katalat'];  
                }
                $no_urutakhir = substr($kodeakhir,7);
                $th_akhir = substr($kodeakhir,3,4);
                $th_sekarang = date("Y");
        
            if($th_akhir == $th_sekarang){
                if ($no_urutakhir ==0||$no_urutakhir < 9) {
                    $nourut_baru = "00" . ($no_urutakhir + 1);
                } else if ($no_urutakhir >9) {
                    $nourut_baru = "0" . ($no_urutakhir + 1);
                } else if ($no_urutakhir < 100) {
                    $nourut_baru = "0" . ($no_urutakhir + 1);
                } else {
                    $nourut_baru = ($no_urutakhir + 1);
                }
                // echo "kodenya:" . $nourut_baru . "<br>";
            } else {
                $nourut_baru =  "001";
            }
            $kodeterbaru = "KAL".$th_sekarang . $nourut_baru;
               $qrykategorialat=mysqli_query($koneksidb,"SELECT * FROM kategorialat");
        if($proses=="insert"){
    ?>
	<form action="?modul=mod_katalat&action=save" id="formkatalat" method="POST" enctype="multipart/form-data">
        <div class="row mb-1">
			<label class="col-md-3">Kode Kategori Alat</label>
				<div class="col-md-5">
                    <input type="hidden" name="proses" value="<?= $proses; ?>">
                    <input type="hidden" name="idkatalat" value="<?= $upidkatalat; ?>">
					<input type="text" name="kodekatalat" id="kodekatalat" class="form-control" value="<?= $kodeterbaru; ?>" readonly>
				</div>
			</div>
        <div class="row mb-1">
			<label class="col-md-3">Nama Kategori Alat</label>
			<div class="col-md-5">
				<input type="text" name="nmkatalat" id="nmkatalat" class="form-control" >
			</div>
		</div>
        <div class="row pt-3">
                <label class="col-md-3"></label>
                <div class="col-md-5">
                    <button type="button" id="btnsubmit" class="btn btn-primary" data-bs-toggle="modal">Simpan</button>
                    <a href="home.php?modul=mod_katalat"><button type="button" class="btn btn-warning">Kembali</button></a>
                </div>
            </div>
	</form>
<?php }else{ ?>
    <form action="?modul=mod_katalat&action=save" id="formkatalat" method="POST" enctype="multipart/form-data">
        <?php if($proses=="update"){ ?>
        <div class="row mb-1">
			<label class="col-md-3">Kode Alat</label>
			<div class="col-md-5">
            <input type="hidden" name="proses" value="<?= $proses; ?>">
            <input type="hidden" name="idkatalat" value="<?= $upidkatalat; ?>">
				<input type="text" name="kodekatalat" id="kodekatalat" class="form-control" value="<?= $upkode;?>" readonly>
			</div>
		</div>
        <?php } ?>
		<div class="row mb-1">
			<label class="col-md-3">Nama Kategori Alat</label>
			<div class="col-md-5">
				<input type="text" name="nmkatalat" id="nmkatalat" class="form-control" value="<?= $upnmkatalat;?>">
			</div>
		</div>
        <div class="row pt-3">
                <label class="col-md-3"></label>
                <div class="col-md-5">
                    <button type="button" name="btnsubmit" id="btnsubmit" class="btn btn-primary">Simpan</button>
                    <a href="home.php?modul=mod_katalat"><button type="button" class="btn btn-warning">Kembali</button></a>
                </div>
            </div>
	</form>
<?php } ?>
<!--modal -->
<div class="modal fade" id="btnkonfirm" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                apakah anda yakin ingin menyimpan?
            </div>
            <div class="modal-footer">
                <button type="button" name="btnbatal" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" name="btnsimpan" id="btnsimpan" class="btn btn-primary">Simpan</button>
            </div>
            </div>
        </div>
        </div>
<?php } ?>
