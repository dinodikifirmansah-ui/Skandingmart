<?php
session_start();
include '../config/database.php';

$cari = "";

if(isset($_GET['cari'])){
    $cari = $_GET['cari'];
    $query = mysqli_query($conn,
    "SELECT * FROM products
    WHERE nama_produk LIKE '%$cari%'");
}else{
    $query = mysqli_query($conn,
    "SELECT * FROM products");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Produk</title>
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

    <form method="GET" class="search-box">
        <input type="text" name="cari" placeholder="Cari produk...">
        <button>Cari</button>
    </form>

    <div class="product-grid">

    <?php while($p = mysqli_fetch_assoc($query)){ ?>

        <div class="card">

            <img src="../assets/images/<?php echo $p['gambar']; ?>">

            <div class="card-content">

                <h3><?php echo $p['nama_produk']; ?></h3>

                <div class="price">
                    Rp <?php echo number_format($p['harga']); ?>
                </div>

                <p>Stok : <?php echo $p['stok']; ?></p>

                <a href="cart.php?id=<?php echo $p['id']; ?>">
                    <button>Beli</button>
                </a>

            </div>

        </div>

    <?php } ?>

    </div>

</div>

</body>
</html>
<?php include '../footer.php'; ?>