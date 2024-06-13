<?php
include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" style="text/css" href="styletmptdpl.css">
    <title>Data Penempatan DPL - SPKKN</title>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Sistem Penempatan KKN (SPKKN)</h1>
    </div>
    <nav class="navbar">
        <a href="../">Home</a>
        <a href="../data_dpl/index.php">Dosen Pembimbing Lapangan</a>
        <a href="../data_mhs/">Mahasiswa</a>
        <a href="../data_tempat/">Tempat KKN</a>
        <a href="../data_penempatan_dpl/">Penempatan DPL</a>
        <a href="../data_penempatan_mhs/">Penempatan Mahasiswa</a>
    </nav>
    <div class="mt-4">
    <h1>Data Penempatan DPL</h1>
    <a href="tambah.php" class="btn btn-primary">Tambah Data</a>
    <table class="table">
        <thead>
        <tr>
            <th>No</th>
            <th>NIP</th>
            <th>Nama DPL</th>
            <th>Kontak</th>
            <th>Penempatan DPL</th>
            <th>Aksi</th>
        </tr>
        <thead>
        <tbody>
        <?php
            $nomor = 1;
            $result = $conn->query("SELECT * FROM penempatan_dpl ORDER BY nip ASC");

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>".$nomor."</td>
                        <td>".$row["nip"]."</td>
                        <td>".$row["nama"]."</td>
                        <td>".$row["kontak"]."</td>
                        <td>".$row["nama_tempat"]."</td>
                        <td>
                            <a href='edit.php?id_tempat_dpl=".$row['id_tempat_dpl']."' class='btn btn-info'>Edit</a>
                            <a href='hapus.php?id_tempat_dpl=".$row['id_tempat_dpl']."'  class='btn btn-danger' onclick=\"return confirm('Apakah benar mau menghapus data ini?');\">Hapus</a>
                        </td>
                    </tr>";
                    $nomor++;
                }
            } else {
                echo "<tr><td colspan='4'>Tidak ada data ditemukan</td></tr>";
            }
        ?>
        <tbody>
    </table>
    </div>
</div>
</body>
</html>
