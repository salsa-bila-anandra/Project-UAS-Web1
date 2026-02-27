<?php
session_start();
include "koneksi.php";

error_reporting(E_ALL);
ini_set("display_errors", 1);

$error = "";

/* =======================================
✅ CEK KONEKSI DATABASE
======================================= */
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

/* =======================================
✅ AUTO BUAT USER ADMIN DEFAULT
Username : admin
Password : 12345
======================================= */
$cek = mysqli_query($conn, "SELECT * FROM users WHERE username='admin'");

if (mysqli_num_rows($cek) == 0) {

    $hash = password_hash("12345", PASSWORD_DEFAULT);

    mysqli_query($conn, "
        INSERT INTO users(username,email,password,role)
        VALUES('admin','admin@gmail.com','$hash','admin')
    ");
}

/* =======================================
✅ PROSES LOGIN
======================================= */
if (isset($_POST["login"])) {

    $input    = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    // Cari user
    $query = mysqli_query($conn, "
        SELECT * FROM users 
        WHERE username='$input' OR email='$input'
        LIMIT 1
    ");

    if (!$query) {
        die("Query Error: " . mysqli_error($conn));
    }

    $user = mysqli_fetch_assoc($query);

    // Jika user ditemukan dan password cocok
    if ($user && $password == $user["password"]) {
 

        $_SESSION["login"] = true;
        $_SESSION["user"]  = $user;

        header("Location: dashboard.php");
        exit;

    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Penjualan</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: white;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            width: 380px;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 12px;
            box-shadow: 0px 0px 12px rgba(0,0,0,0.15);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            width: 100%;
            padding: 12px;
            background: black;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        button:hover {
            background: #333;
        }

        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        .info {
            margin-top: 15px;
            font-size: 13px;
            color: gray;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-box">

    <h2>Login Penjualan</h2>

    <?php if ($error != "") : ?>
        <p class="error"><?= $error; ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username / Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login">Login</button>
    </form>

    <div class="info">
        <b>Default Admin:</b><br>
        Username: <b>admin</b><br>
        Password: <b>12345</b>
    </div>

</div>

</body>
</html>
