<?php
session_start();
include '../config/database.php';

$id = $_SESSION['user']['id'];

$data = mysqli_query($conn,
"SELECT * FROM products
WHERE seller_id='$id'");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Produk Penjual</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="sidebar">

    <h2>SkandingMart</h2>

    <ul>

        <li>
            <a href="dashboard.php">
                Dashboard
            </a>
        </li>

        <li>
            <a href="produk.php">
                Produk
            </a>
        </li>

        <li>
            <a href="tambah_produk.php">
                Tambah Produk
            </a>
        </li>

        <li>
            <a href="pesanan.php">
                Pesanan
            </a>
        </li>

        <li>
            <a href="profil.php">
                Profil
            </a>
        </li>

    </ul>

</div>

<div class="main">

    <h1>Data Produk</h1>

    <a href="tambah_produk.php"
    class="btn btn-primary">
        Tambah Produk
    </a>

    <br><br>

    <table>

        <tr>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Status</th>
        </tr>

        <?php while($p = mysqli_fetch_assoc($data)){ ?>

        <tr>

            <td>
                <img width="80"
                src="../assets/images/<?php echo $p['gambar']; ?>">
            </td>

            <td><?php echo $p['nama_produk']; ?></td>

            <td>
                Rp <?php echo number_format($p['harga']); ?>
            </td>

            <td><?php echo $p['stok']; ?></td>

            <td><?php echo $p['status']; ?></td>

        </tr>

        <?php } ?>

    </table>

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

<?php include '../footer.php'; ?>