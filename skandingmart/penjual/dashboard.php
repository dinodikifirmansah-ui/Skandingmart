<?php
session_start();
include '../config/database.php';

$id = $_SESSION['user']['id'];

$total_produk = mysqli_num_rows(mysqli_query($conn,
"SELECT * FROM products WHERE seller_id='$id'"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Penjual</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="sidebar">
    <h2>Penjual</h2>

    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="produk.php">Produk</a></li>
        <li><a href="tambah_produk.php">Tambah Produk</a></li>
        <li><a href="pesanan.php">Pesanan</a></li>
        <li><a href="profil.php">Profil</a></li>
    </ul>
</div>

<div class="main">
    <h1>Dashboard Penjual</h1>

    <div class="stats">
        <div class="box">
            <h2><?php echo $total_produk; ?></h2>
            <p>Total Produk</p>
        </div>
    </div>
</div>

</body>
</html>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
<?php include '../footer.php'; ?>