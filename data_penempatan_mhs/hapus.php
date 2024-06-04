<?php
    include '../config.php';

    if(isset($_GET['id_tempat_mhs'])) {
        $id_tempat_mhs = $_GET['id_tempat_mhs'];

        $statement = $connect->prepare("DELETE FROM tempat_mhs WHERE id_tempat_mhs = ?");
        $statement->bind_param("i", $id_tempat_mhs);
        if($statement->execute()) {
            echo "Penempatan Mahasiswa berhasil dihapus!";
        } else {
            echo "Error : " . $statement->error;
        }
        $statement->close();
        header("Location: index.php");
        exit;
    }
?>