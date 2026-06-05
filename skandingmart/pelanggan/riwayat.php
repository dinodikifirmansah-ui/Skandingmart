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

$user = $_SESSION['user']['id'];

/*
|--------------------------------------------------------------------------
| AMBIL DATA RIWAYAT
|--------------------------------------------------------------------------
*/

$data = mysqli_query($conn,

"SELECT *
FROM orders
WHERE user_id='$user'
ORDER BY id DESC"

);

?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Riwayat Pembelian</title>

    <link rel="stylesheet"
    href="../assets/css/style.css">

</head>
<body>

<!-- =========================
     NAVBAR
========================= -->

<nav class="navbar">

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
            <a href="cart.php">
                Keranjang
            </a>
        </li>

        <li>
            <a href="profil.php">
                Profil
            </a>
        </li>

    </ul>

</nav>

<!-- =========================
     CONTAINER
========================= -->

<div class="container">

    <h1>Riwayat Pembelian</h1>

    <br>

    <table>

        <tr>

            <th>ID Order</th>
            <th>Total</th>
            <th>Status</th>
            <th>Pembayaran</th>
            <th>Tanggal</th>

        </tr>

        <?php while($o = mysqli_fetch_assoc($data)){ ?>

        <tr>

            <td>
                #ORD-<?php echo $o['id']; ?>
            </td>

            <td>
                Rp <?php echo number_format($o['total_harga']); ?>
            </td>

            <td>

                <?php

                if($o['status'] == 'Diproses'){

                    echo "
                    <span class='btn btn-primary'>
                    Diproses
                    </span>
                    ";

                }elseif($o['status'] == 'Dikirim'){

                    echo "
                    <span class='btn btn-success'>
                    Dikirim
                    </span>
                    ";

                }elseif($o['status'] == 'Selesai'){

                    echo "
                    <span class='btn btn-success'>
                    Selesai
                    </span>
                    ";

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
<?php include '../footer.php'; ?>