<?php
include "../config.php";

$id_tempat_dpl = $_GET['id_tempat_dpl'];

$sql = "DELETE FROM tempat_dpl WHERE id_tempat_dpl=$id_tempat_dpl";

if ($conn->query($sql) === TRUE) {
    header("Location: index.php");
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
