<?php
    session_start();
    $_SESSION["error_nik"] = "";
    $_SESSION["error_telp"] = "";
    $_SESSION["error_pos"] = "";
    $_SESSION["error_pass"] = "";
    $_SESSION["error_img"] = "";
    include "function.php";
    $user = query("SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "'")[0];
    $data = store($user);
    print_r($data);
    if(isset($_POST["edit"])) {
        if(edit($_POST) > 0) {
            header('Location: profile.php');
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
    <title>Edit</title>
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
    <div class="profile-container">
        <div class="home-header">
            <div class="home-nav-title">
                <p>Aplikasi Pengelolaan keuangaan</p>
            </div>
            <div class="profile-nav-menu">
                <div class="home-home">
                    <a href="home.php" style="text-decoration: none;color: #000">Home</a>
                </div>
                <div class="home-profile">
                    <a href="profile.php" style="color: #000">Profile</a>
                </div>
            </div>
            <div class="profile-nav-logout">
                <a href="logout.php" style="text-decoration: none;color: #000">Logout</a>
            </div>
        </div>
        <div class="form-register-container">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="info">
                    <div class="regis-info">
                        <div class="nama-depan" style="margin-bottom: 1rem;width:100%">
                            <label for="nama-depan" style="width:20%;margin-right: 1rem;">Nama Depan</label>
                            <input type="text" name="nama_depan" id="nama-depan" style="width:70%" required value="<?= isset($data["nama_depan"])? $data["nama_depan"] : ""; ?>">
                        </div>
                        <div class="tempat-lahir" style="margin-bottom: 1rem;">
                            <label for="tempat-lahir" style="width:20%;margin-right: 0.9rem;">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat-lahir" style="width:70%" required value="<?= isset($data["tempat_lahir"])? $data["tempat_lahir"] : ""; ?>">
                        </div>
                        <div class="warga-negara" style="margin-bottom: 1rem;">
                            <label for="warga-negara" style="width:20%;margin-right: 0.6rem;">Warga Negara</label>
                            <input type="text" name="warga_negara" id="warga-negara" style="width:70%" required value="<?= isset($data["warga_negara"])? $data["warga_negara"] : ""; ?>">
                        </div>
                        <div class="alamat" style="margin-bottom: 1rem;">
                            <label for="alamat" style="width:20%;margin-right: 3.3rem;">Alamat</label>
                            <textarea name="alamat" id="alamat" cols="23" rows="3" style="vertical-align: top;width:70%" required><?= isset($data["alamat"])? $data["alamat"] : ""; ?></textarea>
                        </div>
                        <div class="username">
                            <label for="username" style="width:20%;margin-right: 2.2rem;">Username</label>
                            <input type="text" name="username" id="username" style="width:70%" required value="<?= isset($data["username"])? $data["username"] : ""; ?>">
                            <input type="hidden" name="username_lama" value="<?= $data["username"]; ?>">
                        </div>
                    </div>
                    <div class="regis-info">
                        <div class="nama-tengah" style="margin-bottom: 1rem;">
                            <label for="nama-tengah" style="width:20%;margin-right: 1rem;">Nama Tengah</label>
                            <input type="text" name="nama_tengah" id="nama-tengah" style="width:70%" required value="<?= isset($data["nama_tengah"])? $data["nama_tengah"] : ""; ?>">
                        </div>
                        <div class="tanggal-lahir" style="margin-bottom: 1rem;">
                            <label for="tanggal-lahir" style="width:20%;margin-right: 2.7rem;">Tgl Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal-lahir" style="width:70%" required value="<?= isset($data["tanggal_lahir"])? $data["tanggal_lahir"] : ""; ?>">
                        </div>
                        <div class="email" style="margin-bottom: 1rem;">
                            <label for="email" style="width:20%;margin-right: 4.1rem;">Email</label>
                            <input type="email" name="email" id="email" style="width:70%" required value="<?= isset($data["email"])? $data["email"] : ""; ?>">
                        </div>
                        <div class="kode-pos" style="margin-bottom: 1rem;">
                            <label for="kode-pos" style="width:20%;margin-right: 2.6rem;">Kode Pos</label>
                            <input type="number" name="kode_pos" id="kode-pos" style="width:70%" required value="<?= isset($data["kode_pos"])? $data["kode_pos"] : ""; ?>">
                            <p style="color:red;text-align:center;margin-top: 5px;"><?= isset($_SESSION['error_pos']) ? $_SESSION['error_pos'] : '';?></p>
                        </div>
                    </div>
                    <div class="regis-info">
                        <div class="nama-belakang" style="margin-bottom: 1rem;">
                            <label for="nama-belakang" style="width:20%;margin-right: 0rem;">Nama Belakang</label>
                            <input type="text" name="nama_belakang" id="nama-belakang" style="width:70%" required value="<?= isset($data["nama_belakang"])? $data["nama_belakang"] : ""; ?>">
                        </div>
                        <div class="nik" style="margin-bottom: 1rem;">
                            <label for="nik" style="width:20%;margin-right: 4.6rem;">NIK</label>
                            <input type="text" name="nik" id="nik" style="width:70%" required value="<?= isset($data["nik"])? $data["nik"] : ""; ?>">
                            <p style="color:red;text-align:center;margin-top: 5px;"><?= isset($_SESSION['error_nik']) ? $_SESSION['error_nik'] : '';?></p>
                        </div>
                        <div class="no-hp" style="margin-bottom: 1rem;">
                            <label for="no-hp" style="width:20%;margin-right: 3.6rem;">No HP</label>
                            <input type="text" name="no_hp" id="no-hp" style="width:70%" required placeholder="12 Digit Number" value="<?= isset($data["no_hp"])? $data["no_hp"] : ""; ?>">
                            <p style="color:red;text-align:center;margin-top: 5px;"><?= isset($_SESSION['error_telp']) ? $_SESSION['error_telp'] : '';?></p>
                        </div>
                        <div class="foto-profil" style="margin-bottom: 1rem;">
                            <div style="width:80%;justify-content: center;align-items:center;text-align:center;">
                                <img src="./Image/<?=$data["picture"] ?>" alt="" style="width: 80%;height: 80%;vertical-align: middle; background-repeat: no-repeat; background-position: center;background-size: cover;justify-content:center;align-items:center">
                            </div>
                            <br>
                            <label for="foto_profil" style="width:20%;margin-right: 2rem;">Foto Profil</label>
                            <input type="file" name="foto_profil" id="foto_profil" style="width:70%">
                            <p style="color:red;text-align:center;margin-top: 5px;"><?= isset($_SESSION['error_img']) ? $_SESSION['error_img'] : '';?></p>
                            <input type="hidden" name="picture" value="<?= $data["picture"]; ?>">
                        </div>
                    </div>
                </div>
                <div class="register-buttonpage" style="margin-top: -1rem">
                    <a href="profile.php" class="kembali-register">Kembali</a>
                    <input type="submit" value="Edit Data" name="edit">
                </div>
            </form>
        </div>
    </div>
</body>
</html>