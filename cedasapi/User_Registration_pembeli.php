<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'DatabaseConfig.php';
    $conn = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);        
    
    // Read JSON from client
    $json = file_get_contents('php://input', true);
    $obj = json_decode($json);

    // Check if JSON properties exist
    if(isset($obj->username_pembeli) && isset($obj->nama_pembeli) && isset($obj->email_pembeli) && isset($obj->alamat_pembeli) && isset($obj->jenis_kelamin_pem) && isset($obj->password_pembeli) && isset($obj->no_hp_pembeli) && isset($obj->tgl_lahir_pem) && isset($obj->gambar_pembeli)) {
        $username_pembeli = $obj->username_pembeli;
        $nama_pembeli = $obj->nama_pembeli;
        $email_pembeli = $obj->email_pembeli;
        $alamat_pembeli = $obj->alamat_pembeli;
        $jenis_kelamin_pem = $obj->jenis_kelamin_pem;
        $password_pembeli = $obj->password_pembeli;
        $no_hp_pembeli = $obj->no_hp_pembeli;
        $tgl_lahir_pem = $obj->tgl_lahir_pem;
        $gambar_pembeli = $obj->gambar_pembeli;

        $query_check = "select * from pembeli where username_pembeli = '$username_pembeli'";
        $check = mysqli_fetch_array(mysqli_query($conn, $query_check));        
        $json_array = array();
        $response = "";

        if (isset($check)) {
            $response = array(
                'code' => 406,
                'status' => 'Akun ini sudah ada!'
            );
        } else {
            $password_pembeli = password_hash($password_pembeli, PASSWORD_DEFAULT);
            $query_insert = "INSERT INTO pembeli (username_pembeli, nama_pembeli, no_hp_pembeli, email_pembeli, jenis_kelamin_pem, tgl_lahir_pem, alamat_pembeli, password_pembeli, gambar_pembeli) VALUES 
            ('$username_pembeli', '$nama_pembeli', '$no_hp_pembeli', '$email_pembeli', '$jenis_kelamin_pem', '$tgl_lahir_pem', '$alamat_pembeli', '$password_pembeli', '$gambar_pembeli')";
            if (mysqli_query($conn, $query_insert)) {
                $response = array(
                    'code' => 201,
                    'status' => 'Anda Berhasil Registrasi'
                );
            } else {
                $response = array(
                    'code' => 405,
                    'status' => 'Registrati Gagal!'
                );
            }
        }
    } else {
        // Handle missing JSON properties
        $response = array(
            'code' => 400,
            'status' => 'Bad Request: Missing JSON properties'
        );
    }

    print(json_encode($response));
    mysqli_close($conn);
} elseif($_SERVER['REQUEST_METHOD'] == 'GET') {
    include 'DatabaseConfig.php';
    $conn = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);        
    $query_insert = "select * from pembeli";
    $result = mysqli_query($conn, $query_insert);
    $json_array = array();
    $response = "";

    if (isset($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
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
            'status' => 'Error',
            'register_list' => 0
        );
    }
    print(json_encode($response));
    mysqli_close($conn);
}
?>