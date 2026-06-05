<?php
session_start();
include '../config/database.php';

if(!isset($_SESSION['user'])){
    header("Location: ../auth/login.php");
    exit;
}

$user = $_SESSION['user']['id'];

/*
|--------------------------------------------------------------------------
| AMBIL DATA CART
|--------------------------------------------------------------------------
*/

$cart = mysqli_query($conn,

"SELECT carts.*,
products.nama_produk,
products.harga,
products.seller_id

FROM carts

JOIN products
ON carts.product_id = products.id

WHERE carts.user_id='$user'"

);

/*
|--------------------------------------------------------------------------
| HITUNG TOTAL
|--------------------------------------------------------------------------
*/

$total = 0;

while($c = mysqli_fetch_assoc($cart)){

    $total += $c['harga'] * $c['qty'];
}

/*
|--------------------------------------------------------------------------
| CHECKOUT
|--------------------------------------------------------------------------
*/

if(isset($_POST['checkout'])){

    $alamat = $_POST['alamat'];
    $metode = $_POST['metode'];

    /*
    |--------------------------------------------------------------------------
    | INSERT ORDERS
    |--------------------------------------------------------------------------
    */

    mysqli_query($conn,

    "INSERT INTO orders
    (
        user_id,
        total_harga,
        status,
        alamat,
        metode_pembayaran
    )

    VALUES
    (
        '$user',
        '$total',
        'Diproses',
        '$alamat',
        '$metode'
    )"

    );

    /*
    |--------------------------------------------------------------------------
    | AMBIL ID ORDER TERBARU
    |--------------------------------------------------------------------------
    */

    $order_id = mysqli_insert_id($conn);

    /*
    |--------------------------------------------------------------------------
    | AMBIL ULANG CART
    |--------------------------------------------------------------------------
    */

    $cart2 = mysqli_query($conn,

    "SELECT carts.*,
    products.harga,
    products.stok,
    products.seller_id

    FROM carts

    JOIN products
    ON carts.product_id = products.id

    WHERE carts.user_id='$user'"

    );

    /*
    |--------------------------------------------------------------------------
    | INSERT ORDER ITEMS
    |--------------------------------------------------------------------------
    */

    while($item = mysqli_fetch_assoc($cart2)){

        $product_id = $item['product_id'];
        $qty        = $item['qty'];

        $subtotal   = $item['harga'] * $qty;

        /*
        |--------------------------------------------------------------------------
        | INSERT DETAIL PESANAN
        |--------------------------------------------------------------------------
        */

        mysqli_query($conn,

        "INSERT INTO order_items
        (
            order_id,
            product_id,
            qty,
            subtotal
        )

        VALUES
        (
            '$order_id',
            '$product_id',
            '$qty',
            '$subtotal'
        )"

        );

        /*
        |--------------------------------------------------------------------------
        | UPDATE STOK
        |--------------------------------------------------------------------------
        */

        $stok_baru = $item['stok'] - $qty;

        if($stok_baru <= 0){

            $status = "Habis";

        }elseif($stok_baru <= 5){

            $status = "Hampir Habis";

        }else{

            $status = "Tersedia";
        }

        mysqli_query($conn,

        "UPDATE products

        SET
        stok='$stok_baru',
        status='$status'

        WHERE id='$product_id'"

        );

        /*
        |--------------------------------------------------------------------------
        | NOTIFIKASI PENJUAL
        |--------------------------------------------------------------------------
        */

        $seller = $item['seller_id'];

        mysqli_query($conn,

        "INSERT INTO notifications
        (
            user_id,
            pesan
        )

        VALUES
        (
            '$seller',
            'Pesanan baru masuk'
        )"

        );
    }

    /*
    |--------------------------------------------------------------------------
    | HAPUS CART
    |--------------------------------------------------------------------------
    */

    mysqli_query($conn,
    "DELETE FROM carts WHERE user_id='$user'");

    $success = true;
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Checkout</title>

    <link rel="stylesheet"
    href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

</head>
<body>

<div class="main">

    <div class="form-container">

        <h1>Checkout</h1>

        <br>

        <form method="POST">

            <label>Alamat Lengkap</label>

            <textarea
            name="alamat"
            required></textarea>

            <br><br>

            <label>Metode Pembayaran</label>

            <select name="metode">

                <option value="COD">
                    COD
                </option>

                <option value="Transfer Bank">
                    Transfer Bank
                </option>

                <option value="E-Wallet">
                    E-Wallet
                </option>

            </select>

            <br><br>

            <button
            type="submit"
            name="checkout"
            class="btn btn-primary">

                Bayar Sekarang

            </button>

        </form>

    </div>

</div>

<!-- ==========================
     NOTIFIKASI MODERN
========================== -->

<div id="notifBox" class="notif-container">

    <div class="notif-content">

        <div class="notif-icon">
            ✓
        </div>

        <h2>Berhasil</h2>

        <p id="notifText">
            Checkout berhasil
        </p>

        <button onclick="closeNotif()">
            Oke
        </button>

    </div>

</div>

<script>

function showNotif(message){

    document.getElementById('notifText').innerText = message;

    document.getElementById('notifBox')
    .classList.add('show');
}

function closeNotif(){

    window.location = 'dashboard.php';
}

</script>

<?php if(isset($success)){ ?>

<script>

window.onload = function(){

    showNotif('Checkout berhasil');

}

</script>

<?php } ?>

</body>
</html>

<?php include '../footer.php'; ?>