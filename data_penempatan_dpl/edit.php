<?php
    include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Penempatan DPL - SPKKN</title>
</head>
<body>
    <h1>Edit Data Penempatan DPL</h1>
    <?php
        if(isset($_GET['id_tempat_dpl'])) {
            $id_tempat_dpl = $_GET['id_tempat_dpl'];
            $result = $conn->query("SELECT * FROM tempat_dpl WHERE id_tempat_dpl = $id_tempat_dpl");
            $tempat_dpl = $result->fetch_assoc();
        }
    ?>
    <form method="POST" action="edit.php">
        <input type="hidden" name="id_tempat_dpl" value="<?php echo $tempat_dpl['id_tempat_dpl']; ?>">
        <label>DPL</label><br>
        <select name="nip" required>
            <option></option>
            <?php
                $dpl = $conn->query("SELECT * FROM dpl");
                while ($row = $dpl->fetch_assoc()) {
                    $selected = $row['nip'] == $tempat_dpl['nip'] ? 'selected' : '';
                    echo "<option value='{$row['nip']}' $selected>{$row['nama']}</option>";
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
            $id_tempat_dpl = $_POST['id_tempat_dpl'];
            $nip = $_POST['nip'];
            $id_tempat = $_POST['id_tempat'];

            $statement = $conn->prepare("UPDATE tempat_dpl SET nip = ?, id_tempat = ? WHERE id_tempat_dpl = ?");
            $statement->bind_param("iii", $nip, $id_tempat, $id_tempat_dpl);
            if($statement->execute()) {
                echo "<br><br>Penempatan DPL baru berhasil diperbarui!";
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