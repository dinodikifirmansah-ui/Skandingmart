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

/*
|--------------------------------------------------------------------------
| AMBIL DATA USER
|--------------------------------------------------------------------------
*/

$id_user = $_SESSION['user']['id'];

$query = mysqli_query($conn,
"SELECT * FROM users WHERE id='$id_user'");

$user = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Profil Penjual</title>

    <link rel="stylesheet"
    href="../assets/css/style.css">

</head>
<body>

<!-- =========================
     SIDEBAR
========================= -->

<div class="sidebar">

    <h2>Penjual</h2>

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

        <center>

            <h1>Profil Penjual</h1>

            <br>

            <img
            src="../assets/images/default.png"
            width="120"

            style="
            border-radius:50%;
            margin-bottom:20px;
            object-fit:cover;
            ">

            <h2>
                <?php echo $user['nama']; ?>
            </h2>

            <p>
                <?php echo $user['email']; ?>
            </p>

        </center>

        <br>

        <table>

            <tr>
                <td width="200">
                    <b>Nama</b>
                </td>

                <td>
                    <?php echo $user['nama']; ?>
                </td>
            </tr>

            <tr>
                <td>
                    <b>Email</b>
                </td>

                <td>
                    <?php echo $user['email']; ?>
                </td>
            </tr>

            <tr>
                <td>
                    <b>Role</b>
                </td>

                <td>
                    <?php echo ucfirst($user['role']); ?>
                </td>
            </tr>

            <tr>
                <td>
                    <b>ID Penjual</b>
                </td>

                <td>
                    #SELLER-<?php echo $user['id']; ?>
                </td>
            </tr>

        </table>

        <br>

        <a href="../auth/logout.php"
        class="btn btn-danger">

            Logout

        </a>

    </div>

</div>

</body>
</html>
</br>
</br>
</br>
<?php include '../footer.php'; ?>