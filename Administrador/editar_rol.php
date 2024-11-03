<?php
include '../conexion.php'; 

session_start(); // Inicia la sesión


// Obtiene el ID del usuario actual desde la sesión
$id = $_GET['id'];

// Consulta SQL para seleccionar datos de la tabla roles  con el id de la categoria seleccionada
$sql =  "SELECT * FROM roles WHERE id = $id;"; 

// Ejecuta la consulta SQL en la base de datos
$result =  $conn->query($sql);

// Verifica si se encontraron resultados
if ($result->num_rows > 0) {
    // Obtiene la siguiente fila de resultados como un array asociativo

$rol = $result->fetch_assoc();
    // Aquí puedes acceder a $rol['id'], $rol['nombre'].
} else {
    echo "No se encontraron categorias."; // Mensaje para indicar que no hay resultados
    exit; // Detiene la ejecución si no hay roles.
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar rol</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="container mt-5">
    <div> <!--class="card mt-5 mx-auto" style="background-color: #d4edda; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);"-->
        <h3 class="text-center">Editar rol</h3>

        <form action="proceso_editar_rol.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id ;?>">
            <div class="mb-3">
                <label for="username" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $rol['nombre']; ?>"required>
            </div>
           
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
    </div>
</body>
</html>