<?php
include_once("studioctrl.php");
if (!isset($_GET['action'])) {
?>
    <h3 class="fontheader">DATA STUDIO MUSIC</h3>
	<a href="?modul=mod_studio&action=add" class="btn btn-primary btn-xs mb-1">Tambah Data</a>
	<table class="table table-bordered">
		<tr>
			<th>Foto</th>
			<th>Kode Studio</th>
			<th>Nama Studio</th>
			<th>Kategori Studio</th>
			<th>Jumlah Studio</th>
			<th>Harga Sewa</th>
			<th>Action</th>
		</tr>
		<?php
        $liststudio=mysqli_query($koneksidb,"SELECT  a.*,ks.jenis_studio from mst_studio a INNER JOIN kategoristudio ks ON a.id_katstudio=ks.id_katstudio");
		while ($list = mysqli_fetch_array($liststudio)) {
		?>
        <tr>
            <td><img src="../asset/img/<?=$list['gambar']; ?>" width="200px"></td>
            <td><?=$list['kode_studio']; ?></td>
            <td><?=$list['nm_studio']; ?></td>
            <td><?=$list['jenis_studio']; ?></td>
            <td><?=$list['jml_studio']; ?></td>
            <td><?=$list['hrg_sewastudio']; ?></td>
            <td> 
                <a href="?modul=mod_studio&action=edit&id=<?=$list['id_studio']; ?>" class="btn btn-primary">
                        <i class="bi bi-pencil-square"></i>edit</a>
                <a href="?modul=mod_studio&action=delete&id=<?=$list['id_studio']; ?>" class="btn btn-danger">
                        <i class="bi bi-trash"></i>delete</a>
            </td>
        </tr>
        <?php } ?>
	</table>
	<?php } else if (isset($_GET['action']) && ($_GET['action'] == "add" || $_GET['action'] == "edit")) {
                $query_cekkode = mysqli_query($koneksidb,
                "select kode_studio from mst_studio ORDER BY kode_studio DESC LIMIT 0,1");
                   $cekkode = mysqli_fetch_array($query_cekkode);
                   if(mysqli_num_rows($query_cekkode) == 0 ){
                    $kodeakhir="ST";
                }else{
                    $kodeakhir=$cekkode['kode_studio'];  
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
            $kodeterbaru = "ST".$th_sekarang . $nourut_baru;
               $qrykategoristudio=mysqli_query($koneksidb,"SELECT * FROM kategoristudio");
        if($proses=="insert"){
    ?>
	<form action="?modul=mod_studio&action=save" id="formstudio" method="POST" enctype="multipart/form-data">
        <div class="row mb-1">
			<label class="col-md-3">Kode Studio</label>
				<div class="col-md-5">
                    <input type="hidden" name="proses" value="<?= $proses; ?>">
                    <input type="hidden" name="idstudio" value="<?= $upidstudio; ?>">
					<input type="text" name="kodestudio" id="kodestudio" class="form-control" value="<?= $kodeterbaru; ?>" readonly>
				</div>
			</div>
        <div class="row mb-1">
			<label class="col-md-3">Nama Studio</label>
			<div class="col-md-5">
				<input type="text" name="nmstudio" id="nmstudio" class="form-control" >
			</div>
		</div>
        <div class="row mb-1">
                <label class="col-md-3">Kategori Studio</label>
                <div class="col-md-5">
                    <select name="katstudio" id="katstudio" class="form-control" required>
                        <option selected disabled>--Pilih Kategori Studio--</option>
                        <?php
                        foreach ($qrykategoristudio as $ks) :
                        ?>
                            <option value="<?= $ks['id_katstudio']; ?>"><?= $ks['jenis_studio']; ?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
            </div>
		<div class="row mb-1">
			<label class="col-md-3">Jumlah Studio</label>
			<div class="col-md-5">
				<input type="number" name="jmlstudio" id="jmlstudio" class="form-control" >
			</div>
		</div>
        <div class="row mb-1">
			<label class="col-md-3">Harga Sewa Studio</label>
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
                    <button type="button" id="btnsubmit" class="btn btn-primary" data-bs-toggle="modal">Simpan</button>
                    <a href="home.php?modul=mod_studio"><button type="button" class="btn btn-warning">Kembali</button></a>
                </div>
            </div>
	</form>
<?php }else{ ?>
    <form action="?modul=mod_studio&action=save" id="formstudio" method="POST" enctype="multipart/form-data">
        <?php if($proses=="update"){ ?>
        <div class="row mb-1">
			<label class="col-md-3">Kode Alat</label>
			<div class="col-md-5">
            <input type="hidden" name="proses" value="<?= $proses; ?>">
            <input type="hidden" name="idstudio" value="<?= $upidstudio; ?>">
				<input type="text" name="kodealat" id="kodealat" class="form-control" value="<?= $upkode;?>" readonly>
			</div>
		</div>
        <?php } ?>
		<div class="row mb-1">
			<label class="col-md-3">Nama Alat</label>
			<div class="col-md-5">
				<input type="text" name="nmstudio" id="nmstudio" class="form-control" value="<?= $upnmstudio;?>">
			</div>
		</div>
		<div class="row mb-1">
			<label class="col-md-3">Jumlah Studio</label>
			<div class="col-md-5">
				<input type="number" name="jmlstudio" id="jmlstudio" class="form-control" value="<?= $upjmlstudio;?>">
			</div>
		</div>
		<div class="row mb-1">
			<label class="col-md-3">Harga Sewa Studio</label>
			<div class="col-md-5">
				<input type="text" name="hargasewa" id="hargasewa" class="form-control" value="<?= $upharga;?>">
			</div>
		</div>
        <div class="row mb-1">
                <label class="col-md-3">Kategori Alat</label>
                <div class="col-md-5">
                    <select name="katstudio" id="katstudio" class="form-control" required>
                        <option selected disabled>--Pilih Kategori Studio--</option>
                        <?php
                        foreach ($qrykategoristudio as $k) :
                            if ($k['id_katstudio'] === $dt['id_katstudio']) {
                                $select = "selected";
                            } else {
                                $select = "";
                            }
                        ?>
                            <option value="<?= $k['id_katstudio']; ?>" <?= $select;?>><?= $k['jenis_studio']; ?></option>
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
        <div class="row">
			<label class="col-md-3">Ganti Foto</label>
			<div class="col-md-5">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gantifoto" id="gantifoto" value="1" >
                    <label class="form-check-label">
                        Ya
                    </label>
                    </div>
                </div>
		</div>
        <div class="row pt-3">
                <label class="col-md-3"></label>
                <div class="col-md-5">
                    <button type="button" name="btnsubmit" id="btnsubmit" class="btn btn-primary">Simpan</button>
                    <a href="home.php?modul=mod_studio"><button type="button" class="btn btn-warning">Kembali</button></a>
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
