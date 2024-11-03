<?php
// Incluir archivo de conexión a la base de datos
include '../conexion.php'; 

// Iniciar la sesión
session_start();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Recibe los datos ingresados en el formulario de la página en agregar categoria
    $categoria = $_POST['categoria'];

    //Inserta los datos recibidos a la tabla de categorias
    $sql = "INSERT INTO categorias (nombre) VALUES ('$categoria')";

    if ($conn->query($sql) === TRUE) {
        header("Location: categorias_admin.php");// Redirigir al dashboard del administrador 
    } else { // Mostrar error si la inserción falla
        echo "<div class='alert alert-danger mt-3'>Error:  " . $conn->error . "</div>";
    }
}


/*if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {

    $rol_id = $_POST['rol_id'];


    $sql = "INSERT INTO roles (nombre) VALUES ('$rol')";

    if ($conn->query($sql) === TRUE) {
        header("Location: roles_admin.php");
    } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
    }
}*/