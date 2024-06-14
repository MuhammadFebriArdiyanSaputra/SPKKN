<?php
include "../config.php";

$id = '';
$nama = '';
$nip = '';
$kontak = '';

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM dpl WHERE id=$id");
    if ($result->num_rows > 0) {
        $dpl = $result->fetch_assoc();
        $nama = $dpl['nama'];
        $nip = $dpl['nip'];
        $kontak = $dpl['kontak'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <title>Form DPL - SPKKN</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            overflow: hidden;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: left;
            display: flex;
            align-items: center;
        }

        .header img {
            margin-right: 20px;
            height: 50px;
        }

        .navbar {
            display: flex;
            justify-content: flex-end;
            background-color: #333;
            padding: 10px 0;
        }

        .navbar a {
            color: white;
            padding: 14px 20px;
            text-decoration: none;
            text-align: center;
        }

        .navbar a:hover {
            background: #575757;
        }

        .mt-4 {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 20px;
        }

        .form-group {
            margin-bottom: 15px;
            width: 100%;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .table th,
        .table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .table th {
            background-color: #4CAF50;
            color: white;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 10px;
        }

        .btn-primary {
            background-color: #4CAF50;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn-primary:hover,
        .btn-secondary:hover {
            opacity: 0.8;
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="../logo.png" alt="Logo">
            <h1>Sistem Penempatan KKN (SPKKN)</h1>
        </div>
        <div class="mt-4">
            <h2><?php echo $id ? 'Edit DPL' : 'Tambah DPL'; ?></h2>
            <form method="post" action="index.php">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" id="nama" name="nama" value="<?php echo $nama; ?>" required>
                </div>
                <div class="form-group">
                    <label for="nip">NIP:</label>
                    <input type="text" id="nip" name="nip" value="<?php echo $nip; ?>" required>
                </div>
                <div class="form-group">
                    <label for="kontak">Kontak:</label>
                    <input type="text" id="kontak" name="kontak" value="<?php echo $kontak; ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="index.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</body>
</html>
