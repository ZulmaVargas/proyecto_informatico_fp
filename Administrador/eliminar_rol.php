<?php
// Incluir archivo de conexión a la BBDD
include '../conexion.php';

// Definir la consulta SQL para eliminar un registro de la tabla "roles" basado en el id proporcionado
$sql = "DELETE FROM roles WHERE id=$id";

// Ejecutar la consulta y verificar si fue exitosa
if ($conn->query($sql) === TRUE) {
    
    $conn->close();// Cerrar la conexión con la base de datos
    header("Location: roles_admin.php");// Redirigir al usuario a la página de administración de roles si la eliminación fue exitosa
    exit();// Terminar el script para asegurarse de que la redirección ocurra
} else {
    // Mostrar un mensaje de error si la eliminación falla
    echo "<div class='alert alert-danger'>Error eliminando rol: " . $conn->error . "</div>";
}
