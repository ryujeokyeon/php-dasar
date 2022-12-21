<?php 
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}


function tambah($data) {
    global $conn;
    // ambil data dati tiap elemen dalam form
    $nama = htmlspecialchars($data["nama"]);
    $kategori = htmlspecialchars($data["kategori"]);
    $peran = htmlspecialchars($data["peran"]);
    $judul = htmlspecialchars($data["judul"]);

    // upload gambar
    $gambar = upload();
    if( !$gambar ) {
        return false;
    }

    // query insert data
    $query = "INSERT INTO chara
                VALUES
                ('', '$nama', '$kategori', '$peran', '$judul', '$gambar')
                ";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}


function upload() {

    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang diupload
    if( $error === 4 ) {
        echo "<script>
                alert('Pilih Gambar Terlebih Dahulu!');
                </script>";
        return false;
    }

    // cek yang diupload adalah gambar
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile) ;
    $ekstensiGambar = strtolower(end($ekstensiGambar));
    if( !in_array($ekstensiGambar, $ekstensiGambarValid) ) {
        echo "<script>
                alert('Yang Anda upload Bukan Gambar!');
            </script>";
    }

    // cek jika ukurannya terlalu besar
    if( $ukuranFile > 1000000 ) {
        echo "<script>
                alert('Ukuran Gambar Terlalu Besar!');
            </script>";
        return false;
    }

    // lolos pengecekan, gambar siap diupload
    //  generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;


}


function hapus($id) {
    global $conn;
    mysqli_query($conn, "DELETE FROM chara WHERE id = $id");
    return mysqli_affected_rows($conn);
}


function ubah($data) {
    global $conn;

    $id = $data["id"];
    $nama = htmlspecialchars($data["nama"]);
    $kategori = htmlspecialchars($data["kategori"]);
    $peran = htmlspecialchars($data["peran"]);
    $judul = htmlspecialchars($data["judul"]);
    $gambarLama = htmlspecialchars($data["gambarLama"]);

    // cek apakah user pilih gambar baru atau tidak
    if( $_FILES['gambar']['error'] === 4 ) {
        $gambar = $gambarLama;
    } else {
        $gambar = upload();
    }


    $query = "UPDATE chara SET
                nama = '$nama',
                kategori = '$kategori',
                peran = '$peran',
                judul = '$judul',
                gambar = '$gambar'
            WHERE id = $id
                ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword) {
    $query = "SELECT * FROM chara WHERE
                nama LIKE '%$keyword%' OR
                kategori LIKE '%$keyword%' OR
                peran LIKE '%$keyword%' OR
                judul LIKE '%$keyword%'
            ";
    return query($query);
}


function registrasi($data) {
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // cek username udah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");

    if( mysqli_fetch_assoc($result) ) {
        echo "<script>
                alert('Username Sudah terdaftar!');
            </script>";
        return false;
    }
    

    // cek konfirmasi password
    if( $password !== $password2 ) {
        echo "<script>
                alert('Password Tidak Sama!');
            </script>";
        return false;
    }

    // return 1;

    // ENKRIPSI PASSWORD
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambahkan userbaru ke database
    mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '$password')");

    return mysqli_affected_rows($conn);

}


?>