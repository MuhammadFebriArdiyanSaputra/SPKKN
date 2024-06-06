<?php
    include '../config.php';

    if(isset($_GET['id_tempat'])) {
        $id_tempat = $_GET['id_tempat'];

        $statement = $conn->prepare("DELETE FROM tempat WHERE id_tempat = ?");
        $statement->bind_param("i", $id_tempat);
        if($statement->execute()) {
            echo "Tempat berhasil dihapus!";
        } else {
            echo "Error : " . $statement->error;
        }
        $statement->close();
        header("Location: index.php");
        exit;
    }
?>