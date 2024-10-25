<?php
// Incluir archivo de conexión a la base de datos
include '../conexion.php'; 

// Iniciar la sesión
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //Recibe los datos ingresados en el formulario de la página en agregar noticia 
    $titulo = $_POST['titulo'];
    $imagen = $_POST['imagen'];
    $descripcion = $_POST['descripcion'];
    $categoria_id = $_POST['categoria'];
    $autor_id =  $_SESSION['id'];

     
    // Ejecutar la inserción y manejar el resultado
    $sql = "INSERT INTO noticias (titulo,texto,imagen_link,categoria_id,autor_id) VALUES ('$titulo', '$descripcion','$imagen', '$categoria_id','$autor_id')";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php"); // Redirigir al dashboard
    } else {
        // Mostrar error si la inserción falla
        echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>";
    }
}
