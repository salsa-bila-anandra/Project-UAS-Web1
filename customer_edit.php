<?php
$title = "Edit Customer";
include 'layout.php';
include 'koneksi.php';

$id = $_GET['id'];
$c  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM customers WHERE id=$id"));

if (isset($_POST['update'])) {
    $name    = $_POST['name'];
    $phone   = $_POST['phone'];
    $address = $_POST['address'];

    mysqli_query($conn, "UPDATE customers SET 
        name='$name', phone='$phone', address='$address'
        WHERE id=$id");

    header("Location: customer.php");
}
?>

<h2>Edit Customer</h2>

<form method="post">
    <input type="text" name="name" value="<?= $c['name'] ?>" required>
    <input type="text" name="phone" value="<?= $c['phone'] ?>" required>
    <input type="text" name="address" value="<?= $c['address'] ?>" required>
    <button name="update">Update</button>
</form>

    </div>
</div>
</body>
</html>
