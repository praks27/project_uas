<?php
security_login();

if (!isset($_GET['action'])) {
    $data_menu = mysqli_query($koneksidb, "select * from mst_user");
} else if (isset($_GET['action']) && $_GET['action'] == "add") {
    $proses = "insert";
} else if (isset($_GET['action']) && $_GET['action'] == "edit") {
    $ids = $_GET['id'];
    $qry = mysqli_query($koneksidb, "select * from mst_user where id_user='$ids'");
    $dt = mysqli_fetch_array($qry);
    $upiduser = $dt['id_user'];
    $upuser = $dt['username'];
    $upnama = $dt['nama_lengkap'];
    $uppass = $dt['password'];
    $upisactive = $dt['is_active'];
    $proses = "update";
} else if (isset($_GET['action']) && $_GET['action'] == "save") {
    $iduser = $_POST['iduser'];
    $username = $_POST['user'];
    $nama = $_POST['nama'];
    $pwlama = @$_POST['pwlama'];
    $pass = $_POST['pass'];
    $passbaru = md5($_POST['pass']);
    $isactive = $_POST['isactive'];
    $proses = $_POST['proses'];
    if ($proses == "insert") {
        mysqli_query($koneksidb, "insert into mst_user(username,nama_lengkap,password,is_active)values('$username','$nama','$passbaru','$isactive')") or die(mysqli_error($koneksidb));
        echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_userlogin">';
    } else if ($proses == "update") {
        if ($pwlama === $pass) {
            mysqli_query($koneksidb, "update mst_user SET username='$username', nama_lengkap='$nama',is_active='$isactive' WHERE id_user = '$iduser' ");
            echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_userlogin">';
        } else {
            mysqli_query($koneksidb, "update mst_user SET username='$username', nama_lengkap='$nama',password='$passbaru',is_active='$isactive' WHERE id_user = '$iduser' ");
            echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_userlogin">';
        }
    }
} else if (isset($_GET['action']) && $_GET['action'] == "delete") {
    $id = $_GET['id'];
    mysqli_query($koneksidb, "DELETE FROM mst_user where id_user='$id'");
    echo '<meta http-equiv="refresh" content="0; url=' . ADMIN_URL . '?modul=mod_userlogin">';
}