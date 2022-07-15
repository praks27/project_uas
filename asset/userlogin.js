if (document.getElementById("formuserlogin")) {
    $("#btnsubmit").click(function () {
        let user = $("#user").val();
        let nama = $("#nama").val();
        let pass = $("#pass").val();
        let passkonfirm = $("#passkonfirm").val();
        let active = $("input[type='radio']:checked");
        if (user == "" || nama == null) {
            alert("username Wajib diisi!!");
        } else if (nama == "" || nama == null) {
            alert("nama lengkap wajib diisi");
        } else if (pass == "" || pass == null) {
            alert("password wajib diisi!");
        } else if (passkonfirm == "" || passkonfirm == null) {
            alert("silahkan konfirmasi password anda");
        } else if (active.length == "") {
            alert("silahkan pilih keaktifan");
        } else {
            $("#btnkonfirm").modal("show");
        }
    });
    $("#passkonfirm").on("keyup",function (){
        let pass = $("#pass").val();
        let passkonfirm = $("#passkonfirm").val();
        
         if(pass != passkonfirm){
            // $("#btnsubmit").prop('disabled', true);
            $("#alertpass").html("password tidak sama !!").show("#alertpass");
        }else{
            // $("#btnsubmit").prop('disabled', false);
            $("#alertpass").html("oke password sama").hide("#alertpass");
        }
    });

    $("#btnsimpan").click(function () {
        $("#formuserlogin").attr("action", "?modul=mod_userlogin&action=save");
        $("#formuserlogin").submit();
    });
};