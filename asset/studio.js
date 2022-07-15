if(document.getElementById("formstudio")){
$("#btnsubmit").click(function () {
    let nmstudio = $("#nmstudio").val();
    let katstudio = $("#katstudio").val();
    let jmlstudio = $("#jmlstudio").val();
    let hargasewa = $("#hargasewa").val();
    let gantifoto = $("input[type='radio']:checked");
    console.log(gantifoto);
    let foto = $("#img").val();
      if (nmstudio == ""||nmstudio == null) {
        alert("Nama Studio Wajib Diisi!!");
      }else if(katstudio == ""||katstudio == null){
        alert("Silahkan pilih kategori Studio!");
      }else if(jmlstudio==""||jmlstudio==null){
        alert("Masukkan Jumlah Studio!");
      }else if(hargasewa==""||hargasewa==null){
        alert("Harga Sewa Wajib Diisi!");
      }else if(gantifoto.length == "1" && foto == "" || foto == null){
        alert("silahkan upload foto!")
      }else{
        $("#btnkonfirm").modal("show");
      }
  });
  $("#btnsimpan").click(function () {
    $("#formstudio").attr("action", "?modul=mod_studio&action=save");
    $("#formstudio").submit();
  });
}