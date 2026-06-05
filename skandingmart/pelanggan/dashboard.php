<?php
session_start();
include '../config/database.php';

$data = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Pelanggan</title>
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

    <div class="hero">
        <div class="hero-text">
            <h1>Belanja Mudah di SkandingMart</h1>
            <p>Temukan produk terbaik dengan harga terjangkau.</p>
        </div>
    </div>

    <div class="product-grid">

    <?php while($p = mysqli_fetch_assoc($data)){ ?>

        <div class="card">

            <img src="../assets/images/<?php echo $p['gambar']; ?>">

            <div class="card-content">

                <h3><?php echo $p['nama_produk']; ?></h3>

                <div class="price">
                    Rp <?php echo number_format($p['harga']); ?>
                </div>

                <p id="stok-<?php echo $p['id']; ?>">
                    Stok : <?php echo $p['stok']; ?>
                </p>

                <a href="cart.php?id=<?php echo $p['id']; ?>">
                    <button>Beli</button>
                </a>

            </div>

        </div>

    <?php } ?>

    </div>

</div>

<script src="../assets/js/realtime.js"></script>

</body>
</html>
<?php include '../footer.php'; ?>