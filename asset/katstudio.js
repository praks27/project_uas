if(document.getElementById("formkatstudio")){
    $("#btnsubmit").click(function () {
        let nmkatalat = $("#jenisstudio").val();
          if (nmkatalat == ""||nmkatalat == null) {
            alert("Nama Kategori Alat Wajib Diisi!!");
          }else{
            $("#btnkonfirm").modal("show");
          }
      });
      $("#btnsimpan").click(function () {
        $("#formkatstudio").attr("action", "?modul=mod_katstudio&action=save");
        $("#formkatstudio").submit();
      });
    }