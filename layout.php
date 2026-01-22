<?php
// layout.php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

// Judul halaman (opsional)
if (!isset($title)) {
    $title = "Dashboard";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $title; ?></title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f6f8;
        }

        /* SIDEBAR */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 230px;
            height: 100vh;
            background: #2c3e50;
            color: #fff;
        }

        .sidebar h2 {
            padding: 20px;
            text-align: center;
            background: #1a252f;
        }

        .sidebar a {
            display: block;
            padding: 15px 20px;
            color: #fff;
            text-decoration: none;
            border-bottom: 1px solid #34495e;
        }

        .sidebar a:hover {
            background: #34495e;
        }

        /* MAIN */
        .main {
            margin-left: 230px;
            min-height: 100vh;
        }

        /* TOPBAR */
        .topbar {
            background: #ffffff;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
        }

        .profile {
            background: #3498db;
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 14px;
        }

        /* CONTENT */
        .content {
            padding: 30px;
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-top: 15px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background: #f0f0f0;
        }

        /* FORM */
        input, button {
            padding: 8px;
            margin: 5px 0;
        }

        button {
            cursor: pointer;
        }
    </style>
</head>
<body>

<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Dashboard</h2>
   <a href="dashboard.php">Home</a>
<a href="produk.php">List Produk</a>
<a href="customer.php">Customer</a>
<a href="transaksi.php">Transaksi</a>
<a href="laporan.php">Laporan</a>
<a href="logout.php">Logout</a>

</div>

<!-- MAIN -->
<div class="main">

    <!-- TOPBAR -->
    <div class="topbar">
        <div><?= $title; ?></div>
        <div class="profile">
            <?= $_SESSION['name']; ?>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">
