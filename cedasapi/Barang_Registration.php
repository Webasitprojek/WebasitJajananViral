<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'DatabaseConfig.php';
    $conn = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);

    // Baca JSON dari klien
    $json = file_get_contents('php://input', true);
    $obj = json_decode($json);

    // Periksa apakah properti JSON ada
    if (isset($obj->id_barang) && isset($obj->nama_barang) && isset($obj->harga) && isset($obj->deskripsi) && isset($obj->link) && isset($obj->gambar) && isset($obj->tgl_lahir)) {
        $id_barang = $obj->id_barang;
        $nama_barang = $obj->nama_barang;
        $harga = $obj->harga;
        $deskripsi = $obj->deskripsi;
        $link = $obj->link;
        $gambar = $obj->gambar; // Nama variabel diubah
        $tgl_lahir = $obj->tgl_lahir;

        $query_check = "SELECT * FROM barang WHERE id_barang = '$id_barang'";
        $check = mysqli_fetch_array(mysqli_query($conn, $query_check));
        $response = "";

        if (isset($check)) {
            $response = array(
                'code' => 406,
                'status' => 'User has been registered!'
            );
        } else {
            $query_insert = "INSERT INTO barang (id_barang, nama_barang, harga, deskripsi, link, gambar, tgl_lahir) VALUES 
            ('$id_barang', '$nama_barang', '$harga', '$deskripsi', '$link', '$gambar', '$tgl_lahir')";
            if (mysqli_query($conn, $query_insert)) {
                $response = array(
                    'code' => 201,
                    'status' => 'User Registered'
                );
            } else {
                $response = array(
                    'code' => 405,
                    'status' => 'Registration Error!'
                );
            }
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
    $query_select = "SELECT * FROM barang LIMIT 3";
    $result = mysqli_query($conn, $query_select);
    $json_array = array();
    $response = "";

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Mengenkripsi gambar ke format Base64
            $row['gambar'] = base64_encode($row['gambar']);
            $json_array[] = $row;
        }
        $response = array(
            'code' => 200,
            'status' => 'Successful',
            'barang_list' => $json_array
        );
    } else {
        $response = array(
            'code' => 400,
            'status' => 'Error: ' . mysqli_error($conn),
            'barang_list' => null
        );
    }
    print(json_encode($response));
    mysqli_close($conn);
}


?>
