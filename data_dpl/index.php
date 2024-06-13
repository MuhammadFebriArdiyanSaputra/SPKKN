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
    <link rel="stylesheet" style="text/css">
    <title>Data DPL - SPKKN</title>
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
            <img src="../logo.png"/>
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
