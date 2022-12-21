<?php 
session_start();

if( isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}

require 'functions.php';

// ambil data di URL
$id = $_GET["id"];

// query data chara berdasarkan id
$chr = query("SELECT * FROM chara WHERE id = $id")[0];

// cek apakah tombol submit sudah diklik atau belum
if( isset($_POST["sumbit"]) ) {

    // cek apakah data berhasil diubah atau tidak
    if( ubah($_POST) > 0 ) {
        echo "
            <script>
                alert('Data Berhasil diubah!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data Gagal diubah!');
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
    <title>Ubah Data Chara</title>
</head> 
<body>
    <h1>Ubah Data Chara</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $chr["id"]; ?>">
        <input type="hidden" name="gambarLama" value="<?= $chr["gambar"]; ?>">
        <ul>
            <li>
                <label for="nama">Nama  : </label>
                <input type="text" name="nama" id="nama" required value="<?= $chr["nama"]; ?>">
            </li>
            <li>
                <label for="judul">Judul  : </label>
                <input type="text" name="judul" id="judul" value="<?= $chr["judul"]; ?>">
            </li>
            <li>
                <label for="Peran">Peran  : </label>
                <input type="text" name="peran" id="peran" value="<?= $chr["peran"]; ?>">
            </li>
            <li>
                <label for="gambar">Gambar  : </label> <br>
                <img src="img/<?= $chr['gambar']; ?>" width="40"> <br>
                <input type="file" name="gambar" id="gambar">
            </li>
            <li>
                <label for="kategori">Kategori  : </label>
                <input type="text" name="kategori" id="kategori" value="<?= $chr["kategori"]; ?>">
            </li>
            <li>
                <button type="submit" name="sumbit">Ubah Data!</button>
            </li>
        </ul>


    </form>
</body>
</html>