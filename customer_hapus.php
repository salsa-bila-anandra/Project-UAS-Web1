<?php
include "koneksi.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM customer WHERE id_customer='$id'");

header("Location: customer.php");
exit;
?>
