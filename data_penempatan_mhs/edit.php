<?php
    include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Penempatan Mahasiswa - SPKKN</title>
</head>
<body>
    <h1>Edit Data Penempatan Mahasiswa</h1>
    <?php
        if(isset($_GET['id_tempat_mhs'])) {
            $id_tempat_mhs = $_GET['id_tempat_mhs'];
            $result = $conn->query("SELECT * FROM tempat_mhs WHERE id_tempat_mhs = $id_tempat_mhs");
            $tempat_mhs = $result->fetch_assoc();
        }
    ?>
    <form method="POST" action="edit.php">
        <input type="hidden" name="id_tempat_mhs" value="<?php echo $tempat_mhs['id_tempat_mhs']; ?>">
        <label>Mahasiswa</label><br>
        <select name="npm" required>
            <option></option>
            <?php
                $mahasiswa = $conn->query("SELECT * FROM mahasiswa");
                while ($row = $mahasiswa->fetch_assoc()) {
                    $selected = $row['npm'] == $tempat_mhs['npm'] ? 'selected' : '';
                    echo "<option value='{$row['npm']}' $selected>{$row['npm']} - {$row['nama_mahasiswa']}</option>";
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
                    $selected = $row['id_tempat'] == $tempat_mhs['id_tempat'] ? 'selected' : '';
                    echo "<option value='{$row['id_tempat']}' $selected>{$row['nama_tempat']}</option>";
                }
            ?>
        </select>
        <br><br>
        <button type="submit">Perbarui</button>
    </form>
    <br>
    <a href="index.php">Kembali</a>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_tempat_mhs = $_POST['id_tempat_mhs'];
            $npm = $_POST['npm'];
            $id_tempat = $_POST['id_tempat'];

            $statement = $conn->prepare("UPDATE tempat_mhs SET npm = ?, id_tempat = ? WHERE id_tempat_mhs = ?");
            $statement->bind_param("iii", $npm, $id_tempat, $id_tempat_mhs);
            if($statement->execute()) {
                echo "<br><br>Penempatan Mahasiswa baru berhasil diperbarui!";
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