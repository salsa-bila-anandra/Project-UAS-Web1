<?php
include "koneksi.php";

/* ===============================
   SIMPAN DATA CUSTOMER
=============================== */
if (isset($_POST['simpan'])) {

    $kode   = mysqli_real_escape_string($conn, $_POST['kode']);
    $nama   = mysqli_real_escape_string($conn, $_POST['nama']);
    $telp   = mysqli_real_escape_string($conn, $_POST['telp']);
    $alamat = mysqli_real_escape_string($conn, $_POST['alamat']);
    $email  = mysqli_real_escape_string($conn, $_POST['email']);

    $insert = mysqli_query($conn, "INSERT INTO customer 
        (kode_customer, nama_customer, telepon, alamat, email)
        VALUES 
        ('$kode', '$nama', '$telp', '$alamat', '$email')");

    if (!$insert) {
        die("Query Error: " . mysqli_error($conn));
    }

    header("Location: customer.php");
    exit;
}

/* ===============================
   AMBIL DATA CUSTOMER
=============================== */
$data = mysqli_query($conn, "SELECT * FROM customer");

if (!$data) {
    die("Query Error: " . mysqli_error($conn));
}

/* ===============================
   ISI HALAMAN CUSTOMER
=============================== */
$content = <<<HTML
<h2>Data Customer</h2>

<form method='POST' style='margin-bottom:20px;'>
    <input type='text' name='kode' placeholder='Kode Customer' required>
    <input type='text' name='nama' placeholder='Nama Customer' required>
    <input type='text' name='telp' placeholder='No Telepon' required>
    <input type='text' name='alamat' placeholder='Alamat' required>
    <input type='email' name='email' placeholder='Email' required>
    <button type='submit' name='simpan'>Simpan</button>
</form>

<hr>

<table style='width:100%; border-collapse:collapse;' border='1' cellpadding='10'>
<tr style='background:#f2f2f2; text-align:center;'>
    <th>No</th>
    <th>Kode</th>
    <th>Nama</th>
    <th>No Telepon</th>
    <th>Alamat</th>
    <th>Email</th>
    <th>Aksi</th>
</tr>
HTML;

$no = 1;
while ($c = mysqli_fetch_assoc($data)) {

    $content .= <<<HTML
    <tr>
        <td style='text-align:center;'>$no</td>
        <td>{$c['kode_customer']}</td>
        <td>{$c['nama_customer']}</td>
        <td style='text-align:center;'>{$c['telepon']}</td>
        <td>{$c['alamat']}</td>
        <td>{$c['email']}</td>
        <td style='text-align:center;'>
            <a class='btn btn-edit' href='customer_edit.php?id={$c['id_customer']}'>Edit</a>
            <a class='btn btn-hapus' href='customer_hapus.php?id={$c['id_customer']}' 
               onclick='return confirm("Yakin hapus customer ini?")'>
               Hapus
            </a>
        </td>
    </tr>
HTML;
    $no++;
}

$content .= "</table>";

include "layout.php";
?>