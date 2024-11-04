<?php
include '../conexion.php';
session_start();
if (!isset($_SESSION['username'])) {

    header("Location: ../login.php");
    exit;
} else {
    $rol_id = $_SESSION['rol_id'];
    if (!$rol_id == 1) {
        //Si no sos admin te llevo al login    
        header("Location: ../Login/login.php");
        exit;
    }
}
$id = $_SESSION['id'];

// Consulta SQL para seleccionar datos de la tabla noticias , usuarios y categorias. 
$sql = "SELECT noticias.id, noticias.titulo,usuarios.nombre AS autor_nombre, categorias.nombre AS categoria_nombre 
FROM noticias
INNER JOIN usuarios ON noticias.autor_id = usuarios.id INNER JOIN categorias ON noticias.categoria_id = categorias.id" ; 
// La consulta selecciona todos las noticias.
// y devuelve su ID, título, el nombre del usuario que la realizo, y el nombre de la categoria asociada.

// Ejecuta la consulta SQL en la base de datos y guarda el resultado en la variable $result
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Noticias administrador</title>
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
                        <a href="dashboard_administrador.php" class="list-group-item list-group-item-action ">
                            Principal
                        </a>
                        <a href="#" class="list-group-item list-group-item-action active" aria-current="true">Noticias</a>
                        <a href="#" class="list-group-item list-group-item-action">Usuarios</a>
                        <a href="#" class="list-group-item list-group-item-action">Roles</a>
                        <a class="list-group-item list-group-item-action disabled" aria-disabled="true">Categorias</a>
                    </div>
                </div>
                <div class="col">
                </div>

            </div>
        </div>
        <?php
        if ($result->num_rows == 0) {
            echo '<h6>No hay noticias para mostrar</h6>';
        } else {
            echo '
                <table class= "table mt-5">
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">TÍTULO</th>
                            <th scope="col">AUTOR</th>
                            <th scope="col">CATEGORÍA</th>
                            <th scope="col">ELIMINAR</th>
                            </tr>
                        </thead>
                        <tbody>
                        ';
            while ($noticia = $result->fetch_assoc()) {
                // Aquí puedes acceder a $noticia['id'],$noticia['titulo'], $noticia['autor_nombre'],$noticia['categoria_nombre']  
                echo "
                <tr>
                        <th >{$noticia['id']}</th>
                        <td>{$noticia['titulo']}</td>
                        <td>{$noticia['autor_nombre']}</td>
                        <td>{$noticia['categoria_nombre']}</td>
                        <td>
                            <a href=\"eliminar_noticia.php?id={$noticia['id']}\">
                            <i class=\"fa fa-trash\" aria-hidden=\"true\"></i>
                            </a>


                        </td>
                </tr>
                ";
            }

            echo '</tbody></table>';
        }
        ?>
        <a href="agregar_noticia.php" class="btn btn-primary" role="button" aria-disabled="true">Agregar Noticia</a>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>