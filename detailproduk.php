<?php 
function rupiah($angka){
	$hasil_rupiah = "Rp." . number_format($angka,2,',', '.');
	return $hasil_rupiah;
}if(isset($_GET['idalat'])){
?>
<?php
		$dtlproduk = mysqli_query($koneksidb,"select*from mst_alatsewa ")or die("gagal akses table mst_alatsewa ".mysqli_error($koneksidb));
				//looping 
            while($p = mysqli_fetch_array($dtlproduk)){	
                if(isset($_GET['idalat']) == ($_GET['idalat']==$p['id_alat'])){
	?>
        <div class="container pb-5">
            <div class="row">
                <div class="col-md-3 pt-4">
                    <div class="kategori-title">Kategori Produk</div>
                    <div class="subkategori" id="subkategori"></div>
                </div>
                <div class="col-md-9 pt-4">
                    <div class="row">
                        <div class="col-md-6 pe-0">
                            <img src="asset/img/<?= $p['gambar'];?>" class="card-img-top" alt="..." />
                        </div>
                        <div class="col-md-6 ps-0">
                            <div class="card">
                                <div class="card-body subkategori p-2">
                                    <h4><?= $p['nm_alat'];?></h4>
                                    <h5 class="harga">Harga : <?= rupiah($p['hrg_alat']); ?></h5>
                                    <p style="color: black; font-family: Arial, Helvetica, sans-serif; font-size: 14px">
                                        Stok : <?= $p['stock'];?> <br />
                                        Deskripsi : <?= $p['deskripsi'];?> <br />
                                    </p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item btndetail">
                                        <a href="http://wa.me/6281339364971?text=<?= $p['nm_alat'];?> , <?=rupiah($p['hrg_alat']); ?> "
                                            target="_blank" class="text-white">Sewa Sekarang</a>
                                    </li>
                                    <a href="?page=home" class="btn btn-warning ">Kembali</a>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }   
        }
    }else{
	?>
</div>
<?php
		$dtlproduk = mysqli_query($koneksidb,"select*from mst_studio ")or die("gagal akses table mst_studio ".mysqli_error($koneksidb));
				//looping 
            while($p = mysqli_fetch_array($dtlproduk)){	
                if(isset($_GET['idstudio']) == ($_GET['idstudio']==$p['id_studio'])){
	?>
        <div class="container pb-5">
            <div class="row">
                <div class="col-md-3 pt-4">
                    <div class="kategori-title">Kategori Produk</div>
                    <div class="subkategori" id="subkategori"></div>
                </div>
                <div class="col-md-9 pt-4">
                    <div class="row">
                        <div class="col-md-6 pe-0">
                            <img src="asset/img/<?= $p['gambar'];?>" class="card-img-top" alt="..." />
                        </div>
                        <div class="col-md-6 ps-0">
                            <div class="card">
                                <div class="card-body subkategori p-2">
                                    <h4><?= $p['nm_studio'];?></h4>
                                    <h5 class="harga">Harga : <?= rupiah($p['hrg_sewastudio']); ?></h5>
                                    <p style="color: black; font-family: Arial, Helvetica, sans-serif; font-size: 14px">
                                        Stok : <?= $p['jml_studio'];?> <br />
                                        Deskripsi : <?= $p['deskripsi'];?> <br />
                                    </p>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item btndetail">
                                        <a href="http://wa.me/6281339364971?text=<?= $p['nm_studio'];?> , <?=rupiah($p['hrg_sewastudio']); ?> "
                                            target="_blank" class="text-white">Sewa Sekarang</a>
                                    </li>
                                    <a href="?page=home" class="btn btn-warning ">Kembali</a>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            }   
        }
    }
	?>
</div>