<?php
session_start();
include 'config/database.php';

/*
|--------------------------------------------------------------------------
| CEK LOGIN
|--------------------------------------------------------------------------
*/

if(isset($_SESSION['user'])){

    // Jika role penjual
    if($_SESSION['user']['role'] == 'penjual'){

        header("Location: penjual/dashboard.php");
        exit;

    }

    // Jika role pelanggan
    if($_SESSION['user']['role'] == 'pelanggan'){

        header("Location: pelanggan/dashboard.php");
        exit;

    }

}

/*
|--------------------------------------------------------------------------
| AMBIL PRODUK DARI DATABASE
|--------------------------------------------------------------------------
*/


$query = mysqli_query($conn, "
    SELECT products.*, users.nama AS nama_penjual
    FROM products
    JOIN users ON products.seller_id = users.id
    ORDER BY products.id DESC
    LIMIT 8
");

?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SkandingMart</title>

    <link rel="stylesheet"
    href="assets/css/style.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>
<body>

<!-- =========================
     NAVBAR
========================= -->

<nav class="navbar">

    <h2>SkandingMart</h2>

    <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#produk">Produk</a></li>
        <li><a href="#tentang">Tentang</a></li>
        <li><a href="auth/login.php">Login</a></li>
    </ul>

</nav>

<!-- =========================
     HERO SECTION
========================= -->

<section class="hero" id="home">

    <div class="hero-text">

        <h1>Marketplace Modern & Real-Time</h1>

        <p>
            Belanja mudah, cepat, aman,
            dan pantau stok produk secara realtime.
        </p>

        <br>

        <a href="auth/register.php"
        class="btn btn-primary">

            Mulai Sekarang

        </a>

    </div>

</section>

<!-- =========================
     FITUR
========================= -->

<section class="container">

    <h1 style="margin-bottom:30px;">
        Fitur Unggulan
    </h1>

    <div class="stats">

        <div class="box">

            <i class="fa-solid fa-bolt"
            style="
            font-size:40px;
            color:#2563eb;
            margin-bottom:15px;
            "></i>

            <h3>Realtime Monitoring</h3>

            <p>
                Pantau stok dan produk secara langsung
                tanpa refresh halaman.
            </p>

        </div>

        <div class="box">

            <i class="fa-solid fa-lock"
            style="
            font-size:40px;
            color:#2563eb;
            margin-bottom:15px;
            "></i>

            <h3>Keamanan Tinggi</h3>

            <p>
                Sistem login aman dengan password hashing
                dan session security.
            </p>

        </div>

        <div class="box">

            <i class="fa-solid fa-cart-shopping"
            style="
            font-size:40px;
            color:#2563eb;
            margin-bottom:15px;
            "></i>

            <h3>Belanja Mudah</h3>

            <p>
                Tampilan modern dan responsive
                memudahkan pelanggan berbelanja.
            </p>

        </div>

    </div>

</section>

<!-- =========================
     PRODUK DATABASE
========================= -->

<section class="container" id="produk">

    <h1 style="margin-bottom:30px;">
        Produk Terbaru
    </h1>

    <div class="product-grid">

        <?php if(mysqli_num_rows($query) > 0){ ?>

            <?php while($produk = mysqli_fetch_assoc($query)){ ?>

                <div class="card">

                    <img 
src="assets/images/<?= $produk['gambar']; ?>" 
class="product-image">

                    <div class="card-content">

                        <h3>
                            <?= $produk['nama_produk']; ?>
                        </h3>

                        <div class="price">
                            Rp <?= number_format($produk['harga']); ?>
                        </div>

                        <p>
                            Stok : <?= $produk['stok']; ?>
                        </p>

                        <p style="
                        color:gray;
                        font-size:14px;
                        margin-top:5px;
                        ">
                            Penjual :
                            <?= $produk['nama_penjual']; ?>
                        </p>

                        <br>

                        <a href="auth/login.php">

                            <button>
                                Lihat Produk
                            </button>

                        </a>

                    </div>

                </div>

            <?php } ?>

        <?php } else { ?>

            <p>
                Belum ada produk ditambahkan.
            </p>

        <?php } ?>

    </div>

</section>

<!-- =========================
     ABOUT
========================= -->

<section class="container" id="tentang">

    <div class="box">

        <h1>Tentang SkandingMart</h1>

        <br>

        <p>
            SkandingMart adalah platform e-commerce modern
            berbasis PHP dan MySQL dengan fitur monitoring
            produk realtime, dashboard pelanggan dan penjual,
            serta desain profesional responsive.
        </p>

    </div>

</section>

<!-- =========================
     FOOTER
========================= -->

<?php include 'footer.php'; ?>

</body>
</html>