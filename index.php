<?php
session_start();
include 'koneksi.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass  = md5($_POST['password']);

    $q = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND password='$pass'");
    $u = mysqli_fetch_assoc($q);

    if ($u) {
        $_SESSION['login'] = true;
        $_SESSION['name']  = $u['name'];
        $_SESSION['role']  = $u['role'];
        header("Location: dashboard.php");
        exit;
    } else {
        $err = "Email / Password salah";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<h2>Login</h2>
<?php if (isset($err)) echo "<p style='color:red'>$err</p>"; ?>
<form method="post">
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button name="login">Login</button>
</form>
</body>
</html>
