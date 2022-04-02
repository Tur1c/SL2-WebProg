<?php
    session_start();
    include 'function.php';
    $user = query("SELECT * FROM users WHERE username = '" . $_SESSION['username'] . "'");
    if(!isset($_SESSION["login"])) {
        header('Location: login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <!-- <link href="style.css?<?=filemtime("style.css")?>" rel="stylesheet" type="text/css" /> -->
    <title>Home</title>
</head>
<body>
    <div class="home-container">
        <div class="profile-header">
            <div class="profile-nav-title">
                <p>Aplikasi Pengelolaan keuangaan</p>
            </div>
            <div class="home-nav-menu">
                <div class="home-home">
                    <a href="home.php" style="color: #000">Home</a>
                </div>
                <div class="home-profile">
                    <a href="profile.php" style="text-decoration: none;color: #000">Profile</a>
                </div>
            </div>
            <div class="home-nav-logout">
                <a href="logout.php" style="text-decoration: none;color: #000">Logout</a>
            </div>
        </div>
        <div class="home-content">
            <p class="word-wrap">
                Halo <strong><?= $user[0]["nama_depan"] . " " . $user[0]["nama_tengah"] . " " . $user[0]["nama_belakang"]?></strong>, Selamat datang di Aplikasi Pengelolaan Keuangan
            </p>
        </div>
    </div>
</body>
</html>