<?php
security_login();
if (isset($_GET['act']) && ($_GET['act'] == 'add')){
    $judul = "Form Hak Akses";
}
if (isset($_GET['act']) && ($_GET['act'] == 'edit')){
    $judul = "Ubah Form Hak Akses";
    $qakses = mysqli_query($koneksidb, "SELECT * FROM hakakses_menu WHERE id_user='".$_GET['iduser']."' ");
    $data = mysqli_fetch_array($qakses);
    $username = @$data['iduser'];
    // for($i = 0;$i < $pilihan; $i++){
    //     $qdelete = mysqli_query($koneksidb, "DELETE FROM hakakses_menu WHERE iduser='$username'");
    //     $qinsert = mysqli_query($koneksidb, "INSERT INTO hakakses_menu VALUES ('', '$txtmenu[$i]','$txtuser')");
    // }
    
} 
else if (isset($_POST['submit'])){
    $quser=mysqli_query($koneksidb,"SELECT username FROM mst_user");
    // $idk=$_GET['iduser'];
    $q=mysqli_fetch_array($quser);
    $txtuser = $_POST['iduser'];
    $txtmenu = $_POST['idmenu'];
    $pilihan = count($txtmenu);
    $delete = mysqli_query($koneksidb, "DELETE FROM hakakses_menu WHERE id_user='$txtuser'");
    if($delete){
        for($i = 0;$i < $pilihan; $i++){
            $qinsert = mysqli_query($koneksidb, "INSERT INTO hakakses_menu VALUES ('', '$txtmenu[$i]','$txtuser')");
        }
    }
    header("Location: home.php?modul=mod_hakakses&tampil");
    // $tampil = 1;
}
?>