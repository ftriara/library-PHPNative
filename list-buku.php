<?php 

session_start();

if(!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

require 'functions.php';

$buku = query('SELECT * FROM buku');

// tombol cari ditekan
if(isset($_POST['cari'])){
    $buku = cari($_POST['keyword']);
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
    <title>DigiLib</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg" id="navbar">
            <div class="container-fluid">
            <a class="navbar-brand" href="#">DigiLib</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="list-buku.php">Library</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    </header>
    
    <main>
        <h2 class="mt-4">Daftar Buku Perpustakaan</h2>
        <button class="btn btn-primary mt-4 mb-2" type="button" onclick="window.location.href='tambah.php';">
            Tambah Data
        </button>

        <form class="row g-2 mt-2 mb-4" action="" method="POST">
            <div class="col-auto">
                <input class="form-control" type="text" name="keyword" autofocus placeholder="Keyword" autocomplete="off">
            </div>
            <div class="col-auto">
                <button class="btn btn-dark" type="submit" name="cari">Cari</button>
            </div>
        </form>
        
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Buku</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun Terbit</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($buku as $row) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $row['kode_buku']; ?></td>
                        <td><?= $row['judul']; ?></td>
                        <td><?= $row['penulis']; ?></td>
                        <td><?= $row['penerbit']; ?></td>
                        <td><?= $row['tahun_terbit']; ?></td>
                        <td><img src="img/<?= $row['cover']; ?>" width="80"></td>
                        <td>
                            <a href="edit.php?id=<?=$row["id"]; ?>">Edit</a> |
                            <a href="hapus.php?id=<?=$row["id"]; ?>" onclick="return confirm ('Apakah data akan dihapus?');">Hapus</a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
</body>
</html>