<?php
    include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" style="text/css" href="style.css">
    <title>Edit Data Tempat - SPKKN</title>
</head>
<body>
    <h1>Edit Data Tempat</h1>
    <?php
        if(isset($_GET['id_tempat'])) {
            $id_tempat = $_GET['id_tempat'];
            $result = $conn->query("SELECT * FROM tempat WHERE id_tempat = $id_tempat");
            $tempat = $result->fetch_assoc();
        }
    ?>
    <form method="POST" action="edit.php">
        <input type="hidden" name="id_tempat" value="<?php echo $tempat['id_tempat']; ?>">
        <label>Nama Tempat</label><br>
        <input type="text" name="nama_tempat" value="<?php echo $tempat['nama_tempat']; ?>" required>
        <br><br>
        <button type="submit">Perbarui</button>
    </form>
    <br>
    <a href="index.php">Kembali</a>
    <?php
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id_tempat = $_POST['id_tempat'];
            $nama_tempat = $_POST['nama_tempat'];

            $statement = $conn->prepare("UPDATE tempat SET nama_tempat = ? WHERE id_tempat = ?");
            $statement->bind_param("si", $nama_tempat, $id_tempat);
            if($statement->execute()) {
                echo "<br><br>Tempat baru berhasil diperbarui!";
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