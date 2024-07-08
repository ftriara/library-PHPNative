<?php

// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "library");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function cari($keyword) {
    $query = "SELECT * FROM buku
              WHERE
              kode_buku LIKE '%$keyword%' OR
              judul LIKE '%$keyword%' OR
              penulis LIKE '%$keyword%' OR
              penerbit LIKE '%$keyword%' OR
              tahun_terbit LIKE '%$keyword%'
              ";
    
    return query($query);
}

function tambah($data){
    global $conn;

    $kode_buku = htmlspecialchars($data['kode_buku']);
    $judul = htmlspecialchars($data['judul']);
    $penulis = htmlspecialchars($data['penulis']);
    $penerbit = htmlspecialchars($data['penerbit']);
    $tahun_terbit = htmlspecialchars($data['tahun_terbit']);

    // upload gambar
    $cover = upload();
    if(!$cover) {
        return false;
    }

    $query = "INSERT INTO buku VALUES ('', '$kode_buku', '$judul', '$penulis', '$penerbit', '$tahun_terbit', '$cover')";
    
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function upload(){
    $namaFile = $_FILES['cover']['name'];
    $ukuranFile = $_FILES['cover']['size'];
    $error = $_FILES['cover']['error'];
    $tmpFile = $_FILES['cover']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if($error === 4) {
        echo "<script>
                alert('Pilih gambar dahulu!')
              </script>";
        return false;
    }

    // cek apakah yang diupload adalah gambar
    $extGambarValid = ['jpg', 'jpeg', 'png'];
    $extGambar = explode('.', $namaFile);
    $extGambar = strtolower(end($extGambar));
    if(!in_array($extGambar, $extGambarValid)) {
        echo "<script>
                alert('File bukan gambar!')
              </script>";
        return false;
    }

    // cek jika ukuran terlalu besar
    if($ukuranFile > 3000000) {
        echo "<script>
                alert('Ukuran gambar terlalu besar!')
              </script>";
        return false;
    }

    // lolos pengecekan, upload gambar
    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $extGambar;
    move_uploaded_file($tmpFile, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

function edit($data){
    global $conn;

    $id = $data['id'];
    $kode_buku = htmlspecialchars($data['kode_buku']);
    $judul = htmlspecialchars($data['judul']);
    $penulis = htmlspecialchars($data['penulis']);
    $penerbit = htmlspecialchars($data['penerbit']);
    $tahun_terbit = htmlspecialchars($data['tahun_terbit']);
    $coverLama = htmlspecialchars($data['coverLama']);

    // cek apakah user pilih gambar baru atau tidak
    if($_FILES['cover']['error'] === 4) {
        $cover = $coverLama;
    } else {
        $cover = upload();
    }

    $query = "UPDATE buku SET
                kode_buku = '$kode_buku',
                judul = '$judul',
                penulis = '$penulis',
                penerbit = '$penerbit',
                tahun_terbit = $tahun_terbit,
                cover = '$cover'
              WHERE id = '$id'";
    
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id){
    global $conn;
    
    mysqli_query($conn, "DELETE FROM buku WHERE id=$id");

    return mysqli_affected_rows($conn);
}

function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $email = strtolower(stripslashes($data["email"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)) {
        echo "<script>
            alert('Username sudah terdaftar!')
        </script>";
        
        return false;
    }

    // cek konfirmasi password
    if($password !== $password2) {
        echo "<script>
            alert('Konfirmasi password tidak sesuai!');
        </script>";

        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan user baru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$email', '$password')");

    return mysqli_affected_rows($conn);
}

?>
