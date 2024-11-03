<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['username'];
    $email = $_POST['email'];
    $rol = $_POST['rol'];

    $sql = "UPDATE usuarios SET nombre='$nombre', email='$email', rol_id='$rol' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header("Location: ../Administrador/usuarios_admin.php");
        exit();    } else {
        echo "<div class='alert alert-danger'>Error al guardar cambios: " . $conn->error . "</div>";
    }

    $conn->close();
}
?>