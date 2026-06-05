<?php
include '../config/database.php';

if(isset($_POST['register'])){
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    mysqli_query($conn, "INSERT INTO users(nama,email,password,role)
    VALUES('$nama','$email','$password','$role')");

    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body class="login-body">

<div class="login-container">
    <h1>Register</h1>

    <form method="POST">
        <input type="text" name="nama" placeholder="Nama" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>

        <select name="role">
            <option value="pelanggan">Pelanggan</option>
            <option value="penjual">Penjual</option>
        </select>

        <button type="submit" name="register">REGISTER</button>
    </form>
</div>

</body>
</html>