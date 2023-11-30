<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'DatabaseConfig.php';
    $conn = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);        
    
    // Read JSON from client
    $json = file_get_contents('php://input', true);
    $obj = json_decode($json);

    // Check if JSON properties exist
    if(isset($obj->username) && isset($obj->email) && isset($obj->alamat) && isset($obj->jenis_kelamin) && isset($obj->password) && isset($obj->no_hp) && isset($obj->tgl_lahir)) {
        $username = $obj->username;
        $email = $obj->email;
        $alamat = $obj->alamat;
        $jk = $obj->jenis_kelamin;
        $password = $obj->password;
        $nohp = $obj->no_hp;
        $lahir = $obj->tgl_lahir;

        $query_check = "select * from user where username = '$username'";
        $check = mysqli_fetch_array(mysqli_query($conn, $query_check));        
        $json_array = array();
        $response = "";

        if (isset($check)) {
            $response = array(
                'code' => 406,
                'status' => 'User has been registered!'
            );
        } else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $query_insert = "insert into user (username, email, alamat, jenis_kelamin, password, no_hp, tgl_lahir) values 
            ('$username', '$email', '$alamat', '$jk', '$password', '$nohp', '$lahir')";
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
            'user_list' => $json_array
        );   
    } else {
        $response = array(
            'code' => 400,
            'status' => 'Error',
            'user_list' => 0
        );
    }
    print(json_encode($response));
    mysqli_close($conn);
}
?>
