<?php 
    $con = mysqli_connect("localhost","root","","cedass");
    if (mysqli_connect_error()) {
        die("Koneksi database gagal: " . mysqli_connect_error());
    }

    function query($query){
        global $con;
        $resul = mysqli_query($con, $query);
        $rows = [];
        while($row = mysqli_fetch_assoc($resul)){
            $rows[]=$row;
        }
        return $rows;
    }


    function registrasi($data){
        global $con;
        
        $username = strtolower(stripslashes($data["user"]));
        $email = mysqli_real_escape_string($con, $data["email"]);
        $password = mysqli_real_escape_string($con, $data["password"]);
        $notelp = mysqli_real_escape_string($con, $data["hp"]);
        $alamat = mysqli_real_escape_string($con, $data["alam"]);
        $jeniskelamin = mysqli_real_escape_string($con, $data["jk"]);
        $lahir = mysqli_real_escape_string($con, $data["ttl"]);
        $gambar = addslashes(file_get_contents($_FILES['ung']['tmp_name']));
    
        $cekuser = mysqli_query($con, "SELECT username FROM user WHERE username = '$username'");
        if(mysqli_fetch_assoc($cekuser)){
            echo "
                <script>
                    alert('USERNAME SUDAH TERDAFTAR');
                </script>
                "; 
            return false; 
        }

        if($password !== $password){
            echo "
                <script>
                    alert('KONFIRMASI PASSWORD TIDAK SESUAI');
                </script>
                "; 
            return false;
        }
    
       
        // mengamankan password
        $password = password_hash($password, PASSWORD_DEFAULT);
        // masukkan data
        $que = "INSERT INTO user VALUES ('', '$username', '$email', '$alamat', '$jeniskelamin', '$password', '$notelp', '$lahir', '$gambar')";
        mysqli_query($con, $que);
        return mysqli_affected_rows($con);
        
    }

    function cekemail($data){
        global $con;
        $mail = strtolower(stripslashes($data["user"]));
        $cekmail = mysqli_query($con, "SELECT email FROM user WHERE username = '$mail'");
        if(mysqli_fetch_assoc($cekmail)){
            echo "
                <script>
                    alert('email tidak terdaftar');
                </script>
                "; 
            return false; 
        }
    }

    function uppass($data){
        global $con;
        $salah = "Konfirmasi password dan password tidak sama";
        $username = strtolower(stripslashes($data["pasb"]));
        $password = mysqli_real_escape_string($con, $data["konpas"]);
        $password2 = mysqli_real_escape_string($con, $data["konpas2"]);
        // $cekuser = mysqli_query($con, "SELECT username FROM user WHERE username = '$username'");
        // if(mysqli_fetch_assoc($cekuser)){
        // echo "
        //     <script>
        //         alert('USERNAME SUDAH TERDAFTAR');
        //     </script>
        //     "; 
        // return false; 
        // }
        if($password !== $password2){
            echo $salah;
            return false;
        }
        // mengamankan password
        $password = password_hash($password, PASSWORD_DEFAULT);
        // masukkan data
        $que = "UPDATE `user` SET `password`='$password' WHERE username = '$username'";
        mysqli_query($con, $que);
        return mysqli_affected_rows($con);
    
    }
    function tambah($data){
        global $con;
        $id = htmlspecialchars($data["idbar"]);
        $nama = htmlspecialchars($data["nbar"]);
        $alamat = htmlspecialchars($data["vari"]);
        $deskripsi = htmlspecialchars($data["des"]);
        $harga = htmlspecialchars($data["har"]);
        $link = htmlspecialchars($data["li"]);
        $gambar = addslashes(file_get_contents($_FILES['up']['tmp_name']));
        
        $query = "INSERT INTO barang VALUES ('$id', '$nama', $harga, '$deskripsi', '$link', '$gambar')";
        $query2 = "INSERT INTO detail_barang VALUES ('$id', '$alamat')";
        mysqli_query($con, $query);
        mysqli_query($con, $query2);
        return mysqli_affected_rows($con);
    }
    function edit($data)
    {
        global $con;
        $id = htmlspecialchars($data["idbar"]);
        $nama = htmlspecialchars($data["nbar"]);
        $alamat = htmlspecialchars($data["vari"]);
        $deskripsi = htmlspecialchars($data["des"]);
        $harga = htmlspecialchars($data["har"]);
        $link = htmlspecialchars($data["li"]);
    
        // Check if a new image is uploaded
        if (!empty($_FILES['up']['tmp_name'])) {
            // If a new image is uploaded, update the image in the database
            $gambar = addslashes(file_get_contents($_FILES['up']['tmp_name']));
            $edit1 = "UPDATE barang SET nama_barang = '$nama', harga = $harga, deskripsi = '$deskripsi', link = '$link', gambar = '$gambar' WHERE id_barang  = $id";
        } else {
            // If no new image is uploaded, update other fields without changing the image
            $edit1 = "UPDATE barang SET nama_barang = '$nama', harga = $harga, deskripsi = '$deskripsi', link = '$link' WHERE id_barang  = $id";
        }
    
        $edit2 = "UPDATE detail_barang SET varian = '$alamat' WHERE id_barang  = $id";
        mysqli_query($con, $edit1);
        mysqli_query($con, $edit2);
    
        return mysqli_affected_rows($con);
    }
    function hapus($id_barang){
        global $con;
        $query1 = "DELETE FROM barang WHERE id_barang = '$id_barang'";
        $query2 = "DELETE FROM detail_barang WHERE id_barang = '$id_barang'";
        mysqli_query($con, $query2);
        mysqli_query($con, $query1);
        return mysqli_affected_rows($con);
    }
    function cari($cari){
        global $con;
        $query = ("SELECT barang.id_barang,barang.gambar,barang.nama_barang,detail_barang.alamat,barang.deskripsi,barang.link
        FROM barang
        JOIN detail_barang
        ON barang.id_barang = detail_barang.id_barang
        WHERE barang.nama_barang LIKE '%$cari%' ");
        return query($query);
    }

    function tambahfranchise($data){
        global $con;
        $angkaRandom = rand(1, 10000);
        $id = htmlspecialchars($angkaRandom);
        $nama = htmlspecialchars($data["namaleng"]);
        $phone = htmlspecialchars($data["phone"]);
        $mail = htmlspecialchars($data["mail"]);
        $alam = htmlspecialchars($data["map"]);
        $status = "Menunggu Persetujuan";
        $lintang = htmlspecialchars($data["lin"]);
        
        $query = "INSERT INTO franchise VALUES ('$id', '$nama', '$alam', '$phone', '$mail', '$status', '$lintang')";
        mysqli_query($con, $query);
        return mysqli_affected_rows($con);
    }

    function editfran($data){
        global $con;
        $id = htmlspecialchars($data["idbar"]);
        $nama = htmlspecialchars($data["nbar"]);
        $email = htmlspecialchars($data["vari"]);
        $notelp = htmlspecialchars($data["des"]);
        $alamat = htmlspecialchars($data["har"]);
        $status = htmlspecialchars($data["sta"]);
        $lintang = htmlspecialchars($data["lin"]);
        
        $edit1 = "UPDATE franchise SET nama = '$nama', alamat = '$alamat', no_telp = '$notelp', email = '$email' , status = '$status', lintang = '$lintang' WHERE id_franchise  = $id";
        mysqli_query($con, $edit1);
        return mysqli_affected_rows($con);
    }

    function hapusfran($id_franchise){
        global $con;
        $query1 = "DELETE FROM franchise WHERE id_franchise = '$id_franchise'";
        mysqli_query($con, $query1);
        return mysqli_affected_rows($con);
    }
    function carifran($cari){
        global $con;
        $query = ("SELECT * FROM franchise WHERE franchise.nama LIKE '%$cari%' ");
        return query($query);
    }
    function caripega($caripega){
        global $con;
        $query = ("SELECT * FROM user WHERE user.username LIKE '%$caripega%' ");
        return query($query);
    }

    function editprofil($data)
    {
        global $con;
        $id = htmlspecialchars($data["id"]);
        $nama = htmlspecialchars($data["usern"]);
        $email = htmlspecialchars($data["nam"]);
        $alamat = htmlspecialchars($data["alamat"]);
        $jenisk = $data["jk"];
        $nohp = htmlspecialchars($data["notel"]);
        $tgla = htmlspecialchars($data["ttl"]);
    
        // Check if a new image is uploaded
        if (!empty($_FILES['ung']['tmp_name'])) {
            // If a new image is uploaded, update the image in the database
            $gambar = addslashes(file_get_contents($_FILES['ung']['tmp_name']));
            $edit1 = "UPDATE user SET username = '$nama', email = '$email', alamat = '$alamat', jenis_kelamin = '$jenisk', no_hp = '$nohp', tgl_lahir = '$tgla', gambar = '$gambar' WHERE id  = '$id'";
        } else {
            // If no new image is uploaded, update other fields without changing the image
            $edit1 = "UPDATE user SET username = '$nama', email = '$email', alamat = '$alamat', jenis_kelamin = '$jenisk', no_hp = '$nohp', tgl_lahir = '$tgla' WHERE id  = '$id'";
        }
    
        mysqli_query($con, $edit1);
        return mysqli_affected_rows($con);
    }
    
    function hapuspega($username){
        global $con;
        $query1 = "DELETE FROM user WHERE username = '$username'";
        mysqli_query($con, $query1);
        return mysqli_affected_rows($con);
    }

?>