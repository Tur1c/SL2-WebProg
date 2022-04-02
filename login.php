<?php
    session_start();
    include 'function.php';
    $username = "";
    if(isset($_SESSION["login"])) {
        header('Location: home.php');
    }
    if(isset($_POST["login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        $result = mysqli_query($database, "SELECT * FROM users WHERE username = '$username'");
        if(mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if(password_verify($password, $row["password"])) {
                $_SESSION["login"] = true;
                $_SESSION["username"] = $username;
                header('Location: home.php');
            } else {
                $error_login = "Username / Password salah";
            }
        } else {
            $error_login = "Username / Password salah";
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
    <title>Login</title>
    <style>
        input[type=text], input[type=password] {
            width: 80%;
            height: 30px;
            border: none;
            margin-left: 10px;
        }

        label[for="username"], label[for="password"]{ 
            width: 20%; 
            text-align: center;
            justify-content: center;
            margin: auto;
        }

        input[type=submit] {
            background-color: #adf59f;
            border: none;
            padding: 10px;
            width: 100px;
            font-family: serif;
            font-size: medium;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <p class="login-header">Login</p>
        <div class="form-container">
            <form action="" method="post">
                <p style="color:red;text-align:center;margin-bottom: 1rem; margin-top: -1rem"><?= isset($error_login) ? $error_login : '';?></p>
                <div class="username-input">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?= $username;?>">
                </div>
                <div class="password-input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                </div>
                <div class="button-input">
                    <div class="login-buttons">
                        <input type="submit" value="Login" name="login">
                    </div>
                    <div class="back-button-login">
                        <a href="welcome.php">Kembali</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>