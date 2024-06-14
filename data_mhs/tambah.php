<?php
    include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mahasiswa - SPKKN</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
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
        <h1>Tambah Data Mahasiswa</h1>
        <form method="POST" action="tambah.php">
            <label>NPM</label>
            <input type="text" name="npm" required>
            <label>Nama Mahasiswa</label>
            <input type="text" name="nama_mahasiswa" required>
            <label>Program Studi</label>
            <input type="text" name="prodi" required>
            <label>Angkatan</label>
            <input type="text" name="angkatan" required>
            <button type="submit">Tambah</button>
        </form>
        <a href="index.php">Kembali</a>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $npm = $_POST['npm'];
                $nama_mahasiswa = $_POST['nama_mahasiswa'];
                $prodi = $_POST['prodi'];
                $angkatan = $_POST['angkatan'];

                $statement = $conn->prepare("INSERT INTO mahasiswa VALUES (?, ?, ?, ?)");
                $statement->bind_param("isss", $npm, $nama_mahasiswa, $prodi, $angkatan);
                if($statement->execute()) {
                    echo "<div class='message'>Mahasiswa baru berhasil ditambahkan!</div>";
                } else {
                    echo "<div class='message'>Error: " . $statement->error . "</div>";
                }
                $statement->close();
                header("Location: index.php");
                exit;
            }
        ?>
    </div>
</body>
</html>
