<?php
// Pastikan session aktif
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Jika belum login, kembali ke login
if (!isset($_SESSION['login']) || !isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Ambil data user
$user = $_SESSION['user'];

// Isi konten profil
$content = "
<h2>Profil Akun</h2>

<p><b>Username:</b> {$user['username']}</p>
<p><b>Email:</b> {$user['email']}</p>
<p><b>Role:</b> {$user['role']}</p>

<hr>

<a class='btn btn-edit' href='dashboard.php'>⬅ Kembali</a>
<a class='btn btn-hapus' href='logout.php'>Logout</a>
";

// Tampilkan layout
include "layout.php";
?>
