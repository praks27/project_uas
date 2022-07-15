if(document.getElementById("formkatalat")){
    $("#btnsubmit").click(function () {
        let nmkatalat = $("#nmkatalat").val();
          if (nmkatalat == ""||nmkatalat == null) {
            alert("Nama Kategori Alat Wajib Diisi!!");
          }else{
            $("#btnkonfirm").modal("show");
          }
      });
      $("#btnsimpan").click(function () {
        $("#formkatalat").attr("action", "?modul=mod_katalat&action=save");
        $("#formkatalat").submit();
      });
    }