<?php

function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $randomString;
}

$statusbayar = "Menunggu Konfirmasi";
$idrandom = generateRandomString();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'DatabaseConfig.php';
    $conn = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);

    // Baca JSON dari klien
    $json = file_get_contents('php://input');
    $obj = json_decode($json);

    global $statusbayar;

    // Periksa apakah properti JSON ada
    if ($obj && property_exists($obj, 'username_pembeli') && property_exists($obj, 'total_harga') && property_exists($obj, 'detail_transaksi')) {
        $username_pembeli = $obj->username_pembeli;
        $total_harga = $obj->total_harga;

        // Setelah mengisi transaksi
        $query_insert = "INSERT INTO transaksi (id_transaksi, username_pembeli, tanggal, total_harga, status_pembayaran, bukti_pembayaran) VALUES 
        ('$idrandom', '$username_pembeli', CURRENT_DATE, '$total_harga', '$statusbayar', NULL)";

        if (mysqli_query($conn, $query_insert)) {
            // Dapatkan id_transaksi yang baru dibuat
            $query_last_id = "SELECT id_transaksi FROM transaksi ORDER BY id_transaksi DESC LIMIT 1";
            $result_last_id = mysqli_query($conn, $query_last_id);
            
            if ($result_last_id && $row = mysqli_fetch_assoc($result_last_id)) {
                $id_transaksi_baru = $row['id_transaksi'];

                // Loop untuk setiap item dalam detail transaksi
                foreach ($obj->detail_transaksi as $item) {
                    $id_barang = $item->id_barang;
                    $nama_barang = $item->nama_barang;
                    $qty = $item->qty;
                    $harga = $item->harga;

                    // Gunakan $id_transaksi_baru yang baru didapatkan
                    $query_insert2 = "INSERT INTO detail_transaksi (id_transaksi, nama_barang, id_barang, qty, harga) VALUES ('$id_transaksi_baru', '$nama_barang', '$id_barang', '$qty', '$harga')";

                    if (mysqli_query($conn, $query_insert2)) {
                        $response = array(
                            'code' => 201,
                            'status' => 'Barang Berhasil Di Beli'
                        );
                    } else {
                        $response = array(
                            'code' => 405,
                            'status' => 'Barang Error!'
                        );
                    }
                }
            } else {
                $response = array(
                    'code' => 405,
                    'status' => 'Gagal mendapatkan ID transaksi!'
                );
            }
        } else {
            $response = array(
                'code' => 405,
                'status' => 'Transaksi Error!'
            );
        }
    } else {
        // Tangani properti JSON yang hilang
        $response = array(
            'code' => 400,
            'status' => 'Bad Request: Missing JSON properties'
        );
    }

    print(json_encode($response));
    mysqli_close($conn);
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include 'DatabaseConfig.php';
    $conn = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);
    $query_select = "SELECT transaksi.id_transaksi, transaksi.username_pembeli, transaksi.tanggal, transaksi.total_harga, transaksi.status_pembayaran, transaksi.bukti_pembayaran, detail_transaksi.id_barang, detail_transaksi.nama_barang, detail_transaksi.qty, detail_transaksi.harga
    FROM transaksi
    JOIN detail_transaksi
    ON transaksi.id_transaksi = detail_transaksi.id_transaksi
    JOIN barang
    ON barang.id_barang = detail_transaksi.id_barang";
    $result = mysqli_query($conn, $query_select);
    $json_array = array();
    $response = "";

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Mengenkripsi gambar ke format Base64
            // $row['gambar'] = base64_encode($row['gambar']);
            $json_array[] = $row;
        }
        $response = array(
            'code' => 200,
            'status' => 'Successful',
            'transaksi_list' => $json_array
        );
    } else {
        $response = array(
            'code' => 400,
            'status' => 'Error: ' . mysqli_error($conn),
            'transaksi_list' => null
        );
    }
    print(json_encode($response));
    mysqli_close($conn);
}

?>
