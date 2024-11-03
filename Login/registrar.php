<?php
// Incluye el archivo de conexión a la base de datos
include '../conexion.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Recibir el nombre de usuario y la contraseña del formulario
       
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash de la contraseña para almacenamiento seguro
        $email = $_POST['email'];
        $rol_id = $_POST['roles'];

        //Tengo que fijarme que el usuario que voy a insertar no exista

        $sql_usuario = "SELECT * FROM usuarios WHERE nombre = '$username'";
        $result = $conn->query($sql_usuario); 

        //Tengo que fijarme que el email que voy a insertar no exista
        $sql_usuario2 = "SELECT * FROM usuarios WHERE email = '$email'";
        $result2 = $conn->query($sql_usuario2); 

        // Comprobar si hay resultados
        if($result->num_rows > 0){
            echo "<div class='alert alert-danger mt-3'>Usuario ya existente en la base de datos</div>" ;
            exit; //Asegúrate de usar exit después de header
        }

        if($result2->num_rows > 0){
            echo "<div class='alert alert-danger mt-3'>Correo electronico ya existente en la base de datos</div>" ;
            exit; //Asegúrate de usar exit después de header
        }

        // Ejecutar la inserción y manejar el resultado
        $sql = "INSERT INTO usuarios (nombre, email, contraseña, rol_id ) VALUES ('$username','$email','$password','$rol_id')";

        if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php"); // Redirigir al dashboard
        } else {
        echo "<div class='alert alert-danger mt-3'>Error: " . $conn->error . "</div>"; // Mostrar error si la inserción falla
        }
    } 
?>