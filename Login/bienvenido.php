<?php
// Incluir el archivo de conexión a la base de datos
include '../conexion.php';

// Iniciar la sesión
session_start();

$sql = "SELECT titulo,nombre,texto,imagen_link,noticias.id FROM `noticias` INNER JOIN categorias ON noticias.categoria_id = categorias.id";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $search = $_POST['search'];
    //convierto lo que leo en minusculas
    $search = strtolower($search);
    //$sql = "SELECT * FROM noticias WHERE LOWER(titulo) LIKE '%$search%' ";SELECT * FROM noticias LEFT JOIN categorias ON noticias.categoria_id = categorias.id  WHERE LOWER(titulo) LIKE '%$search% 
    $sql = " SELECT * FROM noticias INNER JOIN categorias ON noticias.categoria_id = categorias.id
     WHERE LOWER(noticias.titulo) LIKE '%$search%' 
     OR 
        LOWER(categorias.nombre) LIKE '%$search%'
      ";
}
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Incluir archivo de Bootstrap para estilos -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Bienvenido</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Incluir Bootstrap de CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php
    if ($_SESSION)
        echo '
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

                <form method="POST" action="bienvenido.php" class="d-flex">
                    <input name="search" class="form-control me-2" type="search" placeholder="Buscar noticia" aria-label="Search">
                    <button class="btn btn-success me-2" type="submit">Buscar</button>
                </form>
                <a href=".cerrar_sessionphp" class="btn btn-danger">Cerrar Sesión</a>

            </div>
            </div>
         </nav>';
    else
        echo '
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
                    <a href="login.php" class="btn btn-primary m-2">Iniciar Session</a>
                    <a href="registrar_usuario.php" class="btn btn-primary m-2">Registrarse</a>


                </div>
            </div>
        </nav>'
    ?>
    <div class="container">
        <h1>Welcome Page </h1>
        <div class="row p-5">
            <?php
            if ($result->num_rows == 0) {
                echo '<h6>No hay noticias para mostrar</h6>';
            } else {
                while ($noticia = $result->fetch_assoc()) {
                    echo "
                    <div class=\"col-sm-12 col-md-4 p-4\">
                        <div class=\"card\" style=\"width: 18rem;\">
                            <img src=\"{$noticia['imagen_link']}\" class=\"card-img-top\" alt=\"...\">
                                            <div class=\"card-body\">
                                                <h5 class=\"card-title\">{$noticia['titulo']}</h5>
                                                <p class=\"card-text\">{$noticia['texto']}</p>
                                                <a href=\"noticia_vista.php?id={$noticia['id']}\" class=\"btn btn-primary\">Leer más...</a>
                                            </div>
                        </div>
                    </div>
                    ";
                }
            }
            ?>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>