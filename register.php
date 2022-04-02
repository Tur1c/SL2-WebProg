<?php
    session_start();
    $data;
    $_SESSION["error_username"] = "";
    $_SESSION["error_nik"] = "";
    $_SESSION["error_telp"] = "";
    $_SESSION["error_pos"] = "";
    $_SESSION["error_password"] = "";
    $_SESSION["error_img"] = "";
    include "function.php";
    if(isset($_POST["register"])) {
        if(register($_POST) > 0) {
            $_SESSION["register"] = "true";
            header('Location: login.php');
        } else {
            $data = store($_POST);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
    <style>
        input[type=submit] {
            background-color: #adf59f;
            border-radius: 3px;
            border: 1px solid #000;
            box-shadow: rgb(88, 88, 88) 0px 1px 2px;
            padding:2px 10px 2px 10px;
            cursor:pointer;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <p class="register-header">Register</p>
        <div class="form-register-container">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="info">
                    <div class="regis-info">
                        <div class="nama-depan" style="margin-bottom: 1rem;width:100%">
                            <label for="nama_depan" style="width:20%;margin-right: 1rem;">Nama Depan</label>
                            <input type="text" name="nama_depan" id="nama_depan" style="width:70%" required value="<?= isset($data["nama_depan"])? $data["nama_depan"] : ""; ?>">
                        </div>
                        <div class="tempat-lahir" style="margin-bottom: 1rem;">
                            <label for="tempat_lahir" style="width:20%;margin-right: 0.9rem;">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" style="width:70%" required value="<?= isset($data["tempat_lahir"])? $data["tempat_lahir"] : ""; ?>">
                        </div>
                        <div class="warga-negara" style="margin-bottom: 1rem;">
                            <label for="warga_negara" style="width:20%;margin-right: 0.6rem;">Warga Negara</label>
                            <input type="text" name="warga_negara" id="warga_negara" style="width:70%" required value="<?= isset($data["warga_negara"])? $data["warga_negara"] : ""; ?>">
                        </div>
                        <div class="alamat" style="margin-bottom: 1rem;">
                            <label for="alamat" style="width:20%;margin-right: 3.3rem;">Alamat</label>
                            <textarea name="alamat" id="alamat" cols="23" rows="3" style="vertical-align: top;width:70%" required><?= isset($data["alamat"])? $data["alamat"] : ""; ?></textarea>
                        </div>
                        <div class="username">
                            <label for="username" style="width:20%;margin-right: 2.2rem;">Username</label>
                            <input type="text" name="username" id="username" style="width:70%" required value="<?= isset($data["username"])? $data["username"] : ""; ?>">
                            <p style="color:red;text-align:center;margin-top: 5px;"><?= isset($_SESSION['error_username']) ? $_SESSION['error_username'] : '';?></p>
                        </div>
                    </div>
                    <div class="regis-info">
                        <div class="nama-tengah" style="margin-bottom: 1rem;">
                            <label for="nama_tengah" style="width:20%;margin-right: 1rem;">Nama Tengah</label>
                            <input type="text" name="nama_tengah" id="nama_tengah" style="width:70%" required value="<?= isset($data["nama_tengah"])? $data["nama_tengah"] : ""; ?>">
                        </div>
                        <div class="tanggal-lahir" style="margin-bottom: 1rem;">
                            <label for="tanggal_lahir" style="width:20%;margin-right: 2.7rem;">Tgl Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" style="width:70%" required value="<?= isset($data["tanggal_lahir"])? $data["tanggal_lahir"] : ""; ?>">
                        </div>
                        <div class="email" style="margin-bottom: 1rem;">
                            <label for="email" style="width:20%;margin-right: 4.1rem;">Email</label>
                            <input type="email" name="email" id="email" style="width:70%" required value="<?= isset($data["email"])? $data["email"] : ""; ?>">
                        </div>
                        <div class="kode-pos" style="margin-bottom: 1rem;">
                            <label for="kode_pos" style="width:20%;margin-right: 2.6rem;">Kode Pos</label>
                            <input type="number" name="kode_pos" id="kode_pos" style="width:70%" required value="<?= isset($data["kode_pos"])? $data["kode_pos"] : ""; ?>">
                            <p style="color:red;text-align:center;margin-top: 5px;"><?= isset($_SESSION['error_pos']) ? $_SESSION['error_pos'] : '';?></p>
                        </div>
                        <div class="password-1">
                            <label for="password1" style="width:20%;margin-right: 1.9rem;">Password 1</label>
                            <input type="password" name="password1" id="password1" style="width:70%" required>
                            <p style="color:red;text-align:center;margin-top: 5px;"><?= isset($_SESSION['error_password']) ? $_SESSION['error_password'] : '';?></p>
                        </div>
                    </div>
                    <div class="regis-info">
                        <div class="nama-belakang" style="margin-bottom: 1rem;">
                            <label for="nama_belakang" style="width:20%;margin-right: 0rem;">Nama Belakang</label>
                            <input type="text" name="nama_belakang" id="nama_belakang" style="width:70%" required value="<?= isset($data["nama_belakang"])? $data["nama_belakang"] : ""; ?>">
                        </div>
                        <div class="nik" style="margin-bottom: 1rem;">
                            <label for="nik" style="width:20%;margin-right: 4.6rem;">NIK</label>
                            <input type="text" name="nik" id="nik" style="width:70%" required value="<?= isset($data["nik"])? $data["nik"] : ""; ?>">
                            <p style="color:red;text-align:center;margin-top: 5px;"><?= isset($_SESSION['error_nik']) ? $_SESSION['error_nik'] : '';?></p>
                        </div>
                        <div class="no-hp" style="margin-bottom: 1rem;">
                            <label for="no_hp" style="width:20%;margin-right: 3.6rem;">No HP</label>
                            <input type="text" name="no_hp" id="no_hp" style="width:70%" required placeholder="12 Digit Number" value="<?= isset($data["no_hp"])? $data["no_hp"] : ""; ?>">
                            <p style="color:red;text-align:center;margin-top: 5px;"><?= isset($_SESSION['error_telp']) ? $_SESSION['error_telp'] : '';?></p>
                        </div>
                        <div class="foto-profil" style="margin-bottom: 1rem;">
                            <label for="foto_profil" style="width:20%;margin-right: 2rem;">Foto Profil</label>
                            <input type="file" name="foto_profil" id="foto_profil" style="width:70%" required>
                            <p style="color:red;text-align:center;margin-top: 5px;"><?= isset($_SESSION['error_img']) ? $_SESSION['error_img'] : '';?></p>
                        </div>
                        <div class="password-2">
                            <label for="password2" style="width:20%;margin-right: 1.7rem;">Password 2</label>
                            <input type="password" name="password2" id="password2" style="width:70%" required>
                            <p style="color:red;text-align:center;margin-top: 5px;"><?= isset($_SESSION['error_password']) ? $_SESSION['error_password'] : '';?></p>
                        </div>
                    </div>
                </div>
                <div class="register-buttonpage">
                    <a href="welcome.php" class="kembali-register">Kembali</a>
                    <input type="submit" value="Register" name="register">
                </div>
            </form>
        </div>
    </div>
</body>
</html>