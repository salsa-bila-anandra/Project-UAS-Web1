<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM products WHERE id=$id");
header("Location: produk.php");
