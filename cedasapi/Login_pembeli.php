<?php
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    include 'DatabaseConfig.php';
    $conn = mysqli_connect($HostName, $HostUser, $HostPass, $DatabaseName);

    // Perbaikan: Hapus spasi ekstra pada nama parameter
    $username = $_GET['username_pembeli'];
    $password = $_GET['password_pembeli'];

    $query_check = "SELECT username_pembeli, password_pembeli FROM pembeli WHERE username_pembeli = '$username'";
    $check = mysqli_fetch_array(mysqli_query($conn, $query_check));
    $json_array = array();
    $response = "";

    if (isset($check)) {
        $query_check_pass = "SELECT username_pembeli, password_pembeli FROM pembeli WHERE username_pembeli = '$username'";
        $query_pass_result = mysqli_query($conn, $query_check_pass);
        $check_password = mysqli_fetch_array($query_pass_result);

        if (isset($check_password) && password_verify($password, $check_password['password_pembeli'])) {
            $query_pass_result = mysqli_query($conn, $query_check_pass);
            while ($row = mysqli_fetch_assoc($query_pass_result)) {
                $json_array[] = $row;
            }
            $response = array(
                'code' => 200,
                'status' => 'Sukses',
                'register_list' => $json_array
            );
        } else {
            $response = array(
                'code' => 401,
                'status' => 'Password salah, periksa kembali!',
                'register_list' => $json_array
            );
        }
    } else {
        $response = array(
            'code' => 404,
            'status' => 'Data tidak ditemukan, lanjutkan registrasi?',
            'register_list' => $json_array
        );
    }
    print(json_encode($response));

    mysqli_close($conn);
}
?>
