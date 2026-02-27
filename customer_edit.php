<?php
include "koneksi.php";

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

/* ===============================
✅ AMBIL DATA CUSTOMER
=============================== */
$stmt = mysqli_prepare($conn, "SELECT * FROM customer WHERE id_customer = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$cust = mysqli_fetch_assoc($result);

if (!$cust) {
    die("Customer tidak ditemukan");
}

/* ===============================
✅ UPDATE DATA CUSTOMER
=============================== */
if (isset($_POST['update'])) {

    $nama   = $_POST['nama'];
    $telp   = $_POST['telp'];
    $alamat = $_POST['alamat'];

    $stmt = mysqli_prepare($conn, "UPDATE customer 
        SET nama_customer = ?,
            telepon = ?,
            alamat = ?
        WHERE id_customer = ?
    ");
    
    mysqli_stmt_bind_param($stmt, "sssi", $nama, $telp, $alamat, $id);
    $result = mysqli_stmt_execute($stmt);
    
    if ($result) {
        header("Location: customer.php");
        exit;
    } else {
        $error = "Gagal update data: " . mysqli_error($conn);
    }
}

$error_msg = isset($error) ? "<p style='color:red;'>$error</p>" : "";

$content = "
<h2>Edit Customer</h2>

$error_msg

<form method='POST'>
    <input type='text' name='nama' value='" . htmlspecialchars($cust['nama_customer']) . "' required>
    <input type='text' name='telp' value='" . htmlspecialchars($cust['telepon']) . "' required>
    <input type='text' name='alamat' value='" . htmlspecialchars($cust['alamat']) . "' required>

    <button name='update'>Update</button>
    <a href='customer.php'>Kembali</a>
</form>
";

include "layout.php";
?>
