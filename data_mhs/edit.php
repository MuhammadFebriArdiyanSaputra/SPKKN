<?php
include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit Data Mahasiswa - SPKKN</title>
</head>
<body>
    <div class="container">
        <h1>Edit Data Mahasiswa</h1>

        <?php
        if(isset($_GET['npm'])) {
            $npm = $_GET['npm'];
            $result = $conn->query("SELECT * FROM mahasiswa WHERE npm = $npm");
            $mahasiswa = $result->fetch_assoc();
        }
        ?>

        <form method="POST" action="edit.php">
            <label>NPM</label><br>
            <input type="text" name="npm" value="<?php echo $mahasiswa['npm']; ?>" readonly>
            <br><br>
            <label>Nama Mahasiswa</label><br>
            <input type="text" name="nama_mahasiswa" value="<?php echo $mahasiswa['nama_mahasiswa']; ?>" required>
            <br><br>
            <label>Program Studi</label><br>
            <input type="text" name="prodi" value="<?php echo $mahasiswa['prodi']; ?>" required>
            <br><br>
            <label>Angkatan</label><br>
            <input type="text" name="angkatan" value="<?php echo $mahasiswa['angkatan']; ?>" required>
            <br><br>
            <button type="submit">Perbarui</button>
        </form>
        <br>
        <a href="index.php">Kembali</a>

        <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $npm = $_POST['npm'];
            $nama_mahasiswa = $_POST['nama_mahasiswa'];
            $prodi = $_POST['prodi'];
            $angkatan = $_POST['angkatan'];

            $statement = $conn->prepare("UPDATE mahasiswa SET nama_mahasiswa = ?, prodi = ?, angkatan = ? WHERE npm = ?");
            $statement->bind_param("sssi", $nama_mahasiswa, $prodi, $angkatan, $npm);
            if($statement->execute()) {
                echo "<br><br>Mahasiswa berhasil diperbarui!";
                header("Location: index.php");
                exit;
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


