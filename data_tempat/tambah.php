<?php
    include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Tempat - SPKKN</title>
</head>
<body>
    <h1>Tambah Data Tempat</h1>
    <form method="POST" action="tambah.php">
        <label>Nama Tempat</label><br>
        <input type="text" name="nama_tempat" required>
        <br><br>
        <button type="submit">Tambah</button>
    </form>
    <br>
    <a href="index.php">Kembali</a>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nama_tempat = $_POST['nama_tempat'];

            $statement = $conn->prepare("INSERT INTO tempat(nama_tempat) VALUES (?)");
            $statement->bind_param("s", $nama_tempat);
            if($statement->execute()) {
                echo "<br><br>Tempat baru berhasil ditambahkan!";
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