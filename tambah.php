<?php 
session_start();

if( isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}
// gak perlu $conn lagi karna sudah dilakukan di functions.php

require 'functions.php';

// cek apakah tombol submit sudah diklik atau belum
if( isset($_POST["sumbit"]) ) {
    

    // cek apakah data berhasil ditambahkan atau tidak
    if( tambah($_POST) > 0 ) {
        echo "
            <script>
                alert('Data Berhasil ditambahkan!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
        <script>
            alert('Data Gagal ditambahkan!');
            document.location.href = 'index.php';
        </script>
    ";
    }
    
    
} 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Chara</title>
</head> 
<body>
    <h1>Tambah Data Chara</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <ul>
            <li>
                <label for="nama">Nama  : </label>
                <input type="text" name="nama" id="nama" required>
            </li>
            <li>
                <label for="judul">Judul  : </label>
                <input type="text" name="judul" id="judul">
            </li>
            <li>
                <label for="Peran">Peran  : </label>
                <input type="text" name="peran" id="peran">
            </li>
            <li>
                <label for="gambar">Gambar  : </label>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <label for="kategori">Kategori  : </label>
                <input type="text" name="kategori" id="kategori">
            </li>
            <li>
                <button type="submit" name="sumbit">Tambah Data!</button>
            </li>
        </ul>


    </form>
</body>
</html>