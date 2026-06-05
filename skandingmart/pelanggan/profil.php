<?php
session_start();
include '../config/database.php';

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil Pelanggan</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<nav class="navbar">
    <h2>SkandingMart</h2>

    <ul>
        <li><a href="dashboard.php">Home</a></li>
        <li><a href="produk.php">Produk</a></li>
        <li><a href="cart.php">Keranjang</a></li>
        <li><a href="profil.php">Profil</a></li>
    </ul>
</nav>

<div class="container">

    <div class="form-container">

        <center>
            <h1>Profil Saya</h1>
            <br>
            <img src="../assets/images/default.png"
            width="120"
            style="border-radius:50%; margin-bottom:20px;">

            <h2><?php echo $user['nama']; ?></h2>
            <p><?php echo $user['email']; ?></p>
        </center>

        <br>

        <table>
            <tr>
                <td><b>Nama</b></td>
                <td><?php echo $user['nama']; ?></td>
            </tr>

            <tr>
                <td><b>Email</b></td>
                <td><?php echo $user['email']; ?></td>
            </tr>

            <tr>
                <td><b>Role</b></td>
                <td><?php echo $user['role']; ?></td>
            </tr>
        </table>

        <br>

        <a href="riwayat.php"
class="btn btn-primary">

    Riwayat Pembelian

</a>

        <a href="../auth/logout.php" class="btn btn-danger">
            Logout
        </a>

    </div>

</div>

</body>
</html>
<?php include '../footer.php'; ?>