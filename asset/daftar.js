$("#btndaftar").click(function () {
    let nama = $("#txtnama").val();
    let email = $("#txtemail").val();
    let password = $("#txtpass").val();
    let passwordkonfirm = $("#txtpasscon").val();
    let tgllhr = $("#tgllhr").val();
    let notelp = $("#notelp").val();
    let alamat = $("#alamat").val();
    let jk = $("#jk").val();
    let foto = $("#foto").val();
      if (nama == ""||nama==null) {
        alert("nama Wajib diisi!!");
      }else if(email==""||email==null){
        alert("email wajib diisi");
      }else if(password==""||password==null){
        alert("password wajib diisi!");
      }else if(passwordkonfirm==""||passwordkonfirm==null){
        alert("silahkan konfirasi password anda!");
      }else if(password!=passwordkonfirm){
        alert("password yang anda masukkan tidak sama");
      }else if (tgllhr==""||tgllhr==null){
        alert("silahkan masukkan tanggal lahir anda !!");
      }else if(notelp==""||notelp==null){
        alert("silahkan masukkan no telp anda");
      }else if(alamat==""||alamat==null){
        alert("silahkan masukkan alamat anda");
      }else if(jk==""||jk==null){
        alert("silahkan pilih jenis kelamin anda");
      }else if(foto==""||foto==null){
        alert("silahkan upload foto");
      }else{
        $("#konfirmasi").modal("show");
      }
  });
  $("#btnyes").click(function () {
    $("#formdaft").attr("action", "memberctrl.php");
    $("#formdaft").submit();
    $(location).attr("href","?page=daftarmember");
  });
  