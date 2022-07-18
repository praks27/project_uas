//proses halaman ordeer
    if (document.getElementById("formorder")) {
    $("#idbarang").change(function () {
      let idproduk = $(this).val();
      let namabarang = $(this).find(":selected").data("namabrg");
      let hargabarang = $(this).find(":selected").data("hargabrg");
      $("#nm_barang").val(namabarang);
      $("#harga").val(hargabarang);
    });
    $("#btn_addbarang").click(function () {
      let idbarang = $("#idbarang").val();
      let nmbarang = $("#nm_barang").val();
      let harga = $("#harga").val();
      let qty = $("#jml").val();
      let subtotal = 0;
      let total = $("#total").val();
      console.log(total);
      if (idbarang == "") {
        alert("Barang belum dipilih!!");
      } else if (qty == "" || qty == 0) {
        alert("Jumlah belum diinput!!");
      } else {
        subtotal = Number(harga) * Number(qty);
        let listrows = "<tr>";
        listrows += "<td>" + nmbarang + " <input type='hidden' name='row_idbarang[]' value='" + idbarang + "'></td>";
        listrows += "<td>" + harga + "<input type='hidden' name='row_harga[]' value='" + harga + "'></td>";
        listrows += "<td>" + qty + "<input type='hidden' name='row_qty[]' value='" + qty + "'></td>";
        listrows += "<td>" + subtotal + "<input type='hidden' name='row_subtotal[]' value='" + subtotal + "'></td>";
        listrows += "</tr>";
        $("#listbarang").append(listrows);
        total = Number(total) + Number(subtotal);
  
        $("#total").val(total);
        $("#viewtotalbayar").text(total);
      }
    });
    $("#btn_order").click(function () {
      //buat validasi form inputan yang wajib diisi
      $("#konfirmasiorder").modal("show");
    });
    $("#btn_saveorder").click(function () {
      $("#formorder").attr("action", "?page=order&action=ordersave");
      $("#formorder").submit();
      //$(location).attr("href", "?page=order");
    });
  }