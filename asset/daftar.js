if(document.getElementById("formdaft")){
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
  $("#txtpasscon").on("keyup",function (){
    let pass = $("#txtpass").val();
    let passkonfirm = $("#txtpasscon").val();
     if(pass != passkonfirm){
        $("#btndaftar").prop('disabled', true);
        $("#alertpass").html("password tidak sama !!").show("#alertpass");
    }else{
        $("#btndaftar").prop('disabled', false);
        $("#alertpass").html("oke password sama").hide("#alertpass");
    }
});
  $("#btnyes").click(function () {
    $("#formdaft").attr("action", "memberctrl.php");
    $("#formdaft").submit();
    $(location).attr("href","?page=daftarmember");
  });
}
  