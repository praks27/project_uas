<?php
security_login();

if(!isset($_GET['action'])){
    $data_member=mysqli_query($koneksidb,"select * from daftarmember");
}
?>