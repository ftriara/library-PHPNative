<?php

session_start();

require 'functions.php';

if(isset($_POST['login'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

    // cek username
    if(mysqli_num_rows($result) === 1) {
        // cek password
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])) {
            // set session
            $_SESSION['login'] = true;

            // cek remember me
            if(isset($_POST['remember'])) {
                // buat cookie
                setcookie('id', $row['id'], time() + (60 * 60 * 24));
                setcookie('key', hash('sha256', $row['username']), time() + (60 * 60 * 24));
            }
            
            header("Location: index.php");
            exit;
        };
    }

    $error = true;
}

if(isset($_SESSION['login'])) {
    header('Location: index.php');
    exit;
}

// cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>Login</title>
</head>
<body>
    <main style="margin: 10% 40%;">
        <h1 style="text-align: center;">Login</h1>

        <?php if(isset($error)) : ?>
            <br>
            <p style="color: red; font-style: italic;">username atau password salah</p>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-2 mt-4">
                <label for="username" class="form-label">Username :</label>
                <input type="text" class="form-control" id="username" name="username" required unique>
            </div>
            <div class="mb-2 mt-2">
                <label for="password" class="form-label">Password :</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-2 mt-2">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label for="remember" class="form-check-label">Remember me</label>
            </div>
            <button type="submit" class="btn btn-primary d-block mx-auto" name="login">Login</button>
        </form>
        <br>
        <p style="text-align: center;">Belum punya akun? <a href="registrasi.php">Daftar disini</a></p>
    </main>
</body>
</html>