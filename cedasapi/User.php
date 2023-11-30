<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //update user
    include 'DatabaseConfig.php';
    $conn = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);        
    
    //read JSON from client
    $json = file_get_contents('php://input', true);
    $obj = json_decode($json);

    //get JSON object
    $id = $obj->id;
    $username = $obj->username;
    $email = $obj->email;
    $alamat = $obj->alamat;
    $no_hp = $obj->no_hp;
    $tgl_lahir = $obj->tgl_lahir;
    $gambar = $obj->gambar;
    

    $query_update = "UPDATE user 
                 SET username = '$username', 
                     email = '$email', 
                     alamat = '$alamat', 
                     no_hp = '$no_hp', 
                     tgl_lahir = '$tgl_lahir',
                     gambar = '$gambar' 
                 WHERE id = '$id'";

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
    if (isset($_GET['username'])) {
        $username = mysqli_real_escape_string($conn, $_GET['username']);
        $query_select = "SELECT * FROM user WHERE username = '$username'";
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
                'user_list' => $json_array
            );
        } else {
            $response = array(
                'code' => 400,
                'status' => 'Error: ' . mysqli_error($conn),
                'user_list' => null
            );
        }
    } else {
        // Handle the case where 'nama_barang' is not set in the GET parameters
        $response = array(
            'code' => 400,
            'status' => 'Bad Request: Missing parameter "username"',
            'user_list' => null
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
