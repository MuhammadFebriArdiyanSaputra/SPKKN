<?php
include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>Edit Data Mahasiswa - SPKKN</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
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
            padding: 20px 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
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

        .message {
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
            color: #333;
        }
    </style>
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
            <label>NPM</label>
            <input type="text" name="npm" value="<?php echo $mahasiswa['npm']; ?>" readonly>

            <label>Nama Mahasiswa</label>
            <input type="text" name="nama_mahasiswa" value="<?php echo $mahasiswa['nama_mahasiswa']; ?>" required>

            <label>Program Studi</label>
            <input type="text" name="prodi" value="<?php echo $mahasiswa['prodi']; ?>" required>

            <label>Angkatan</label>
            <input type="text" name="angkatan" value="<?php echo $mahasiswa['angkatan']; ?>" required>

            <button type="submit">Perbarui</button>
        </form>
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
                echo "<div class='message'>Mahasiswa berhasil diperbarui!</div>";
                header("Location: index.php");
                exit;
            } else {
                echo "<div class='message'>Error: " . $statement->error . "</div>";
            }
            $statement->close();
        }
        ?>
    </div>
</body>
</html>
