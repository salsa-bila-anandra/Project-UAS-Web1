<?php
include "koneksi.php";

$id = $_GET['id'];

/* ===============================
✅ KEMBALIKAN STOK PRODUK
=============================== */
$detail = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM transaksi_detail WHERE id_transaksi='$id'")
);

$id_produk = $detail['id_produk'];
$qty       = $detail['qty'];

// Tambah stok produk kembali
mysqli_query($conn, "UPDATE produk SET stok=stok+$qty WHERE id_produk='$id_produk'");

/* ===============================
✅ HAPUS DETAIL & TRANSAKSI
=============================== */
mysqli_query($conn, "DELETE FROM transaksi_detail WHERE id_transaksi='$id'");
mysqli_query($conn, "DELETE FROM transaksi WHERE id_transaksi='$id'");

header("Location: transaksi.php");
exit;
?>
