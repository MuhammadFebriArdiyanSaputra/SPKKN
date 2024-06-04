<?php
    include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Penempatan Mahasiswa - SPKKN</title>
</head>
<body>
    <h1>Tambah Data Penempatan Mahasiswa</h1>
    <form method="POST" action="tambah.php">
        <label>Mahasiswa</label><br>
        <select name="npm" required>
            <option></option>
            <?php
                $mahasiswa = $connect->query("SELECT * FROM mahasiswa");
                while ($row = $mahasiswa->fetch_assoc()) {
                    echo "<option value='{$row['npm']}'>{$row['nama_mahasiswa']}</option>";
                }
            ?>
        </select>
        <br><br>
        <label>Tempat KKN</label><br>
        <select name="id_tempat" required>
            <option></option>
            <?php
                $tempat = $connect->query("SELECT * FROM tempat");
                while ($row = $tempat->fetch_assoc()) {
                    echo "<option value='{$row['id_tempat']}'>{$row['nama_tempat']}</option>";
                }
            ?>
        </select>
        <br><br>
        <button type="submit">Tambah</button>
    </form>
    <br>
    <a href="index.php">Kembali</a>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $npm = $_POST['npm'];
            $id_tempat = $_POST['id_tempat'];

            $statement = $connect->prepare("INSERT INTO tempat_mhs VALUES (NULL, ?, ?)");
            $statement->bind_param("ii", $npm, $id_tempat);
            if($statement->execute()) {
                echo "<br><br>Penempatan Mahasiswa baru berhasil ditambahkan!";
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