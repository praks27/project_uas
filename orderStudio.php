<?php 
$data_member = mysqli_query($koneksidb,"select * from daftarmember");
$data_produk = mysqli_query($koneksidb,"select * from mst_studio ");
$query_cekkode = mysqli_query($koneksidb,
		"select nosewa from trn_sewahead ORDER BY nosewa DESC LIMIT 0,1");
$cekkode = mysqli_fetch_array($query_cekkode);
if(mysqli_num_rows($query_cekkode) > 0){
	$kodeakhir = $cekkode['nosewa'];
	$no_urutakhir = substr($kodeakhir,3);
	$no_urut = $no_urutakhir + 1;
	echo $no_urut;
	if($no_urut < 10){
		$no_urutbaru =  "00".$no_urut;
	}
	else if($no_urut < 100){
		$no_urutbaru =  "0".$no_urut;
	}
	else{
		$no_urutbaru = $no_urut;
	}
	$noinv = "INV".$no_urutbaru;
}
else{
	$noinv = "INV001";
}
?>
<div class="container">
	<form action="#" class="pb-5" id="formorderstudio" method="POST">
		<h3 class="pt-3">Form Pembelian</h3>
		<div class="row pb-1">
			<label class="control-label col-md-2">Nama Member</label>
			<div class="col-md-3">
				<select name="nm_member" id="nm_member" value="" class="form-control">
					<option value="">--Pilih Member--</option>
					<?php 
						foreach($data_member as $p){
							echo '<option value="'.$p['id_member'].'">
							'.$p['nm_member'].'</option>';
						}
					?>
				</select>
			</div>
			<label class="control-label col-md-1">No.Invoice</label>
			<div class="col-md-2">
				<input type="text" name="no_inv" id="no_inv" value="<?= $noinv; ?>" class="form-control" readonly>
			</div>
			<label class="control-label col-md-1">Tanggal Sewa</label>
			<div class="col-md-2">
				<input type="date" name="tgl_trans" id="tgl_trans" value="" class="form-control">
			</div>
		</div>
		<div class="row">
                <div class="col-md-8"></div>
                <label class="control-label col-md-1">Tanggal Kembali</label>
                <div class="col-md-2">
                    <input type="date" name="tgl_kembali" id="tgl_kembali" value="" class="form-control">
                </div>
            </div>
		<div class="row pb-1">
			<label class="control-label col-md-2">Nama Barang</label>
			<div class="col-md-3">
				<select name="idbarang" id="idbarang" value="" class="form-control">
					<option value="">--Pilih Barang--</option>
					<?php 
						foreach($data_produk as $p){
							echo '<option value="'.$p['id_studio'].'"
							data-namastudio="'.$p['nm_studio'].'"
							data-hargastudio='.$p['hrg_sewastudio'].'>
							'.$p['nm_studio'].'</option>';
						}
					?>
				</select>
				<input type="hidden" name="nm_barang" id="nm_barang">
			</div>
			<label class=" control-label col-md-1">Harga</label>
			<div class="col-md-2">
				<input type="text" name="harga" id="harga" value="" class="form-control" readonly>
			</div>
			<label class="control-label col-md-1">Jumlah</label>
			<div class="col-md-1">
				<input type="text" name="jml" id="jml" value="" class="form-control">
			</div>
			<div class="col-md-2">
				<button type="button" id="btn_addbarang" class="btn btn-primary">Tambah Barang</button>
			</div>
		</div>
		<div class="row pb-1">
			<div class="col-md-12">
				<table class="table table-bordered" id="">
					<thead>
						<tr>
							<th>Nama Barang</th>
							<th width="10%">Harga</th>
							<th width="5%">Jumlah</th>
							<th width="10%">Subtotal</th>
						</tr>
					</thead>
					<tbody id="listbarang">

					</tbody>
					<tfoot>
						<tr>
							<th colspan="3">Total Bayar</th>
							<th>
								<span id="viewtotalbayar"></span>
								<input type="hidden" name="total" id="total" value="0">
							</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
		<div class="row pb-1">
			<div class="col-md-12">
				<button type="button" id="btn_order" class="btn btn-primary"> Simpan Order</button>
			</div>
		</div>
		<!-- konfirmasi modal -->
		<div class="modal" tabindex="-1" id="konfirmasiorder">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Konfirmasi Order</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<p>Apakah anda yakin melakukan order dan melanjutkan pembayaran???</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
						<button type="button" id="btn_saveorder" class="btn btn-primary">Ya</button>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
<?php 
if(isset($_GET['action']) && $_GET['action'] == "ordersave"){
	//head
	$tgl_sekarang = date("Y-m-d H:i:s");
	$nm_member = $_POST['nm_member'];
	$no_inv = $_POST['no_inv'];
	$tgl_trans = $_POST['tgl_trans'];
	$tgl_kembali = $_POST['tgl_kembali'];
	$total = $_POST['total'];
	//detail
	$idbarang = $_POST['row_idbarang'];
	$harga = $_POST['row_harga'];
	$qty = $_POST['row_qty'];
	$subtotal = $_POST['row_subtotal'];
	$jml_list = count($idbarang);

	//proses simpan ke head
	$qinsert_head = mysqli_query($koneksidb, "INSERT INTO trn_sewahead(nosewa,idmember,tgl_sewa,tgl_kembali,total)
		 VALUES ('$no_inv', '$nm_member','$tgl_trans','$tgl_kembali',$total)") or die("error head".mysqli_error($koneksidb));
	if($qinsert_head){
		for($i = 0;$i < $jml_list; $i++){
			$qinsert_det = mysqli_query($koneksidb, "INSERT INTO trn_sewadetail 
			(nosewa,id_produk,harga,qty,subtotal) VALUES ('$no_inv', '$idbarang[$i]', $harga[$i], $qty[$i], $subtotal[$i])")
			or die("error detail ".mysqli_error($koneksidb));
		}
		echo '<meta http-equiv="refresh" content="0; url='.MAIN_URL.'?page=orderstudio">';
	}	 

}
?>