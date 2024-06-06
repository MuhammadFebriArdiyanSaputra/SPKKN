<?php
    include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    <title>Data Mahasiswa - SPKKN</title>
</head>
<body>
    <div class="header">
        <h1>Sistem Penempatan KKN (SPKKN)</h1>
    </div>
    <nav class="navbar">
        <a href="../">Home</a>
        <a href="../data_dpl/">Dosen Pembimbing Lapangan</a>
        <a href="#">Mahasiswa</a>
        <a href="../data_tempat/">Tempat KKN</a>
        <a href="../data_penempatan_dpl/">Penempatan DPL</a>
        <a href="../data_penempatan_mhs/">Penempatan Mahasiswa</a>
    </nav>
    <h1>Data Mahasiswa</h1>
    <a href="tambah.php">Tambah Data</a>
    <table border="1">
        <tr>
            <th>No</th>
            <th>NPM</th>
            <th>Nama Mahasiswa</th>
            <th>Program Studi</th>
            <th>Angkatan</th>
            <th>Aksi</th>
        </tr>
        <?php
            $nomor = 1;
            $result = $connect->query("SELECT * FROM mahasiswa;");
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>".$nomor."</td>
                    <td>".$row["npm"]."</td>
                    <td>".$row["nama_mahasiswa"]."</td>
                    <td>".$row["prodi"]."</td>
                    <td>".$row["angkatan"]."</td>
                    <td>
                        <a href='edit.php?npm=".$row['npm']."'>Edit</a>
                        <a href='hapus.php?npm=".$row['npm']."' onclick=\"return confirm('Apakah benar mau menghapus data ini?');\">Hapus</a>
                    </td>
                </tr>";
                $nomor++;
            }
        ?>
    </table>
=======
    <link rel="stylesheet" style="text/css" href="style.css">
    <title>Data Mahasiswa - SPKKN</title>
</head>
<body>
<div class="container">
        <div class="header">
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
                        $result = $conn->query("SELECT * FROM mahasiswa;");
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
>>>>>>> 53a8fb8 (edit dpl, mahasiswa and tempat)
</body>
</html>