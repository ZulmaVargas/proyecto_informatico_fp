<?php
// Incluir archivo de conexión a la base de datos
include '../conexion.php';

$id = $_GET['id'];
$sql = "DELETE FROM noticias WHERE id=$id"; // Elimina la noticia selccionada

if ($conn->query($sql) === TRUE) {
    $conn->close();
    header("Location: dashboard.php"); // Redirigir al dashboard
    exit();
} else {
    echo "<div class='alert alert-danger'>Error eliminando registro: " . $conn->error . "</div>";
}