<?php
    include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>Tambah Data Penempatan Mahasiswa - SPKKN</title>
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

        select, input[type="text"] {
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
        <h1>Tambah Data Penempatan Mahasiswa</h1>
        <form method="POST" action="tambah.php">
            <label for="npm">Mahasiswa</label>
            <select name="npm" id="npm" required>
                <option value="">Pilih Mahasiswa</option>
                <?php
                    $mahasiswa = $conn->query("SELECT * FROM mahasiswa");
                    while ($row = $mahasiswa->fetch_assoc()) {
                        echo "<option value='{$row['npm']}'>{$row['npm']} - {$row['nama_mahasiswa']}</option>";
                    }
                ?>
            </select>

            <label for="id_tempat">Tempat KKN</label>
            <select name="id_tempat" id="id_tempat" required>
                <option value="">Pilih Tempat KKN</option>
                <?php
                    $tempat = $conn->query("SELECT * FROM tempat");
                    while ($row = $tempat->fetch_assoc()) {
                        echo "<option value='{$row['id_tempat']}'>{$row['nama_tempat']}</option>";
                    }
                ?>
            </select>
            
            <button type="submit">Tambah</button>
        </form>
        <a href="index.php">Kembali</a>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $npm = $_POST['npm'];
                $id_tempat = $_POST['id_tempat'];

                $statement = $conn->prepare("INSERT INTO tempat_mhs VALUES (NULL, ?, ?)");
                $statement->bind_param("ii", $npm, $id_tempat);
                if($statement->execute()) {
                    echo "<div class='message'>Penempatan Mahasiswa baru berhasil ditambahkan!</div>";
                } else {
                    echo "<div class='message'>Error : " . $statement->error . "</div>";
                }
                $statement->close();
                header("Location: index.php");
                exit;
            }
        ?>
    </div>
</body>
</html>
