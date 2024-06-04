<?php
    include '../config.php';

    if(isset($_GET['npm'])) {
        $npm = $_GET['npm'];

        $statement = $connect->prepare("DELETE FROM mahasiswa WHERE npm = ?");
        $statement->bind_param("i", $npm);
        if($statement->execute()) {
            echo "Mahasiswa berhasil dihapus!";
        } else {
            echo "Error : " . $statement->error;
        }
        $statement->close();
        header("Location: index.php");
        exit;
    }
?>