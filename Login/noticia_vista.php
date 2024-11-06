<?php

// Incluir el archivo de conexión a la base de datos
include '../conexion.php';

// Inicia la sesión
session_start(); 

// Obtiene el ID de la noticia selecionada
$id = $_GET['id'];

// Consulta SQL para seleccionar datos de la tabla noticias del id seleccionado 
$sql = "SELECT * FROM noticias WHERE id=$id";

// Ejecuta la consulta SQL en la BBDD y guarda el resultado en la variable $result
$result = $conn->query($sql);

 // Aquí puedes acceder a $noticia['id'],$noticia['titulo'], $noticia['imagen_link'], etc.
$noticia = $result->fetch_assoc();

// Consulta SQL para seleccionar datos de la tabla comentarios del id de  noticia selecionada. 
$sql2 = "SELECT * from comentarios INNER JOIN usuarios ON usuario_id = usuarios.id  WHERE noticia_id=$id ";
// Devuelve su ID, contenido, el id de la noticia asociada, el nombre del usuario que lo realizo..


// Ejecuta la consulta SQL en la BBDD y guarda el resultado en la variable $result_cometarios
$result_comentarios = $conn->query($sql2);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Noticia vista</title>
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
                    <form method="POST" action="welcome.php" class="d-flex">
                    <input name="search" class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                    <button class="btn btn-success me-2" type="submit">Buscar</button>
                </form>
                <a  href="cerrar_session.php" class="btn btn-danger m-2">Cerrar Sesión</a>

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
                <a href="login.php" class="btn btn-outline-primary m-2">Login</a>
                <a href="registrar_usuario.php" class="btn btn-outline-primary m-2">Register</a>


            </div>
        </div>
    </nav>
    '
    ?>

    <main>
        <div class="container mt-5">
            <h1><?php

                echo
                $noticia['titulo'];
                ?></h1>
            <img class="w-50" src=<?php echo $noticia['imagen_link'] ?> alt="imagen noticia" />
            <p>
                <?php
                echo $noticia['texto']
                ?>
            </p>

        

            <?php
            if ($result_comentarios->num_rows == 0) {
                echo "No hay comentarios";
            } else {
                while ($comentario = $result_comentarios->fetch_assoc()) {
                    echo "
                    <div class=\"container\">
                    <br />
                    <p> Usuario : " . $comentario['nombre'] . "</p>
                    <p> Comentario : " . $comentario['contenido'] . "</p>
                    </div>
                    ";
                }
            }
            ?>

        </div>
        <?php

        if ($_SESSION && $_SESSION['username'])
            echo '
          <div class="m-5">
            <form method="POST" action="registrar_comentario.php">
               <input type="hidden" id="id" name="noticia_id" value=' . $id . '>
                <div class="form-group container">
                    <label for="exampleFormControlTextarea1">Comenta : </label>
                    <textarea class="mb-2 form-control" name="contenido" id="exampleFormControlTextarea1" rows="3"></textarea>
                                  <button type="submit" class="btn btn-primary mb-2">Enviar Comentario</button>

                    </div>

            </form>
        </div>'
        ?>

    </main>



</body>



</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>