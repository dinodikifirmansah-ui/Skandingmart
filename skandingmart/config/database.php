<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "skandingmart";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Optional: set timezone
date_default_timezone_set('Asia/Jakarta');

?>