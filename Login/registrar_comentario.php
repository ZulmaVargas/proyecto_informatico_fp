<?php
include('../conexion.php');

$contenido = $_POST['contenido'];
session_start();

$id = $_SESSION['id'];
$noticia_id =  $_POST['noticia_id'];

$sql = "INSERT INTO comentarios (contenido,usuario_id,noticia_id) VALUES ('$contenido','$id','$noticia_id')";

if ($conn->query($sql) === TRUE) {
    header("Location: ../vistas/noticia_vista.php?id={$noticia_id}");
} else {
    echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
}

// Cerrar la conexión a la base de datos
$conn->close();