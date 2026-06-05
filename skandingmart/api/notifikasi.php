<?php

session_start();
include '../config/database.php';

header('Content-Type: application/json');

if(!isset($_SESSION['user'])){
    echo json_encode([
        'status' => 'error',
        'message' => 'User belum login'
    ]);
    exit;
}

$user_id = $_SESSION['user']['id'];

/*
|--------------------------------------------------------------------------
| AMBIL DATA NOTIFIKASI
|--------------------------------------------------------------------------
*/

$query = mysqli_query($conn,

"SELECT *
FROM notifications
WHERE user_id='$user_id'
ORDER BY id DESC
LIMIT 10"

);

$data = [];

while($notif = mysqli_fetch_assoc($query)){

    $data[] = [
        'id' => $notif['id'],
        'pesan' => $notif['pesan'],
        'status_baca' => $notif['status_baca'],
        'created_at' => $notif['created_at']
    ];
}

/*
|--------------------------------------------------------------------------
| HITUNG NOTIFIKASI BELUM DIBACA
|--------------------------------------------------------------------------
*/

$total = mysqli_num_rows(

mysqli_query($conn,

"SELECT *
FROM notifications
WHERE user_id='$user_id'
AND status_baca='0'"

)

);

/*
|--------------------------------------------------------------------------
| RESPONSE JSON
|--------------------------------------------------------------------------
*/

echo json_encode([
    'status' => 'success',
    'total_notifikasi' => $total,
    'data' => $data
]);

?>