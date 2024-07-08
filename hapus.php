<?php

session_start();

if(!isset($_SESSION['login'])) {
    header('Location: login.php');
    exit;
}

require 'functions.php';

//GET id buku di URL
$id = $_GET['id'];

if(hapus($id) > 0) {
    echo "<script>
    alert('Data berhasil dihapus!');
    document.location.href = 'list-buku.php';
    </script>";
} else {
    echo "<script>
    alert('Data gagal dihapus!');
    </script>";
}

?>