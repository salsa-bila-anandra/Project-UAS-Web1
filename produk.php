<?php
include "koneksi.php";

/* ===============================
✅ SIMPAN PRODUK
=============================== */
if (isset($_POST['simpan'])) {

    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];

    mysqli_query($conn, "INSERT INTO produk (nama_produk, harga, stok)
        VALUES ('$nama', '$harga', '$stok')");

    header("Location: produk.php");
    exit;
}

/* ===============================
✅ AMBIL DATA PRODUK
=============================== */
$data = mysqli_query($conn, "SELECT * FROM produk");

$content = "
<h2>Data Produk</h2>

<form method='POST' style='margin-bottom:20px;'>

    <input type='text' name='nama' placeholder='Nama Produk' required>
    <input type='number' name='harga' placeholder='Harga' required>
    <input type='number' name='stok' placeholder='Stok' required>

    <button name='simpan'>Simpan</button>
</form>

<hr>

<table>
<tr>
    <th>No</th>
    <th>Nama Produk</th>
    <th>Harga</th>
    <th>Stok</th>
    <th>Aksi</th>
</tr>
";

$no = 1;
while ($p = mysqli_fetch_assoc($data)) {

    $content .= "
    <tr>
        <td>$no</td>
        <td>{$p['nama_produk']}</td>
        <td>Rp. {$p['harga']}</td>
        <td>{$p['stok']}</td>

        <td>
            <a class='btn btn-edit'
               href='produk_edit.php?id={$p['id_produk']}'>
               Edit
            </a>

            <a class='btn btn-hapus'
               href='produk_hapus.php?id={$p['id_produk']}'
               onclick='return confirm(\"Yakin hapus produk ini?\")'>
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
