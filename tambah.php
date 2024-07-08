<?php

session_start();

if(!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

require 'functions.php';

// tombol submit sudah ditekan atau belum
if(isset($_POST['submit'])){
    // cek apakah data berhasil ditambahkan atau tidak
    if(tambah($_POST) > 0) {
        echo "<script>
        alert('Data berhasil ditambahkan!');
        document.location.href = 'list-buku.php';
        </script>";
    } else {
        echo "<script>
        alert('Data gagal ditambahkan!');
        </script>";
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
    <title>Form Tambah Data Buku</title>
</head>

<body style="padding: 20px">
    <header>
        <h2>Tambah Data Buku</h2>
    </header>

    <main>
        <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $buku["id"];?>">
            <div class="mb-2 mt-4 w-25">
                <label for="kode_buku" class="form-label">Kode Buku</label>
                <input type="text" class="form-control" id="kode_buku" name="kode_buku" required unique>
            </div>
            <div class="mb-2 mt-2 w-25">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" required>
            </div>
            <div class="mb-2 mt-2 w-25">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis" required>
            </div>
            <div class="mb-2 mt-2 w-25">
                <label for="penerbit" class="form-label">Penerbit</label>
                <input type="text" class="form-control" id="penerbit" name="penerbit" required>
            </div>
            <div class="mb-2 mt-2 w-25">
                <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit" min="1900" max="2999" required>
            </div>
            <div class="mb-2 mt-2 w-25">
                <label for="cover" class="form-label">Gambar</label>
                <input type="file" class="form-control" id="cover" name="cover" required>
            </div>
            <button class="btn btn-primary mt-3" type="submit" name="submit">Tambah</button>
        </form>
    </main>
</body>
</html>