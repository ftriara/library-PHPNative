<?php 

session_start();

if(!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <title>DigiLib</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg" id="navbar">
        <div class="container-fluid">
        <a class="navbar-brand" href="#">DigiLib</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="list-buku.php">Library</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout <i class="bi bi-box-arrow-right"></i></a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

    <div class="top">
        <div class="description">
            <h1>Welcome to Digital Library!!</h1>
        </div>
    </div>

    <footer>
        <p>&copy; 2023 Fitria Rahmadani</p>
    </footer>

</body>
</html>