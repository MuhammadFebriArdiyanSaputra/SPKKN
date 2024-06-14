<?php
    include "../config.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_tempat_mhs = $_POST['id_tempat_mhs'];
        $npm = $_POST['npm'];
        $id_tempat = $_POST['id_tempat'];

        $statement = $conn->prepare("UPDATE tempat_mhs SET npm = ?, id_tempat = ? WHERE id_tempat_mhs = ?");
        $statement->bind_param("iii", $npm, $id_tempat, $id_tempat_mhs);
        if($statement->execute()) {
            $statement->close();
            echo "<div class='message'>Penempatan Mahasiswa baru berhasil diperbarui!</div>";
            echo "<script>window.location.href = 'index.php';</script>";
            exit;
        } else {
            echo "<div class='message'>Error : " . $statement->error . "</div>";
        }
        $statement->close();
    }

    // Fetch the tempat_mhs data
    if(isset($_GET['id_tempat_mhs'])) {
        $id_tempat_mhs = $_GET['id_tempat_mhs'];
        $result = $conn->query("SELECT * FROM tempat_mhs WHERE id_tempat_mhs = $id_tempat_mhs");
        $tempat_mhs = $result->fetch_assoc();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>Edit Data Penempatan Mahasiswa - SPKKN</title>
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
        <h1>Edit Data Penempatan Mahasiswa</h1>
        <form method="POST" action="edit.php">
            <input type="hidden" name="id_tempat_mhs" value="<?php echo $tempat_mhs['id_tempat_mhs']; ?>">
            <label for="npm">Mahasiswa</label>
            <select name="npm" id="npm" required>
                <option value="">Pilih Mahasiswa</option>
                <?php
                    $mahasiswa = $conn->query("SELECT * FROM mahasiswa");
                    while ($row = $mahasiswa->fetch_assoc()) {
                        $selected = $row['npm'] == $tempat_mhs['npm'] ? 'selected' : '';
                        echo "<option value='{$row['npm']}' $selected>{$row['npm']} - {$row['nama_mahasiswa']}</option>";
                    }
                ?>
            </select>

            <label for="id_tempat">Tempat KKN</label>
            <select name="id_tempat" id="id_tempat" required>
                <option value="">Pilih Tempat KKN</option>
                <?php
                    $tempat = $conn->query("SELECT * FROM tempat");
                    while ($row = $tempat->fetch_assoc()) {
                        $selected = $row['id_tempat'] == $tempat_mhs['id_tempat'] ? 'selected' : '';
                        echo "<option value='{$row['id_tempat']}' $selected>{$row['nama_tempat']}</option>";
                    }
                ?>
            </select>
            
            <button type="submit">Perbarui</button>
        </form>
        <a href="index.php">Kembali</a>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id_tempat_mhs = $_POST['id_tempat_mhs'];
                $npm = $_POST['npm'];
                $id_tempat = $_POST['id_tempat'];

                $statement = $conn->prepare("UPDATE tempat_mhs SET npm = ?, id_tempat = ? WHERE id_tempat_mhs = ?");
                $statement->bind_param("iii", $npm, $id_tempat, $id_tempat_mhs);
                if($statement->execute()) {
                    echo "<div class='message'>Penempatan Mahasiswa baru berhasil diperbarui!</div>";
                    echo "<script>window.location.href = 'index.php';</script>";
                    exit;
                } else {
                    echo "<div class='message'>Error : " . $statement->error . "</div>";
                }
                $statement->close();
            }
        ?>
    </div>
</body>
</html>