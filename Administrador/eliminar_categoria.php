<?php
include '../conexion.php';

$id = $_GET['id'];

$sql = "DELETE FROM categorias WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    $conn->close();
    header("Location: categorias_admin.php");
    exit();
} else {
    echo "<div class='alert alert-danger'>Error eliminando categoria: " . $conn->error . "</div>";
}
