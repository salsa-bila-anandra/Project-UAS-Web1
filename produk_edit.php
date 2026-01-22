<?php
session_start();
include 'koneksi.php';
if (!isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$p  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id=$id"));

if (isset($_POST['update'])) {
    $name  = $_POST['name'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    mysqli_query($conn, "UPDATE products SET name='$name', price='$price', stock='$stock' WHERE id=$id");
    header("Location: produk.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
</head>
<body>

<h2>Edit Produk</h2>

<form method="post">
    <input type="text" name="name" value="<?= $p['name'] ?>" required>
    <input type="number" name="price" value="<?= $p['price'] ?>" required>
    <input type="number" name="stock" value="<?= $p['stock'] ?>" required>
    <button name="update">Update</button>
</form>

<br>
<a href="produk.php">⬅ Kembali</a>

</body>
</html>
