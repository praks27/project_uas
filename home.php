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
		<div class="col-md-3 pt-4">
			<div class="kategori-title">Kategori</div>
			<div class="subkategori">
				<span><h5>Kategori Alat</h5></span>
			<?php
            $qry_listkat= mysqli_query($koneksidb,"select * from kategorialat order by id_katalat DESC")or die("gagal akses tabel kategoriproduk".mysqli_error($connect_db));
            while($row = mysqli_fetch_array($qry_listkat)){
            ?>
			
            <ul>
                <li> 
                <a href="?page=&id=<?php echo $row['id_katalat'];?>"><?php echo $row['nm_katalat'];?></a>
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
                		<a href="?page=&id=<?php echo $row['id_katstudio'];?>"><?php echo $row['jenis_studio'];?></a>
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
				<?php
                    $qlist_alat = mysqli_query($koneksidb, "SELECT * FROM mst_alatsewa");
                    foreach($qlist_alat as $la) :
                ?>
				<div class="col-md-4">
					<div class="card-title">alat music kami</div>
					<div class="card">
						<img src="asset/img/<?= $la['gambar'];?>" class="card-img-top img img-thumbnail" alt="..." />
						<div class="card-body text-center bgcardbody">
							<h5 class="card-title"><?= $la['nm_alat'];?></h5>
							<h6 class="harga"><?= "Rp ". fnumber($la['hrg_alat']);?></h6>
						</div>
						<ul class="list-group list-group-flush">
							<li class="list-group-item btndetail">
								<a href="?page=detailproduk&idalat=<?= $lp['id_alat'];?>" target="_blank" class="text-white">Detail</a>
							</li>
						</ul>
					</div>
				</div>
				<?php endforeach;?>
			</div>
			<div class="row">
				<?php
                    $qlist_studio = mysqli_query($koneksidb, "SELECT * FROM mst_studio");
                    foreach($qlist_studio as $ls) :
                ?>
				<div class="col-md-4">
					<div class="card-title">studio</div>
					<div class="card">
						<img src="asset/img/<?= $ls['gambar'];?>" class="card-img-top" alt="..." />
						<div class="card-body text-center bgcardbody">
							<h5 class="card-title"><?= $ls['nm_studio'];?></h5>
							<h6 class="harga"><?= "Rp ". fnumber($ls['hrg_sewastudio']);?></h6>
						</div>
						<ul class="list-group list-group-flush">
							<li class="list-group-item btndetail">
								<a href="?page=detailproduk&idstudio=<?= $lp['id_studio'];?>" target="_blank" class="text-white">Detail</a>
							</li>
						</ul>
					</div>
				</div>
				<?php endforeach;?>
			</div>
		</div>
	</div>
</div>