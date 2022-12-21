<?php 
session_start();

if( !isset($_SESSION["login"]) ) {
    header("location: login.php");
    exit;
}

require 'functions.php';

$chara = query("SELECT * FROM chara");

//  tombol cari ditekan
if( isset($_POST["cari"]) ) {
    $chara = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>
<body>
    
<button><a href="logout.php">LOGOUT</a></button>

    <h1>Daftar Chara</h1>

    <a href="tambah.php">Tambah Data Chara</a>
    <br><br>

    <form action="" method="post">

        <input type="text" name="keyword" size="50" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Cari!</button>

    <br><br>
    </form>

<div id="container">
    <table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>No.</th>
        <th>Aksi</th>
        <th>Gambar</th>
        <th>Nama</th>
        <th>Kategori</th>
        <th>Judul</th>
        <th>Peran</th>
    </tr>

    <!-- $i untuk nomor urutnya -->
    <?php $i = 1; ?>
    <!-- pengulangan -->
    <?php foreach ($chara as $row ) : ?>
    <tr>
        <!-- tampilakan $i -->
        <td><?= $i; ?></td>
        <td>
            <a href="ubah.php?id=<?= $row["id"];  ?>">Ubah</a> |
            <a href="hapus.php?id=<?= $row["id"];  ?>" onclick="return confirm('Yakin Hapus Data?');">Hapus</a>
        </td>
        <td><img src="img/<?= $row["gambar"];  ?>" width="50" alt="<?= $row["nama"]; ?>"></td>
        <td><?= $row["nama"];  ?></td>
        <td><?= $row["kategori"];  ?></td>
        <td><?= $row["judul"];  ?></td>
        <td><?= $row["peran"];  ?></td>
    </tr>
    <?php $i++; ?>
    <!-- END $i untuk nomor urutnya -->
    <?php endforeach; ?>

    </table>
</div>
    <script src="js/script.js"></script>
</body>
</html>