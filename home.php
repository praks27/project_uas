<?php
session_start();
session_destroy();
function fnumber($fharga){
    $harga = number_format($fharga,0,',','.');
    return $harga;
}
?>
<div class="container pb-5">
	<div class="row">
		<div class="col-md-3 pt-4 mb-3">
			<div class="kategori-title">Kategori</div>
			<div class="subkategori">
				<span><h5>Kategori Alat</h5></span>
			<?php
            $qry_listkat= mysqli_query($koneksidb,"select * from kategorialat order by id_katalat DESC")or die("gagal akses tabel kategoriproduk".mysqli_error($connect_db));
            while($row = mysqli_fetch_array($qry_listkat)){
            ?>
            <ul>
                <li> 
                <a href="?page=&id=<?php echo $row['id_katalat'];?>" class="text"><?php echo $row['nm_katalat'];?></a>
                </li>
            </ul>
            <?php
            }
            ?>
				<span><h5>Kategori Studio</h5></span>
			<?php
            $qry_listkat= mysqli_query($koneksidb,"select * from kategoristudio order by id_katstudio ASC")or die("gagal akses tabel kategoriproduk".mysqli_error($connect_db));
            while($row = mysqli_fetch_array($qry_listkat)){
            ?>
            <div class="subkategori" id="">
            	<ul>
                	<li> 
                		<a href="?page=&id=<?php echo $row['id_katstudio'];?>" class="text"><?php echo $row['jenis_studio'];?></a>
                		</li>
            		</ul>
				</div>
            <?php
            }
            ?>
			</div>
		</div>
		<div class="col-md-9 pt-4">
			<div class="row">
				<h4 class="card-title text-center mb-3 pt-1" style="background-color: #010324; color: white; box-sizing: border-box;  ">Alat Music Unggulan Kami</h4>
					<?php
						$qlist_alat = mysqli_query($koneksidb, "SELECT * FROM mst_alatsewa");
						foreach($qlist_alat as $la) :
					?>
				<div class="col-md-4">
					<div class="card">
						<img src="asset/img/<?= $la['gambar'];?>" class="card-img-top" width="150px" height="200px">
						<div class="card-body text-center bgcardbody">
							<h5 class="card-title"><?= $la['nm_alat'];?></h5>
							<h6 class="harga"><?= "Rp ". fnumber($la['hrg_alat']);?></h6>
						</div>
						<ul class="list-group list-group-flush">
							<li class="list-group-item btndetail">
								<a href="?page=detailproduk&idalat=<?= $la['id_alat'];?>" class="text-white">Detail</a>
							</li>
						</ul>
					</div>
				</div>
				<?php endforeach;?>
			</div>
			<div class="row">
				<h4 class="card-title text-center my-2 mx-2" style="background-color: #010324; color: white; box-sizing: border-box;  ">Studio Unggulan Kami</h4>
				<?php
                    $qlist_studio = mysqli_query($koneksidb, "SELECT * FROM mst_studio");
                    foreach($qlist_studio as $ls) :
                ?>
				<div class="col-md-4">
					<div class="card">
						<img src="asset/img/<?= $ls['gambar'];?>" class="card-img-top" alt="..." />
						<div class="card-body text-center bgcardbody">
							<h5 class="card-title"><?= $ls['nm_studio'];?></h5>
							<h6 class="harga"><?= "Rp ". fnumber($ls['hrg_sewastudio']);?></h6>
						</div>
						<ul class="list-group list-group-flush">
							<li class="list-group-item btndetail">
								<a href="?page=detailproduk&idstudio=<?= $ls['id_studio'];?>" class="text-white">Detail</a>
							</li>
						</ul>
					</div>
				</div>
				<?php endforeach;?>
			</div>
		</div>
	</div>
</div>
<script src="asset/daftar.js"></script>
<script src="asset/proses.js"></script>