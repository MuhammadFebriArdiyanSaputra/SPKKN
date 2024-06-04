<?php
    include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa - SPKKN</title>
</head>
<body>
    <h1>Tambah Data Mahasiswa</h1>
    <form method="POST" action="tambah.php">
        <label>NPM</label><br>
        <input type="text" name="npm" required>
        <br><br>
        <label>Nama Mahasiswa</label><br>
        <input type="text" name="nama_mahasiswa" required>
        <br><br>
        <label>Program Studi</label><br>
        <input type="text" name="prodi" required>
        <br><br>
        <label>Angkatan</label><br>
        <input type="text" name="angkatan" required>
        <br><br>
        <button type="submit">Tambah</button>
    </form>
    <br>
    <a href="index.php">Kembali</a>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $npm = $_POST['npm'];
            $nama_mahasiswa = $_POST['nama_mahasiswa'];
            $prodi = $_POST['prodi'];
            $angkatan = $_POST['angkatan'];

            $statement = $connect->prepare("INSERT INTO mahasiswa VALUES (?, ?, ?, ?)");
            $statement->bind_param("isss", $npm, $nama_mahasiswa, $prodi, $angkatan);
            if($statement->execute()) {
                echo "<br><br>Mahasiswa baru berhasil ditambahkan!";
            } else {
                echo "Error : " . $statement->error;
            }
            $statement->close();
            header("Location: index.php");
            exit;
        }
    ?>
</body>
</html>