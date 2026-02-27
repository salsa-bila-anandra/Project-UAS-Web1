<?php
session_start();
include 'koneksi.php';

$customer_id = $_POST['customer_id'];
$qtys        = $_POST['qty'];

$total = 0;

// hitung total
foreach ($qtys as $pid => $qty) {
    if ($qty > 0) {
        $p = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id=$pid"));
        $subtotal = $p['price'] * $qty;
        $total += $subtotal;
    }
}

// simpan transaksi
mysqli_query($conn, "INSERT INTO transactions VALUES (NULL,'$customer_id','$total',NOW())");
$transaction_id = mysqli_insert_id($conn);

// simpan detail + update stok
foreach ($qtys as $pid => $qty) {
    if ($qty > 0) {
        $p = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id=$pid"));
        $subtotal = $p['price'] * $qty;

        mysqli_query($conn, "INSERT INTO transaction_details 
            VALUES (NULL,'$transaction_id','$pid','{$p['price']}','$qty','$subtotal')");

        mysqli_query($conn, "UPDATE products SET stock = stock - $qty WHERE id=$pid");
    }
}

header("Location: transaksi.php");
exit;
