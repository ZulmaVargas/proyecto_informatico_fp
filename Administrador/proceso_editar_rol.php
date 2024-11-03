<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['username'];

    $sql = "UPDATE roles SET nombre='$nombre' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../Administrador/roles_admin.php");
        exit();    } else {
        echo "<div class='alert alert-danger'>Error al guardar cambios: " . $conn->error . "</div>";
    }

    $conn->close();
}
?>