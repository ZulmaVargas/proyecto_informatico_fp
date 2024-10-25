<?php
// Incluir archivo de conexión a la base de datos
include '../conexion.php';

// Iniciar la sesión
session_start();

// Verificar si el usuario ha iniciado sesión, si no, redirigir al login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Obtener el ID del usuario de la sesión
$id = $_SESSION['id'];

// Consulta para obtener todas las noticias donde el autor sea el usuario actual
$sql = "SELECT * FROM noticias WHERE autor_id = '$id'";
$result = $conn->query($sql); // Ejecutar la consulta

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Incluir archivo de Bootstrap para estilos -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Dashboard</title>
    <!-- Incluir iconos de Font Awesome para los botones de edición/eliminación -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Incluir Bootstrap de CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- Barra de navegación del Dashboard -->
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
        <?php
        if ($result->num_rows == 0) {
            // Mostrar mensaje si no hay noticias
            echo '<h6>No hay noticias para mostrar</h6>';
        } else {
            // Tabla que contiene las noticias del autor
            echo '
                <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Titulo</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Editar</th>
                            </tr>
                        </thead>
                        <tbody>
                        ';
            // Recorrer todas las noticias y mostrarlas en la tabla          
            while ($noticia = $result->fetch_assoc()) {
                echo "
                <tr>
                        <th >{$noticia['id']}</th>
                        <td>{$noticia['titulo']}</td>
                        <td>{$noticia['categoria_id']}</td>
                        <td>
                            <a href=\"eliminar_noticia.php?id={$noticia['id']}\">
                            <i class=\"fa fa-trash\" aria-hidden=\"true\"></i>
                            </a>


                        </td>
                </tr>
                ";
            }
            // Cerrar la tabla
            echo '</tbody></table>';
        }
        ?>
        <!-- Botón para agregar una nueva noticia -->
        <a href="agregar_noticia.php" class="btn btn-primary" role="button" aria-disabled="true">Agregar Noticia</a>


    </div>
    <!-- Incluir JavaScript de Bootstrap para funcionalidades dinámicas -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>