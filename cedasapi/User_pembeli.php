<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //update user
    include 'DatabaseConfig.php';
    $conn = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);        
    
    //read JSON from client
    $json = file_get_contents('php://input', true);
    $obj = json_decode($json);

    //get JSON object
    $username_pembeli = $obj->username_pembeli;
    $nama_pembeli = $obj->nama_pembeli;
    $email_pembeli = $obj->email_pembeli;
    $alamat_pembeli = $obj->alamat_pembeli;
    $jenis_kelamin_pem = $obj->jenis_kelamin_pem;
    // $password_pembeli = $obj->password_pembeli;
    $no_hp_pembeli = $obj->no_hp_pembeli;
    $tgl_lahir_pem = $obj->tgl_lahir_pem;
    $gambar_pembeli = $obj->gambar_pembeli;

    

    $query_update = "UPDATE pembeli 
                 SET nama_pembeli = '$nama_pembeli',
                 email_pembeli = '$email_pembeli', 
                 alamat_pembeli = '$alamat_pembeli', 
                 no_hp_pembeli = '$no_hp_pembeli', 
                 tgl_lahir_pem = '$tgl_lahir_pem',
                 jenis_kelamin_pem = '$jenis_kelamin_pem',
                 gambar_pembeli = '$gambar_pembeli' 
                 WHERE username_pembeli = '$username_pembeli'";

    $query = mysqli_query($conn, $query_update);
    $check = mysqli_affected_rows($conn);
    $json_array = array();
    $response = "";

    if ($check > 0) {
        $response = array(
            'code' => 200,
            'status' => 'Data Sukses Diperbarui!'
        );
    } else {
        $response = array(
            'code' => 400,
            'status' => 'Data Gagal Diperbaharui!'
        );
    }

    print(json_encode($response));
    mysqli_close($conn);

} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include 'DatabaseConfig.php';
    $conn = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);
    // select specific user
    if (isset($_GET['username_pembeli'])) {
        $username = mysqli_real_escape_string($conn, $_GET['username_pembeli']);
        $query_select = "SELECT * FROM pembeli WHERE username_pembeli = '$username'";
        $result = mysqli_query($conn, $query_select);
        $json_array = array();
        $response = "";

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Mengenkripsi gambar ke format Base64
                $row['gambar_pembeli'] = base64_encode($row['gambar_pembeli']);
                $json_array[] = $row;
            }
            $response = array(
                'code' => 200,
                'status' => 'Successful',
                'register_list' => $json_array
            );
        } else {
            $response = array(
                'code' => 400,
                'status' => 'Error: ' . mysqli_error($conn),
                'register_list' => null
            );
        }
    } else {
        // Handle the case where 'nama_barang' is not set in the GET parameters
        $response = array(
            'code' => 400,
            'status' => 'Bad Request: Missing parameter "username"',
            'register_list' => null
        );
    }

    print(json_encode($response));
    mysqli_close($conn);

} elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    // delete specific user
    include 'DatabaseConfig.php';
    $conn = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);

    $user_id = $_GET['id'];
    $user_id = mysqli_real_escape_string($conn, $user_id); // SQL injection prevention

    $query_delete = "DELETE FROM user WHERE id = '$user_id'";
    $result = mysqli_query($conn, $query_delete);
    $check = mysqli_affected_rows($conn);
    $response = "";

    if ($check > 0) {
        $response = array(
            'code' => 200,
            'status' => 'Data terhapus!'
        );
    } else {
        $response = array(
            'code' => 404,
            'status' => 'Gagal dihapus!'
        );
    }
    print(json_encode($response));
    mysqli_close($conn);
}
?>
