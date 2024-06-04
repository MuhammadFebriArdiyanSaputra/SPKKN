<?php
    include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penempatan Mahasiswa - SPKKN</title>
</head>
<body>
    <div class="header">
        <h1>Sistem Penempatan KKN (SPKKN)</h1>
    </div>
    <nav class="navbar">
        <a href="../">Home</a>
        <a href="../data_dpl/">Dosen Pembimbing Lapangan</a>
        <a href="../data_mhs/">Mahasiswa</a>
        <a href="#">Tempat KKN</a>
        <a href="../data_penempatan_dpl/">Penempatan DPL</a>
        <a href="../data_penempatan_mhs/">Penempatan Mahasiswa</a>
    </nav>
    <h1>Data Penempatan Mahasiswa</h1>
    <a href="tambah.php">Tambah Data</a>
    <table border="1">
        <tr>
            <th>No</th>
            <th>NPM</th>
            <th>Nama Mahasiswa</th>
            <th>Tempat KKN</th>
            <th>Aksi</th>
        </tr>
        <?php
            $nomor = 1;
            $result = $connect->query("SELECT * FROM penempatan_mhs;");
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>".$nomor."</td>
                    <td>".$row["npm"]."</td>
                    <td>".$row["nama_mahasiswa"]."</td>
                    <td>".$row["nama_tempat"]."</td>
                    <td>
                        <a href='edit.php?id_tempat_mhs=".$row['id_tempat_mhs']."'>Edit</a>
                        <a href='hapus.php?id_tempat_mhs=".$row['id_tempat_mhs']."' onclick=\"return confirm('Apakah benar mau menghapus data ini?');\">Hapus</a>
                    </td>
                </tr>";
                $nomor++;
            }
        ?>
    </table>
</body>
</html>