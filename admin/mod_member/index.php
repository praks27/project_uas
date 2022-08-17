<?php
include_once("daftarCtrl.php");
include_once("detailmember.php");
?>
        <table class="table table-bordered ">
            <?php if(!isset($_GET['profile']) && (!isset($_GET['history']))){?>
            <tr>
                <th>id member</th>
                <th>kode member</th>
                <th>nama member</th>
                <th>email</th>
                <th>password</th>
                <th>tanggal daftar</th>
                <th>tanggal lahir</th>
                <th>no telepon</th>
                <th>alamat</th>
                <th>jenis kelamin</th>
                <th>foto</th>
                <th>history transaksi</th>
            </tr>
            <?php
            }
	            while ($d = mysqli_fetch_array($data_member)) {
	        ?>  
            <tr>
                <td><?=$d['idmember'];?></td>
                <td><?=$d['kode_member'];?></td>
                <td><a href="?modul=mod_member&profile=detailmember.php&id=<?=$d['idmember'];?>"><?=$d['nm_member'];?></a></td>
                <td><?=$d['email'];?></td>
                <td><?=$d['password'];?></td>
                <td><?=date_format(new DateTime($d['tgl_daftar']), 'd-m-Y');?></td>
                <td><?=$d['tgl_lhr'];?></td>
                <td><?=$d['no_telp'];?></td>
                <td><?=$d['alamat'];?></td>
                <td><?=$d['jk'];?></td>
                <td><img src="../assets/img/<?=$d['foto']; ?>" width="200px"></td>
                <td><a href="?modul=mod_member&history=detailmember.php&id=<?=$d['idmember'];?>">History Trasaksi</a></td>
            </tr>
            <?php }?>    
        </table>
            