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
    <link rel="stylesheet" style="text/css">
    <title>Form DPL - SPKKN</title>
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
