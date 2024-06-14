<?php
    include "../config.php";

    if(isset($_GET['id_tempat'])) {
        $id_tempat = $_GET['id_tempat'];
        $result = $conn->query("SELECT * FROM tempat WHERE id_tempat = $id_tempat");
        $tempat = $result->fetch_assoc();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit Data Tempat - SPKKN</title>
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    width: 100%;
}

h1 {
    text-align: center;
    color: #4CAF50;
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

label {
    font-weight: bold;
}

input[type="text"] {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
    width: 100%;
}

button {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #45a049;
}

a {
    text-align: center;
    display: block;
    margin-top: 20px;
    color: #4CAF50;
    text-decoration: none;
    font-size: 16px;
}

a:hover {
    text-decoration: underline;
}

.success-message {
    text-align: center;
    margin-top: 20px;
    color: #4CAF50;
}

.error-message {
    text-align: center;
    margin-top: 20px;
    color: #f44336;
}
</style>
<body>
    <div class="container">
        <h1>Edit Data Tempat</h1>
        <form method="POST" action="edit.php">
            <input type="hidden" name="id_tempat" value="<?php echo $tempat['id_tempat']; ?>">
            <label for="nama_tempat">Nama Tempat</label><br>
            <input type="text" id="nama_tempat" name="nama_tempat" value="<?php echo $tempat['nama_tempat']; ?>" required>
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
                    echo "<br><br><p class='success-message'>Tempat berhasil diperbarui!</p>";
                } else {
                    echo "<p class='error-message'>Error : " . $statement->error . "</p>";
                }
                $statement->close();
                header("Location: index.php");
                exit;
            }
        ?>
    </div>
</body>
</html>
