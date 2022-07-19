<?php
include_once("katstudioctrl.php");
if (!isset($_GET['action'])) {
?>
    <h3 class="fontheader">DATA STUDIO MUSIC</h3>
	<a href="?modul=mod_katstudio&action=add" class="btn btn-success btn-xs mb-1">Tambah Data</a>
	<table class="table table-bordered">
		<tr>
			<th>Kode Kategori studio</th>
			<th>Jenis Studio</th>
			<th>Action</th>
		</tr>
		<?php
        $listkatstudio=mysqli_query($koneksidb,"SELECT * from kategoristudio ");
		while ($list = mysqli_fetch_array($listkatstudio)) {
		?>
        <tr>

            <td><?=$list['kode_katstudio']; ?></td>
            <td><?=$list['jenis_studio']; ?></td>
            <td> 
                <a href="?modul=mod_katstudio&action=edit&id=<?=$list['id_katstudio']; ?>" class="btn btn-success">
                        <i class="bi bi-pencil-square"></i> edit</a>
                <a href="?modul=mod_katstudio&action=delete&id=<?=$list['id_katstudio']; ?>" class="btn btn-warning">
                        <i class="bi bi-trash"></i> delete</a>
            </td>
        </tr>
        <?php } ?>
	</table>
	<?php } else if (isset($_GET['action']) && ($_GET['action'] == "add" || $_GET['action'] == "edit")) {
                $query_cekkode = mysqli_query($koneksidb,
                "select kode_katstudio from kategoristudio ORDER BY kode_katstudio DESC LIMIT 0,1");
                   $cekkode = mysqli_fetch_array($query_cekkode);
                   if(mysqli_num_rows($query_cekkode) == 0 ){
                    $kodeakhir="KST";
                }else{
                    $kodeakhir=$cekkode['kode_katstudio'];  
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
            $kodeterbaru = "KST".$th_sekarang . $nourut_baru;
               $qrykategoristudio=mysqli_query($koneksidb,"SELECT * FROM kategoristudio");
        if($proses=="insert"){
    ?>
	<form action="?modul=mod_katstudio&action=save" id="formkatstudio" method="POST" enctype="multipart/form-data">
        <div class="row mb-1">
			<label class="col-md-3">Kode Kategori Studio</label>
				<div class="col-md-5">
                    <input type="hidden" name="proses" value="<?= $proses; ?>">
                    <input type="hidden" name="idkatstudio" value="<?= $upidkatstudio; ?>">
					<input type="text" name="kodekatstudio" id="kodekatstudio" class="form-control" value="<?= $kodeterbaru; ?>" readonly>
				</div>
			</div>
        <div class="row mb-1">
			<label class="col-md-3">Nama Kategori Studio</label>
			<div class="col-md-5">
				<input type="text" name="jenisstudio" id="jenisstudio" class="form-control" >
			</div>
		</div>
        <div class="row pt-3">
                <label class="col-md-3"></label>
                <div class="col-md-5">
                    <button type="button" id="btnsubmit" class="btn btn-primary" data-bs-toggle="modal">Simpan</button>
                    <a href="home.php?modul=mod_katstudio"><button type="button" class="btn btn-warning">Kembali</button></a>
                </div>
            </div>
	</form>
<?php }else{ ?>
    <form action="?modul=mod_katalat&action=save" id="formkatstudio" method="POST" enctype="multipart/form-data">
        <?php if($proses=="update"){ ?>
        <div class="row mb-1">
			<label class="col-md-3">Kode Alat</label>
			<div class="col-md-5">
            <input type="hidden" name="proses" value="<?= $proses; ?>">
            <input type="hidden" name="idkatstudio" value="<?= $upidkatalat; ?>">
				<input type="text" name="kodekatstudio" id="kodekatstudio" class="form-control" value="<?= $upkode;?>" readonly>
			</div>
		</div>
        <?php } ?>
		<div class="row mb-1">
			<label class="col-md-3">Nama Kategori Alat</label>
			<div class="col-md-5">
				<input type="text" namesuccessstudio" idsuccessstudio" class="form-control" value="<?= $upnmkatstudio;?>">
			</div>
		</div>
        <div class="row pt-3">
                <label class="col-md-3"></label>
                <div class="col-md-5">
                    <button type="button" name="btnsubmit" id="btnsubmit" class="btn btn-primary">Simpan</button>
                    <a href="home.php?modul=mod_katstudio"><button type="button" class="btn btn-warning">Kembali</button></a>
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
