<?php
include '../config/database.php';

$query = mysqli_query($conn, "SELECT id, stok FROM products");
$data = [];

while($d = mysqli_fetch_assoc($query)){
    $data[] = $d;
}

header('Content-Type: application/json');
echo json_encode($data);
?>