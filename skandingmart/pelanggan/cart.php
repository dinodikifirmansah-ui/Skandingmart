<?php
session_start();
include '../config/database.php';

$user = $_SESSION['user']['id'];

if(isset($_GET['id'])){

    $product = $_GET['id'];

    mysqli_query($conn,
    "INSERT INTO carts(user_id,product_id,qty)
    VALUES('$user','$product','1')");
}

$data = mysqli_query($conn,
"SELECT carts.*, products.nama_produk,
products.harga, products.gambar

FROM carts
JOIN products ON carts.product_id = products.id
WHERE carts.user_id='$user'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Keranjang</title>
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

    <h1>Keranjang Belanja</h1>

    <table>

        <tr>
            <th>Produk</th>
            <th>Harga</th>
            <th>Qty</th>
            <th>Total</th>
        </tr>

        <?php
        $grand = 0;

        while($d = mysqli_fetch_assoc($data)){

        $total = $d['harga'] * $d['qty'];
        $grand += $total;
        ?>

        <tr>
            <td><?php echo $d['nama_produk']; ?></td>
            <td>Rp <?php echo number_format($d['harga']); ?></td>
            <td><?php echo $d['qty']; ?></td>
            <td>Rp <?php echo number_format($total); ?></td>
        </tr>

        <?php } ?>

        <tr>
            <td colspan="3">Grand Total</td>
            <td>Rp <?php echo number_format($grand); ?></td>
        </tr>

    </table>

    <br>

    <a href="checkout.php" class="btn btn-primary">
        Checkout
    </a>

</div>

</body>
</html>
<?php include '../footer.php'; ?>