<?php
// Incluir el archivo de conexión a la base de datos
include '../conexion.php';

// Iniciar la sesión
session_start();

if (!isset($_SESSION['username'])) { //Si no esta definido $_SESSIION[username] 

    header("Location: ../Login/login.php");
    exit;
} else {
    $rol_id = $_SESSION['rol_id'];
    if (!$rol_id == 1) {
        //Si no sos admin te llevo al login    
        header("Location: ../Login/login.php");
        exit;
    }
}
 
// Obtiene el ID del usuario actual desde la sesión 
$id = $_SESSION['id'];


?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Administrador</title>
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
                <a href="cerrar_session.php" class="btn btn-danger">Cerrar Sesión</a>

            </div>
        </div>
    </nav>
    <div class="container">
        <h2 class="my-4">Bienvenido, <?php echo $_SESSION['username']; ?></h2>
        <div class="container text-left">
            <div class="row">
                <div class=" col-sm-12 col-md-4">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                            Principal
                        </a>
                        <a href="noticias_admin.php" class="list-group-item list-group-item-action">Noticias</a>
                        <a href="usuarios_admin.php" class="list-group-item list-group-item-action">Usuarios</a>
                        <a href="roles_admin.php" class="list-group-item list-group-item-action">Roles</a>
                        <a href="categorias_admin.php" class="list-group-item list-group-item-action">Categorias</a>
                    </div>
                </div>
                <div class="col">
                </div>

            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>