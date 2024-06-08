<?php
    include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Penempatan DPL - SPKKN</title>
</head>
<body>
    <h1>Tambah Data Penempatan DPL</h1>
    <form method="POST" action="tambah.php">
        <label>DPL</label><br>
        <select name="nip" required>
            <option></option>
            <?php
                $dpl = $conn->query("SELECT * FROM dpl");
                while ($row = $dpl->fetch_assoc()) {
                    echo "<option value='{$row['nip']}'>{$row['nama']}</option>";
                }
            ?>
        </select>
        <br><br>
        <label>Tempat KKN</label><br>
        <select name="id_tempat" required>
            <option></option>
            <?php
                $tempat = $conn->query("SELECT * FROM tempat");
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
            $nip = $_POST['nip'];
            $id_tempat = $_POST['id_tempat'];

            $statement = $conn->prepare("INSERT INTO tempat_dpl VALUES (NULL, ?, ?)");
            $statement->bind_param("ii", $nip, $id_tempat);
            if($statement->execute()) {
                echo "<br><br>Penempatan DPL baru berhasil ditambahkan!";
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