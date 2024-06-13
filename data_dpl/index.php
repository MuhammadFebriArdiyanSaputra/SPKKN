<?php
include "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nip = $_POST['nip'];
    $kontak = $_POST['kontak'];
    $id = $_POST['id'];

    if ($id) {
        $sql = "UPDATE dpl SET nama='$nama', nip='$nip', kontak='$kontak' WHERE id=$id";
    } else {
        $sql = "INSERT INTO dpl (nama, nip, kontak) VALUES ('$nama', '$nip', '$kontak')";
    }
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM dpl WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$dplList = $conn->query("SELECT * FROM dpl ORDER BY nip ASC");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" style="text/css" href="styledpl.css">
    <title>Data DPL - SPKKN</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Sistem Penempatan KKN (SPKKN)</h1>
        </div>
        <nav class="navbar">
            <a href="../index.html">Home</a>
            <a href="../data_dpl/index.php">Dosen Pembimbing Lapangan</a>
            <a href="../data_mhs/index.php">Mahasiswa</a>
            <a href="../data_tempat/index.php">Tempat KKN</a>
            <a href="../data_penempatan_dpl/">Penempatan DPL</a>
            <a href="../data_penempatan_mhs/">Penempatan Mahasiswa</a>
        </nav>

        <div class="mt-4">
            <h2>Dosen Pembimbing Lapangan</h2>
            <a href="form.php" class="btn btn-primary">Tambah DPL</a>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Dosen</th>
                        <th>NIP</th>
                        <th>Kontak</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $nomor = 1;
                        
                        while ($row = $dplList->fetch_assoc()):    
                    ?>
                        <tr>
                            <td><?php echo $nomor; ?></td>
                            <td><?php echo $row['nama']; ?></td>
                            <td><?php echo $row['nip']; ?></td>
                            <td><?php echo $row['kontak']; ?></td>
                            <td>
                                <a href="form.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                                <a href="index.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php
                            $nomor++;

                        endwhile;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
