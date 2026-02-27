<?php
include "koneksi.php";

/* ===============================
✅ SIMPAN TRANSAKSI
=============================== */
if (isset($_POST['simpan'])) {

    $id_customer = $_POST['customer'];
    $id_produk   = $_POST['produk'];
    $qty         = $_POST['qty'];

    // Ambil harga produk
    $produk = mysqli_fetch_assoc(
        mysqli_query($conn, "SELECT * FROM produk WHERE id_produk='$id_produk'")
    );

    $harga = $produk['harga'];
    $stok  = $produk['stok'];

    // Cek stok cukup atau tidak
    if ($qty > $stok) {
        echo "<script>alert('Stok tidak cukup!');</script>";
    } else {

        // Hitung subtotal
        $subtotal = $qty * $harga;

        // Simpan ke transaksi
        mysqli_query($conn, "INSERT INTO transaksi (tanggal, id_customer, total)
            VALUES (CURDATE(), '$id_customer', '$subtotal')");

        $id_transaksi = mysqli_insert_id($conn);

        // Simpan detail transaksi
        mysqli_query($conn, "INSERT INTO transaksi_detail 
            (id_transaksi, id_produk, qty, subtotal)
            VALUES ('$id_transaksi', '$id_produk', '$qty', '$subtotal')");

        // Kurangi stok produk
        mysqli_query($conn, "UPDATE produk SET stok=stok-$qty 
            WHERE id_produk='$id_produk'");

        header("Location: transaksi.php");
        exit;
    }
}

/* ===============================
✅ DATA CUSTOMER & PRODUK UNTUK SELECT
=============================== */
$customers = mysqli_query($conn, "SELECT * FROM customer");
$produks   = mysqli_query($conn, "SELECT * FROM produk");

/* ===============================
✅ DATA TRANSAKSI UNTUK TABEL
=============================== */
// we need product name via detail join (each transaksi currently has one detail)
$data = mysqli_query($conn, "
    SELECT transaksi.*, customer.nama_customer, produk.nama_produk 
    FROM transaksi 
    LEFT JOIN customer ON transaksi.id_customer = customer.id_customer
    LEFT JOIN transaksi_detail ON transaksi_detail.id_transaksi = transaksi.id_transaksi
    LEFT JOIN produk ON transaksi_detail.id_produk = produk.id_produk
    ORDER BY transaksi.id_transaksi DESC
");

$content = "
<h2>Transaksi Penjualan</h2>

<form method='POST' style='margin-bottom:20px;'>

    <select name='customer' required>
        <option value=''>-- Pilih Customer --</option>
";

while ($c = mysqli_fetch_assoc($customers)) {
    $content .= "<option value='{$c['id_customer']}'>{$c['nama_customer']}</option>";
}

$content .= "
    </select>

    <select name='produk' required>
        <option value=''>-- Pilih Produk --</option>
";

while ($p = mysqli_fetch_assoc($produks)) {
    $content .= "<option value='{$p['id_produk']}'>
        {$p['nama_produk']} (Stok: {$p['stok']})
    </option>";
}

$content .= "
    </select>

    <input type='number' name='qty' placeholder='Qty' min='1' required>

    <button name='simpan'>Proses</button>
</form>

<hr>

<table>
<tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Customer</th>
    <th>Produk</th>
    <th>Total</th>
    <th>Aksi</th>
</tr>
";

$no = 1;
while ($t = mysqli_fetch_assoc($data)) {

    $content .= "
    <tr>
        <td>$no</td>
        <td>{$t['tanggal']}</td>
        <td>{$t['nama_customer']}</td>        <td>{$t['nama_produk']}</td>        <td>Rp. " . number_format($t['total']) . "</td>

        <td>
            <a class='btn btn-edit' href='transaksi_edit.php?id={$t['id_transaksi']}'>
               Edit
            </a>
            <a class='btn btn-hapus'
               href='transaksi_hapus.php?id={$t['id_transaksi']}'
               onclick='return confirm(\"Yakin hapus transaksi ini?\")'>
               Hapus
            </a>
        </td>
    </tr>
    ";

    $no++;
}

$content .= "</table>";

include "layout.php";
?>
