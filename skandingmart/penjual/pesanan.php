<?php
session_start();
include '../config/database.php';

/*
|--------------------------------------------------------------------------
| CEK LOGIN
|--------------------------------------------------------------------------
*/

if(!isset($_SESSION['user'])){

    header("Location: ../auth/login.php");
    exit;
}

$id_penjual = $_SESSION['user']['id'];

/*
|--------------------------------------------------------------------------
| AMBIL PESANAN SESUAI PENJUAL
|--------------------------------------------------------------------------
|
| Hanya menampilkan pesanan
| dari produk milik penjual ini
|
*/

$data = mysqli_query($conn,

"SELECT
orders.id,
orders.total_harga,
orders.status,
orders.metode_pembayaran,
orders.created_at,
users.nama

FROM order_items

JOIN orders
ON order_items.order_id = orders.id

JOIN products
ON order_items.product_id = products.id

JOIN users
ON orders.user_id = users.id

WHERE products.seller_id = '$id_penjual'

GROUP BY orders.id

ORDER BY orders.id DESC"

);

?>

<!DOCTYPE html>
<html>
<head>

    <title>Pesanan Penjual</title>

    <link rel="stylesheet"
    href="../assets/css/style.css">

</head>
<body>

<!-- =========================
     SIDEBAR
========================= -->

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

<!-- =========================
     MAIN CONTENT
========================= -->

<div class="main">

    <h1>Data Pesanan</h1>

    <br>

    <table>

        <tr>
            <th>Pelanggan</th>
            <th>Total</th>
            <th>Status</th>
            <th>Pembayaran</th>
            <th>Tanggal</th>
        </tr>

        <?php while($o = mysqli_fetch_assoc($data)){ ?>

        <tr>

            <td>
                <?php echo $o['nama']; ?>
            </td>

            <td>
                Rp <?php echo number_format($o['total_harga']); ?>
            </td>

            <td>

                <?php
                if($o['status'] == 'Diproses'){
                    echo "<span class='btn btn-primary'>
                    Diproses
                    </span>";
                }elseif($o['status'] == 'Dikirim'){
                    echo "<span class='btn btn-success'>
                    Dikirim
                    </span>";
                }else{
                    echo $o['status'];
                }
                ?>

            </td>

            <td>
                <?php echo $o['metode_pembayaran']; ?>
            </td>

            <td>
                <?php echo $o['created_at']; ?>
            </td>

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
</br>
</br>
</br>
</br>
</br>
</br>
</br>
<?php include '../footer.php'; ?>