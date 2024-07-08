<?php

require 'functions.php';

if(isset($_POST['submit'])) {
    if(registrasi($_POST) > 0) {
        echo "<script>
        alert('User berhasil ditambahkan!');
        document.location.href = 'login.php';
        </script>";
    } else {
        echo mysqli_error($conn);
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
    <title>Registrasi</title>
</head>
<body>
    <main style="margin: 5% 40%;">
        <h1 style="text-align: center;">Registrasi</h1>
        <form action="" method="POST">
            <div class="mb-2 mt-4">
                <label for="username" class="form-label">Username :</label>
                <input type="text" class="form-control" id="username" name="username" required unique>
            </div>
            <div class="mb-2 mt-2">
                <label for="email" class="form-label">Email :</label>
                <input type="email" class="form-control" id="email" name="email" required unique>
            </div>
            <div class="mb-2 mt-2">
                <label for="password" class="form-label">Password :</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-2 mt-2">
                <label for="password2" class="form-label">Konfirmasi Password :</label>
                <input type="password" class="form-control" id="password2" name="password2" required>
            </div>
            <button type="submit" class="btn btn-primary d-block mt-3 mx-auto" name="submit">Daftar</button>
        </form>
        <br>
        <p style="text-align: center;">Sudah punya akun? <a href="login.php">Login disini</a></p>
    </main>
</body>
</html>