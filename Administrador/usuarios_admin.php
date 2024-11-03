<?php
// Incluir archivo de conexión a la BBDD
include '../conexion.php';

session_start(); // Inicia la sesión

// Verifica si el usuario no ha iniciado sesión
if (!isset($_SESSION['username'])) {
    // Redirige al usuario a la página de inicio de sesión
    
header("Location: ../Login/login.php");
    
exit; // Detiene la ejecución del script
}

// Obtiene el ID del usuario actual desde la sesión
$id = $_SESSION['id']; 

// Consulta SQL para seleccionar datos de la tabla usuarios y sus roles
$sql = "SELECT usuarios.id, usuarios.nombre AS usuarios_nombre, usuarios.email, roles.nombre AS roles_nombre 
FROM usuarios
INNER JOIN roles ON usuarios.rol_id = roles.id
WHERE usuarios.rol_id != 1;" ;
// La consulta selecciona todos los usuarios, excepto los que tienen rol de administrador, 
// y devuelve su ID, nombre, correo electrónico, y el nombre de su rol asociado.

// Ejecuta la consulta SQL en la base de datos y guarda el resultado en la variable $result
$result = $conn->query($sql);


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Usuarios administrador</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="dashboard.php">Dashboard</a>
                    </li>


                </ul>
                <a href="../Login/cerrar_session.php" class="btn btn-danger">Cerrar Sesión</a>

            </div>
        </div>
    </nav>
    <div class="container">
        <h2 class="my-4">Bienvenido, <?php echo $_SESSION['username']; ?></h2>
        <div class="container text-left">
            <div class="row">
                <div class=" col-sm-12 col-md-4">
                    <div class="list-group">
                        <a href="dashboard_admin.php" class="list-group-item list-group-item-action ">
                            Principal
                        </a>
                        <a href="#" class="list-group-item list-group-item-action ">Noticias</a>
                        <a href="#" class="list-group-item list-group-item-action">Usuarios</a>
                        <a href="#" class="list-group-item list-group-item-action active" aria-current="true">Roles</a>
                        <a class="list-group-item list-group-item-action disabled" aria-disabled="true">Categorias</a>
                    </div>
                </div>
                <div class="col">
                </div>

            </div>
        </div>
        <?php
        if ($result->num_rows == 0) {
            echo '<h6>No hay usuarios para mostrar</h6>';
        } else {
            echo '
                <table class="table mt-5">
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NOMBRE</th>
                            <th scope="col">EMAIL</th>
                            <th scope="col">ROL</th>
                            <th scope="col">ELIMINAR</th>
                            <th scope="col">EDITAR</th>
                            </tr>
                        </thead>
                        <tbody>
                        ';
            while ($usuario = $result->fetch_assoc()) {
                echo "
                <tr>
                        <th >{$usuario['id']}</th>
                        <td>{$usuario['usuarios_nombre']}</td>
                        <td>{$usuario['email']}</td>
                        <td>{$usuario['roles_nombre']}</td>
                        <td>
                            <a href=\"eliminar_usuarios.php?id={$usuario['id']}\">
                            <i class=\"fa fa-trash\" aria-hidden=\"true\"></i>
                            </a>

                        </td>
                        <td>
                            <a href=\"editar_usuario.php?id={$usuario['id']}\">
                            <i class=\"fa fa-edit\" aria-hidden=\"true\"></i>
                            </a>

                        </td>


                </tr>
                ";
            }

            echo '</tbody></table>';
        }
        ?>
        <a href="../Login/registrar_usuario.php" class="btn btn-primary" role="button" aria-disabled="true">Agregar Usuario</a>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>