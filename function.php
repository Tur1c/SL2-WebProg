<?php
    $database = mysqli_connect("localhost", "root", "", "tugasWebProg");

    function query($query) {
        global $database;
        $result = mysqli_query($database, $query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }

    function register($data) {
        global $database;
        $count = 0;
        $nama_depan = $data["nama_depan"];
        $nama_tengah = $data["nama_tengah"];
        $nama_belakang = $data["nama_belakang"];
        $tempat_lahir = $data["tempat_lahir"];
        $tanggal_lahir = $data["tanggal_lahir"];
        $nik = $data['nik'];
        $warga_negara = $data["warga_negara"];
        $email = $data["email"];
        $telp = $data['no_hp'];
        $alamat = $data["alamat"];
        $pos = $data['kode_pos'];
        $username = (stripslashes($data["username"]));
        $password = mysqli_real_escape_string($database, $data["password1"]);
        $password2 = mysqli_real_escape_string($database, $data["password2"]);
        
        $result = mysqli_query($database, "SELECT username FROM users WHERE username = '$username'");
        if(mysqli_fetch_assoc($result)) {
            $_SESSION['error_username'] = "Username sudah ada";
            $count++;
        }
        if($password !== $password2) {
            $_SESSION['error_password'] = "Password tidak sama";
            $count++;
        }
        if (strlen($nik) != 16) {
            $_SESSION['error_nik'] = 'NIK harus 16 digit';
            $count++;
        }
        if (strlen($telp) < 11 || !str_starts_with($telp, '08')) {
            $_SESSION['error_telp'] = 'No HP minimal 11 digit angka dan dimulai dengan 08';
            $count++;
        }
        if (strlen($pos) != 5) {
            $_SESSION['error_pos'] = 'Kode Pos harus 5 digit>';
            $count++;
        }
        if (empty(trim($username))) {
            $_SESSION['error_username'] = "Username tidak boleh kosong";
            $count++;
        }        
        
        $password = password_hash($password, PASSWORD_DEFAULT);
        $picture = upload();
        if(!$picture) {
            $count++;
        }
        if($count > 0) {
            return false;
        }
        mysqli_query($database, "INSERT INTO users VALUES ('$nama_depan', '$nama_tengah', '$nama_belakang', '$tempat_lahir', '$tanggal_lahir', '$nik', '$warga_negara', '$email', '$telp', '$alamat', '$pos', '$username', '$password', '$picture')");
        return mysqli_affected_rows($database);
    }

    function upload() {
        $namaFile = $_FILES["foto_profil"]["name"];
        $tmpName = $_FILES["foto_profil"]["tmp_name"];
        $ekstensiGambarValid = ["jpeg", "png", "jpg"];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if(!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            $_SESSION["error_img"] .= "File harus berformat png / jpg / jpeg";
            return false;
        }
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;
        move_uploaded_file($tmpName, './image/'.$namaFileBaru);
        return $namaFileBaru;
    }

    function edit($data) {
        global $database;
        $count = 0;
        $nama_depan = $data["nama_depan"];
        $nama_tengah = $data["nama_tengah"];
        $nama_belakang = $data["nama_belakang"];
        $tempat_lahir = $data["tempat_lahir"];
        $tanggal_lahir = $data["tanggal_lahir"];
        $nik = $data['nik'];
        $warga_negara = $data["warga_negara"];
        $email = $data["email"];
        $telp = $data['no_hp'];
        $alamat = $data["alamat"];
        $pos = $data['kode_pos'];
        $username_lama = $data["username_lama"];
        $username = (stripslashes($data["username"]));
        $gambarlama = $data["picture"];

        if($username !== $username_lama) {
            $result = mysqli_query($database, "SELECT username FROM users WHERE username = '$username'");
            if(mysqli_fetch_assoc($result)) {
                $_SESSION['error_username'] = "Username sudah ada";
                $count++;
            }
        } else {
            $username = $username_lama;
        }
        if (strlen($nik) != 16) {
            $_SESSION['error_nik'] = 'NIK harus 16 digit';
            $count++;
        }
        if (strlen($telp) < 11 || !str_starts_with($telp, '08')) {
            $_SESSION['error_telp'] = 'No HP minimal 11 digit angka dan dimulai dengan 08';
            $count++;
        }
        if (strlen($pos) != 5) {
            $_SESSION['error_pos'] = 'Kode Pos harus 5 digit>';
            $count++;
        }
        if (empty(trim($username))) {
            $_SESSION['error_username'] = "Username tidak boleh kosong";
            $count++;
        }
        if($_FILES['foto_profil']['error'] === 4) {
            $picture = $gambarlama;
        } else {
            if($count > 0) {
                $picture = $gambarlama;
            } else {
                $picture = upload();
                if(!$picture) {
                    $count++;
                } else {
                    unlink('./image/'.$gambarlama);
                }
            }
        }
        
        if($count > 0) {
            return false;
        }
        
        $query = "UPDATE users SET 
                    nama_depan = '$nama_depan',
                    nama_tengah = '$nama_tengah',
                    nama_belakang = '$nama_belakang',
                    tempat_lahir = '$tempat_lahir',
                    tanggal_lahir = '$tanggal_lahir',
                    nik = '$nik',
                    warga_negara = '$warga_negara',
                    email = '$email',
                    no_hp = '$telp',
                    alamat = '$alamat',
                    kode_pos = '$pos',
                    username = '$username',
                    picture = '$picture'
                  WHERE username = '$username_lama'";
        mysqli_query($database, $query);
        $_SESSION['username'] = $username;
        return mysqli_affected_rows($database);
    }

    function store($data) {
        $nama_depan = $data["nama_depan"];
        $nama_tengah = $data["nama_tengah"];
        $nama_belakang = $data["nama_belakang"];
        $tempat_lahir = $data["tempat_lahir"];
        $tanggal_lahir = $data["tanggal_lahir"];
        $nik = $data['nik'];
        $warga_negara = $data["warga_negara"];
        $email = $data["email"];
        $telp = $data['no_hp'];
        $alamat = $data["alamat"];
        $pos = $data['kode_pos'];
        $username = (stripslashes($data["username"]));
        $picture = $data["picture"];
        return ['nama_depan' => $nama_depan, 'nama_tengah' => $nama_tengah, 'nama_belakang' => $nama_belakang, 'tempat_lahir' => $tempat_lahir, 'tanggal_lahir' => $tanggal_lahir, 'nik' => $nik, 'warga_negara' => $warga_negara, 'email' => $email, 'no_hp' => $telp, 'alamat' => $alamat, 'kode_pos' => $pos, 'username' => $username, 'picture' => $picture];
    }
?>