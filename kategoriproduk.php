
<section id="header">
		<div class="container ps-0 pt-2">
			<div class="row">
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="txt_cari" placeholder="Cari Produk Disini" class="form-control border-secondary" aria-label="Recipient's username" aria-describedby="button-addon2" autocomplete="0ff">
                        <button type="submit" name="cari" class="btn btn-outline-warning text-secondary" id="button-addon2">Search</button>
                    </div>
                </form>
			</div>
		</div>
	</section>
<div class="container pb-5">
	<div class="row">
        <div class="col-md-2"></div>
		<div class="col-md-8 pt-2">
			<div class="row">
                <!-- judul kategori -->
                <?php
                include "functionCtrl.php";
                    $idkey = $_GET['id'];
                    $qlist_produk = mysqli_query($koneksidb, "SELECT kp.nmkategori
                        FROM kategoriproduk kp WHERE kp.idkategori = $idkey;");
                    $qj = mysqli_fetch_array($qlist_produk)
                ?>
                <h1 class="text text-center pb-3 pt-3 border border">Kategori <?= $qj['nmkategori'];?></h1>
                <hr>
                <!-- tampil produk -->
                <?php
                    $idkey = $_GET['id'];
                    // pencarian
                    if(isset($_POST['cari'])){
                        $cproduk = " AND nmproduk LIKE '%".$_POST["txt_cari"]."%' ";
                    }
                    else{
                        $cproduk = "";
                    }
                    $qlist_produk = mysqli_query($koneksidb, "SELECT mp.nmproduk, mp.harga, mp.gambar, kp.nmkategori, mp.idproduk
                        FROM mst_produk mp INNER JOIN kategoriproduk kp ON mp.idkategori=kp.idkategori WHERE kp.idkategori = $idkey
                        $cproduk 
                        ORDER BY mp.idproduk DESC LIMIT 6;");
                     foreach($qlist_produk as $lp) : 
                ?>
				<div class="col-md-4 pb-4">
					<div class="card">
						<img src="assets/img/<?= $lp['gambar'];?>" class="card-img-top" alt="..." />
						<div class="card-body text-center bgcardbody">
							<h5 class="card-title"><?= $lp['nmproduk'];?></h5>
							<h6 class="harga"><?= "Rp ".fnumber($lp['harga']);?></h6>
						</div>
						<ul class="list-group list-group-flush">
							<li class="list-group-item btndetail">
								<a href="?page=detailproduk&id=<?= $lp['idproduk'];?>" target="_blank" class="text-white">Detail</a>
							</li>
						</ul>
					</div>
				</div>
                <?php 
                    endforeach;
                ?>
			</div>
		</div>
        <div class="col-md-2"></div>
	</div>
</div>