<?php
session_start();
include '../config/database.php';

/*
|--------------------------------------------------------------------------
| CEK LOGIN PENJUAL
|--------------------------------------------------------------------------
*/

if(!isset($_SESSION['user'])){

    header("Location: ../auth/login.php");
    exit;
}

if($_SESSION['user']['role'] != 'penjual'){

    header("Location: ../index.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| SIMPAN PRODUK
|--------------------------------------------------------------------------
*/

if(isset($_POST['simpan'])){

    $seller     = $_SESSION['user']['id'];

    $nama       = mysqli_real_escape_string($conn,
                    $_POST['nama_produk']);

    $deskripsi  = mysqli_real_escape_string($conn,
                    $_POST['deskripsi']);

    $harga      = $_POST['harga'];
    $stok       = $_POST['stok'];

    $kategori   = mysqli_real_escape_string($conn,
                    $_POST['kategori']);

    /*
    |--------------------------------------------------------------------------
    | VALIDASI GAMBAR
    |--------------------------------------------------------------------------
    */

    $gambar     = $_FILES['gambar']['name'];
    $tmp        = $_FILES['gambar']['tmp_name'];
    $size       = $_FILES['gambar']['size'];

    $ekstensi = strtolower(
        pathinfo($gambar, PATHINFO_EXTENSION)
    );

    $allowed = ['jpg','jpeg','png','webp'];

    if(!in_array($ekstensi, $allowed)){

        echo "
        <script>
        alert('Format gambar tidak didukung!');
        </script>
        ";

    }else{

        /*
        |--------------------------------------------------------------------------
        | RENAME FILE
        |--------------------------------------------------------------------------
        */

        $nama_gambar = time().'_'.$gambar;

        move_uploaded_file(
            $tmp,
            '../assets/images/'.$nama_gambar
        );

        /*
        |--------------------------------------------------------------------------
        | STATUS STOK
        |--------------------------------------------------------------------------
        */

        if($stok <= 0){

            $status = "Habis";

        }elseif($stok <= 5){

            $status = "Hampir Habis";

        }else{

            $status = "Tersedia";
        }

        /*
        |--------------------------------------------------------------------------
        | INSERT DATABASE
        |--------------------------------------------------------------------------
        */

        mysqli_query($conn,

        "INSERT INTO products
        (
            seller_id,
            nama_produk,
            deskripsi,
            harga,
            stok,
            gambar,
            kategori,
            status
        )

        VALUES
        (
            '$seller',
            '$nama',
            '$deskripsi',
            '$harga',
            '$stok',
            '$nama_gambar',
            '$kategori',
            '$status'
        )"

        );

        /*
        |--------------------------------------------------------------------------
        | NOTIFIKASI
        |--------------------------------------------------------------------------
        */

        mysqli_query($conn,

        "INSERT INTO notifications
        (
            user_id,
            pesan
        )

        VALUES
        (
            '$seller',
            'Produk baru berhasil ditambahkan'
        )"

        );

        echo "
        <script>

        alert('Produk berhasil ditambahkan');

        window.location='produk.php';

        </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Tambah Produk</title>

    <link rel="stylesheet"
    href="../assets/css/style.css">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

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

    <div class="form-container">

        <h1>
            Tambah Produk Baru
        </h1>

        <br>

        <form method="POST"
        enctype="multipart/form-data">

            <!-- Nama Produk -->

            <label>Nama Produk</label>

            <input type="text"
            name="nama_produk"
            placeholder="Masukkan nama produk"
            required>

            <!-- Deskripsi -->

            <label>Deskripsi Produk</label>

            <textarea
            name="deskripsi"
            placeholder="Deskripsi produk..."
            required></textarea>

            <!-- Harga -->

            <label>Harga Produk</label>

            <input type="number"
            name="harga"
            placeholder="Masukkan harga"
            required>

            <!-- Stok -->

            <label>Jumlah Stok</label>

            <input type="number"
            name="stok"
            placeholder="Masukkan stok"
            required>

            <!-- Kategori -->

            <label>Kategori</label>

            <select name="kategori" required>

                <option value="">
                    -- Pilih Kategori --
                </option>

                <option value="Elektronik">
                    Elektronik
                </option>

                <option value="Fashion">
                    Fashion
                </option>

                <option value="Makanan">
                    Makanan
                </option>

                <option value="Minuman">
                    Minuman
                </option>

                <option value="Aksesoris">
                    Aksesoris
                </option>

            </select>

            <!-- Upload -->

            <label>Upload Gambar</label>

            <input type="file"
            name="gambar"
            required>

            <br><br>

            <!-- Tombol -->

            <button type="submit"
            name="simpan"
            class="btn btn-primary">

                <i class="fa-solid fa-floppy-disk"></i>

                Simpan Produk

            </button>

        </form>

    </div>

</div>

</body>
</html>
<?php include '../footer.php'; ?>