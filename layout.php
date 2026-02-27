<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Penjualan</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f6fa;
        }

        /* =======================
           SIDEBAR MENU
        ======================= */
        .sidebar {
            width: 230px;
            height: 100vh;
            background: #1f2d3d;
            position: fixed;
            left: 0;
            top: 0;
            padding-top: 20px;
        }

        .sidebar h2 {
            color: white;
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar a {
            display: block;
            padding: 15px 20px;
            color: white;
            text-decoration: none;
            font-size: 16px;
        }

        .sidebar a:hover {
            background: #34495e;
        }

        /* =======================
           MAIN CONTENT
        ======================= */
        .content {
            margin-left: 230px;
            padding: 30px;
        }

        /* =======================
           USER TOP BUTTON (ADMIN)
        ======================= */
        .top-user {
            text-align: right;
            margin-bottom: 20px;
        }

        .user-button {
            background: white;
            padding: 8px 15px;
            border-radius: 20px;
            border: 1px solid #ddd;
            text-decoration: none;
            color: black;
            font-weight: bold;
            font-size: 14px;
            transition: 0.2s;
            box-shadow: 0px 0px 6px rgba(0,0,0,0.15);
        }

        .user-button:hover {
            background: #3498db;
            color: white;
            border-color: #3498db;
        }

        /* =======================
           CARD BOX
        ======================= */
        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0px 0px 12px rgba(0,0,0,0.1);
        }

        /* =======================
           BUTTON STYLE
        ======================= */
        .btn {
            padding: 6px 12px;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            font-size: 13px;
            margin: 2px;
            display: inline-block;
        }

        .btn-edit {
            background: #3498db;
        }

        .btn-edit:hover {
            background: #217dbb;
        }

        .btn-hapus {
            background: #e74c3c;
        }

        .btn-hapus:hover {
            background: #c0392b;
        }

        /* =======================
           TABLE STYLE
        ======================= */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
        }

        th {
            background: #f2f2f2;
            text-align: center;
        }

        td {
            text-align: center;
        }

        /* =======================
           FORM INPUT STYLE
        ======================= */
        input, select {
            padding: 10px;
            margin: 5px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            padding: 10px 15px;
            border-radius: 8px;
            background: black;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background: #444;
        }

        /* =======================
           PRINT MODE (LAPORAN)
        ======================= */
        @media print {
            .sidebar {
                display: none;
            }

            .content {
                margin-left: 0;
            }

            button {
                display: none;
            }

            .top-user {
                display: none;
            }
        }
    </style>
</head>

<body>

<!-- =======================
     SIDEBAR
======================= -->
<div class="sidebar">
    <h2>Dashboard</h2>

    <a href="dashboard.php">Home</a>
    <a href="customer.php">Customer</a>
    <a href="produk.php">Produk</a>
    <a href="transaksi.php">Transaksi</a>
    <a href="laporan.php">Laporan</a>
    <a href="logout.php">Logout</a>
</div>

<!-- =======================
     CONTENT AREA
======================= -->
<div class="content">

    <!-- Tombol User Admin -->
    <div class="top-user">
        <a href="profil.php" class="user-button">
            👤 <?= $user['username']; ?>
        </a>
    </div>

    <!-- Isi Halaman -->
    <div class="card">
        <?= $content; ?>
    </div>

</div>

</body>
</html>
