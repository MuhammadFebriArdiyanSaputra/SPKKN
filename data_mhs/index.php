<?php
include "../config.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" style="text/css">
    <title>Data Mahasiswa - SPKKN</title>
</head>

<style>
    body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #f4f4f4;
}

.container {
  width: 100%;
  margin: auto;
  overflow: hidden;
}

.header {
    background-color: rgba(76, 175, 80, 0.8);
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
  background-color: rgba(51, 51, 51, 0.8);
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
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 10px;
}

.table {
  width: 80%;
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
  background-color: rgba(76, 175, 80, 0.8);
  color: white;
}

.btn {
  display: inline-block;
  padding: 8px 12px;
  color: white;
  text-decoration: none;
  margin-top: 10px;
  margin-bottom: 10px;
}

.btn-primary {
  align-self: baseline;
  margin-left: 150px;
  background-color: rgba(76, 175, 80, 0.8);
}

.btn-info {
  background: #5bc0de;
}

.btn-danger {
  background: #d9534f;
}

.btn:hover {
  opacity: 0.8;
}

</style>

<body>
<div class="container">
        <div class="header">
            <img src="../logo.png">
            <h1>Sistem Penempatan KKN (SPKKN)</h1>
        </div>
        <nav class="navbar">
            <a href="../">Home</a>
            <a href="../data_dpl/index.php">Dosen Pembimbing Lapangan</a>
            <a href="#">Mahasiswa</a>
            <a href="../data_tempat/">Tempat KKN</a>
            <a href="../data_penempatan_dpl/">Penempatan DPL</a>
            <a href="../data_penempatan_mhs/">Penempatan Mahasiswa</a>
        </nav>
        <div class="mt-4">
            <h1>Data Mahasiswa</h1>
            <a href="tambah.php" class="btn btn-primary">Tambah Data</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NPM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Program Studi</th>
                        <th>Angkatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $nomor = 1;
                        $result = $conn->query("SELECT * FROM mahasiswa ORDER BY npm ASC;");
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>".$nomor."</td>
                                <td>".$row["npm"]."</td>
                                <td>".$row["nama_mahasiswa"]."</td>
                                <td>".$row["prodi"]."</td>
                                <td>".$row["angkatan"]."</td>
                                <td>
                                    <a href='edit.php?npm=".$row['npm']."' class='btn btn-info'>Edit</a>
                                    <a href='hapus.php?npm=".$row['npm']."' class='btn btn-danger' onclick=\"return confirm('Apakah benar mau menghapus data ini?');\">Hapus</a>
                                </td>
                            </tr>";
                            $nomor++;
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>