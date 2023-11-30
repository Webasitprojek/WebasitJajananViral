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
        $password_pembeli = $obj->password_pembeli;
        $password_pembeli = password_hash($password_pembeli, PASSWORD_DEFAULT);

        $query_update= "update pembeli set password_pembeli = '$password_pembeli' where username_pembeli = '$username_pembeli'";

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
        //select spesific user
        include 'DatabaseConfig.php';
        $conn = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);

        $user_username = $_GET['username'];

        $query_update = "select * from user where username = '$username'";
        $result = mysqli_fetch_array(mysqli_query($conn, $query_update)); 
        $json_array = array();
        $response = "";

        if (isset($result)) {
            $data = mysqli_query($conn, $query_update);
            while ($row = mysqli_fetch_assoc($data)) {
                $json_array = $row;
            }
            $response = array(
                'code' => 200,
                'status' => 'Sukses',
                'user_list' => $json_array
            );
        } else {
            $response = array(
                'code' => 404,
                'status' => 'Data tusernameak ditemukan!',
                'user_list' => $json_array
            );
        }
        print(json_encode($response));
        mysqli_close($conn);

    } elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
        //delete spesific user
        include 'DatabaseConfig.php';
        $conn = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);

        $user_username = $_GET['username'];

        $query_delete = "delete from user where username = '$username'";
        $result = mysqli_query($conn, $query_delete);
        $check = mysqli_affected_rows($conn);
        $json_array = array();
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