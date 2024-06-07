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
    <link rel="stylesheet" href="style.css">
    <title>Form DPL - SPKKN</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Sistem Penempatan KKN (SPKKN)</h1>
        </div>
        <nav class="navbar">
            <a href="../">Home</a>
            <a href="#">Dosen Pembimbing Lapangan</a>
            <a href="../data_mhs/">Mahasiswa</a>
            <a href="../data_tempat/">Tempat KKN</a>
            <a href="../data_penempatan_dpl/">Penempatan DPL</a>
            <a href="../data_penempatan_mhs/">Penempatan Mahasiswa</a>
        </nav>

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
