<?php 
require '../functions.php';

// tangkap keyword dari script.js keyword.values
$keyword = $_GET["keyword"];

$query = "SELECT * FROM chara WHERE
            nama LIKE '%$keyword%' OR
            kategori LIKE '%$keyword%' OR
            peran LIKE '%$keyword%' OR
            judul LIKE '%$keyword%'
        ";
$chara = query($query);

?>
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