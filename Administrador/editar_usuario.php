<?php
include '../conexion.php'; // Realiza la conexion con la BBDD

session_start(); // Inicia la sesión


// Obtiene el ID del usuario selecionado
$id = $_GET['id'];

// Consulta SQL para seleccionar datos de la tabla usuarios y sus roles
$sql =  "SELECT usuarios.id, usuarios.nombre AS usuarios_nombre, usuarios.email, roles.nombre AS roles_nombre 
FROM usuarios
INNER JOIN roles ON usuarios.rol_id = roles.id
WHERE usuarios.id = $id " ;
// La consulta selecciona todos los usuarios, excepto los que tienen rol de administrador, 
// y devuelve su ID, nombre, correo electrónico, y el nombre de su rol asociado.

// Ejecuta la consulta SQL en la base de datos
$result = $conn->query($sql);

// Verifica si se encontraron resultados
if ($result->num_rows > 0) {
    // Obtiene la siguiente fila de resultados como un array asociativo

$usuario = $result->fetch_assoc();
    // Aquí puedes acceder a $usuario['usuarios_nombre'], $usuario['email'], etc.
} else {
    echo "No se encontraron usuarios."; // Mensaje para indicar que no hay resultados
    exit; // Detiene la ejecución si no hay usuarios
}

$sql2 = "SELECT * FROM roles"; 
$result2 = $conn->query($sql2); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="container mt-5">
    <div> <!--class="card mt-5 mx-auto" style="background-color: #d4edda; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);"-->
        <h3 class="text-center">Editar usuario</h3>
        <!-- REVISARRR<h6 class="my-4">Nombre de usuario : <?php echo $noticia['autor_nombre']; ?> </h6>--> 
        <form action="proceso_editar.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id ;?>">
            <div class="mb-3">
                <label for="username" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $usuario['usuarios_nombre']; ?>"required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $usuario['email']; ?>"required>
            </div>

            <div class ="mb-3">
                    <label for="rol" class="form-label">Rol:</label>
                    <select id="rol" name="rol" class="form-select" aria-label="Default select example">
                        <?php
                        if ($result2->num_rows > 0) {
                            while ($row = $result2->fetch_assoc()) {
                                if ($row['nombre'] === $usuario['roles_nombre']) {
                                    echo "<option value={$row['id']} selected>{$row['nombre']}</option>";
                                } else {
                                    echo "<option value={$row['id']}>{$row['nombre']}</option>";
                                }    
                            }
                        }
                        ?>

                    </select>
                </div>
            <button type="submit" class="btn btn-primary">Guardar cambios</button>
        </form>
    </div>
</body>
</html>