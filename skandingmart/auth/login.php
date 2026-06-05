<?php
session_start();
include '../config/database.php';

if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $data = mysqli_fetch_assoc($query);

    if($data && password_verify($password, $data['password'])){
        $_SESSION['user'] = $data;

        if($data['role'] == 'penjual'){
            header('Location: ../penjual/dashboard.php');
        } else {
            header('Location: ../pelanggan/dashboard.php');
        }
    } else {
        echo "Login gagal";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login SkandingMart</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="login-body">

<div class="login-container">
    <h1>SkandingMart</h1>

    <form method="POST">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">LOGIN</button>
    </form>

    <a href="register.php">Belum punya akun?</a>
</div>

</body>
</html>