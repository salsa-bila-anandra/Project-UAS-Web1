<?php
$conn = mysqli_connect("localhost","root","","db_kasir");

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM customer WHERE id_customer='$id'");

header("location:customer.php");
?>