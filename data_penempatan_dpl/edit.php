<?php
    include "../config.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $id_tempat_dpl = $_POST['id_tempat_dpl'];
        $id_dpl = $_POST['id_dpl'];
        $id_tempat = $_POST['id_tempat'];

        $statement = $conn->prepare("UPDATE tempat_dpl SET id_dpl = ?, id_tempat = ? WHERE id_tempat_dpl = ?");
        $statement->bind_param("iii", $id_dpl, $id_tempat, $id_tempat_dpl);
        if($statement->execute()) {
            $statement->close();
            echo "<div class='message'>Penempatan DPL berhasil diperbarui!</div>";
            echo "<script>window.location.href = 'index.php';</script>";
            exit;
        } else {
            echo "<div class='message'>Error: " . $statement->error . "</div>";
        }
        $statement->close();
    }

    // Fetch the tempat_dpl data
    if(isset($_GET['id_tempat_dpl'])) {
        $id_tempat_dpl = $_GET['id_tempat_dpl'];
        $result = $conn->query("SELECT * FROM tempat_dpl WHERE id_tempat_dpl = $id_tempat_dpl");
        $tempat_dpl = $result->fetch_assoc();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>Edit Data Penempatan DPL - SPKKN</title>
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
        <h1>Edit Data Penempatan DPL</h1>
        <form method="POST" action="edit.php">
            <input type="hidden" name="id_tempat_dpl" value="<?php echo $tempat_dpl['id_tempat_dpl']; ?>">
            <label for="id_dpl">DPL</label>
            <select name="id_dpl" id="id_dpl" required>
                <option value="">Pilih DPL</option>
                <?php
                    $dpl = $conn->query("SELECT * FROM dpl");
                    while ($row = $dpl->fetch_assoc()) {
                        $selected = $row['id'] == $tempat_dpl['id_dpl'] ? 'selected' : '';
                        echo "<option value='{$row['id']}' $selected>{$row['nip']} - {$row['nama']}</option>";
                    }
                ?>
            </select>
            <label for="id_tempat">Tempat KKN</label>
            <select name="id_tempat" id="id_tempat" required>
                <option value="">Pilih Tempat KKN</option>
                <?php
                    $tempat = $conn->query("SELECT * FROM tempat");
                    while ($row = $tempat->fetch_assoc()) {
                        $selected = $row['id_tempat'] == $tempat_dpl['id_tempat'] ? 'selected' : '';
                        echo "<option value='{$row['id_tempat']}' $selected>{$row['nama_tempat']}</option>";
                    }
                ?>
            </select>
            <button type="submit">Perbarui</button>
        </form>
        <a href="index.php">Kembali</a>
        <?php
            if($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id_tempat_dpl = $_POST['id_tempat_dpl'];
                $id_dpl = $_POST['id_dpl'];
                $id_tempat = $_POST['id_tempat'];

                $statement = $conn->prepare("UPDATE tempat_dpl SET id_dpl = ?, id_tempat = ? WHERE id_tempat_dpl = ?");
                $statement->bind_param("iii", $id_dpl, $id_tempat, $id_tempat_dpl);
                if($statement->execute()) {
                    echo "<div class='message'>Penempatan DPL berhasil diperbarui!</div>";
                    echo "<script>window.location.href = 'index.php';</script>";
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