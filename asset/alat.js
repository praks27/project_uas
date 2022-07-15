if(document.getElementById("formalat")){
    $("#btnsubmit").click(function () {
        let nmalat = $("#nmalat").val();
        let katalat = $("#katalat").val();
        let stock = $("#stock").val();
        let hargasewa = $("#hargasewa").val();
        let img = $("#img").val();
          if (nmalat == ""||nmalat == null) {
            alert("Nama Alat Wajib Diisi!!");
          }else if(katalat == ""||katalat == null){
            alert("Silahkan pilih kategori!");
          }else if(stock==""||stock==null){
            alert("Masukkan Jumlah Stock!");
          }else if(hargasewa==""||hargasewa==null){
            alert("Harga Wajib Diisi!");
          }else if(img==""||img==null){
            alert("Silahkan Upload Foto!");
          }else{
            $("#btnkonfirm").modal("show");
          }
      });
      $("#btnsimpan").click(function () {
        $("#formalat").attr("action", "?modul=mod_alat&action=save");
        $("#formalat").submit();
      });    
};

 