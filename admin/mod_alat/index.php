<?php
include_once("alatctrl.php");
if (!isset($_GET['action'])) {
?>
    <h3 class="fontheader">DATA ALAT MUSIC</h3>
	<a href="?modul=mod_alat&action=add" class="btn btn-success btn-xs mb-1">Tambah Data</a>
	<table class="table table-bordered">
		<tr>
			<th>foto</th>
			<th>kode alat</th>
			<th>nama alat</th>
			<th>kategori alat</th>
			<th>stock</th>
			<th>harga alat</th>
			<th>Action</th>
		</tr>
		<?php
        $listmhs=mysqli_query($koneksidb,"SELECT  a.*,ka.nm_katalat from mst_alatsewa a INNER JOIN kategorialat ka ON a.id_katalat=ka.id_katalat");
		while ($list = mysqli_fetch_array($listmhs)) {
		?>
        <tr>
            <td><img src="../asset/img/<?=$list['gambar']; ?>" width="200px"></td>
            <td><?=$list['kode_alat']; ?></td>
            <td><?=$list['nm_alat']; ?></td>
            <td><?=$list['nm_katalat']; ?></td>
            <td><?=$list['stock']; ?></td>
            <td><?=$list['hrg_alat']; ?></td>
            <td> 
                <a href="?modul=mod_alat&action=edit&id=<?=$list['id_alat']; ?>" class="btn btn-success mb-1">
                        <i class="bi bi-pencil-square"></i> edit</a>
                <a href="?modul=mod_alat&action=delete&id=<?=$list['id_alat']; ?>" class="btn btn-danger">
                        <i class="bi bi-trash"></i> delete</a>
            </td>
        </tr>
        <?php } ?>
	</table>
	<?php } else if (isset($_GET['action']) && ($_GET['action'] == "add" || $_GET['action'] == "edit")) {
                $query_cekkode = mysqli_query($koneksidb,
                "select kode_alat from mst_alatsewa ORDER BY kode_alat DESC LIMIT 0,1");
                   $cekkode = mysqli_fetch_array($query_cekkode);
                   if(mysqli_num_rows($query_cekkode) == 0 ){
                    $kodeakhir="AS";
                }else{
                    $kodeakhir=$cekkode['kode_alat'];  
                }
                $no_urutakhir = substr($kodeakhir,6);
                $th_akhir = substr($kodeakhir,2,4);
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
            $kodeterbaru = "AS".$th_sekarang . $nourut_baru;
               $qrykategorialat=mysqli_query($koneksidb,"SELECT * FROM kategorialat");
        if($proses=="insert"){
    ?>
	<form action="?modul=mod_alat&action=save" id="formalat" method="POST" enctype="multipart/form-data">
        <div class="row mb-1">
			<label class="col-md-3">Kode Alat</label>
				<div class="col-md-5">
                    <input type="hidden" name="proses" value="<?= $proses; ?>">
                    <input type="hidden" name="idalat" value="<?= $upidalat; ?>">
					<input type="text" name="kodealat" id="kodealat" class="form-control" value="<?= $kodeterbaru; ?>" readonly>
				</div>
			</div>
        <div class="row mb-1">
			<label class="col-md-3">Nama Alat</label>
			<div class="col-md-5">
				<input type="text" name="nmalat" id="nmalat" class="form-control" >
			</div>
		</div>
        <div class="row mb-1">
                <label class="col-md-3">Kategori Alat</label>
                <div class="col-md-5">
                    <select name="katalat" id="katalat" class="form-control" required>
                        <option selected disabled>--Pilih Kategori Alat--</option>
                        <?php
                        foreach ($qrykategorialat as $j) :
                        ?>
                            <option value="<?= $j['id_katalat']; ?>"><?= $j['nm_katalat']; ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
		<div class="row mb-1">
			<label class="col-md-3">Stock</label>
			<div class="col-md-5">
				<input type="number" name="stock" id="stock" class="form-control" >
			</div>
		</div>
        <div class="row mb-1">
			<label class="col-md-3">Harga Sewa</label>
			<div class="col-md-5">
				<input type="text" name="hargasewa" id="hargasewa" class="form-control" >
			</div>
		</div>
        <div class="row mb-1">
			<label class="col-md-3">Foto</label>
			<div class="col-md-5">
				<input type="file" name="img" id="img" class="form-control" >
			</div>
		</div>
        <div class="row pt-3">
                <label class="col-md-3"></label>
                <div class="col-md-5">
                    <button type="button" id="btnsubmit" class="btn btn-success" data-bs-toggle="modal">Simpan</button>
                    <a href="home.php?modul=mod_alat"><button type="button" class="btn btn-warning">Kembali</button></a>
                </div>
            </div>
	</form>
<?php }else{ ?>
    <form action="?modul=mod_alat&action=save" id="formalat" method="POST" enctype="multipart/form-data">
        <?php if($proses=="update"){ ?>
        <div class="row mb-1">
			<label class="col-md-3">Kode Alat</label>
			<div class="col-md-5">
            <input type="hidden" name="proses" value="<?= $proses; ?>">
            <input type="hidden" name="idalat" value="<?= $upidalat; ?>">
				<input type="text" name="kodealat" id="kodealat" class="form-control" value="<?= $upkode;?>" readonly>
			</div>
		</div>
        <?php } ?>
		<div class="row mb-1">
			<label class="col-md-3">Nama  Alat</label>
			<div class="col-md-5">
				<input type="text" name="nmalat" id="nmalat" class="form-control" value="<?= $upnmalat;?>">
			</div>
		</div>
		<div class="row mb-1">
			<label class="col-md-3">Stock</label>
			<div class="col-md-5">
				<input type="number" name="stock" id="stock" class="form-control" value="<?= $upstock;?>">
			</div>
		</div>
		<div class="row mb-1">
			<label class="col-md-3">Harga</label>
			<div class="col-md-5">
				<input type="text" name="hargasewa" id="hargasewa" class="form-control" value="<?= $upharga;?>">
			</div>
		</div>
        <div class="row mb-1">
                <label class="col-md-3">Kategori Alat</label>
                <div class="col-md-5">
                    <select name="katalat" id="katalat" class="form-control" required>
                        <option selected disabled>--Pilih Kategori Alat--</option>
                        <?php
                        foreach ($qrykategorialat as $k) :
                            if ($k['id_katalat'] === $dt['id_katalat']) {
                                $select = "selected";
                            } else {
                                $select = "";
                            }
                        ?>
                            <option value="<?= $k['id_katalat']; ?>" <?= $select;?>><?= $k['nm_katalat']; ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
        <div class="row mb-1">
			<label class="col-md-3">Foto</label>
			<div class="col-md-5">
                <input type="hidden" name="gambarlama" id="gambarlama" value="<?= $dt['gambar'];?>">
                <?php 
                    if($dt['gambar'] == ""){
                ?>
                    <input type="file" name="img" id="img" class="form-control">
                <?php 
                    } else {
                ?>
				<input type="file" name="img" id="img" class="form-control" value="<?= $dt['gambar'];?>">
                <img src="../asset/img/<?= $dt['gambar'];?>" class="img img-thumbnail mt-1" width="200px">
			<?php
                }
            ?>
            </div>
		</div>
        <div class="row pt-3">
                <label class="col-md-3"></label>
                <div class="col-md-5">
                    <button type="button" name="btnsubmit" id="btnsubmit" class="btn btn-success">Simpan</button>
                    <a href="home.php?modul=mod_alat"><button type="button" class="btn btn-warning">Kembali</button></a>
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
