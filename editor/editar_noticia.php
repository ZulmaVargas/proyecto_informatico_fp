<?php
// Incluir el archivo de conexión a la base de datos
include '../conexion.php';

// Inicia la sesión
session_start(); 

// Obtiene el ID de la noticia selecionada
$id = $_GET['id'];

// Consulta SQL para seleccionar datos de la tabla noticias , usuarios y categorias. 
$sql = "SELECT noticias.id, noticias.titulo, noticias.texto, noticias.imagen_link, noticias.categoria_id, usuarios.nombre AS autor_nombre, categorias.nombre AS categoria_nombre 
FROM noticias
INNER JOIN usuarios ON noticias.autor_id = usuarios.id INNER JOIN categorias ON noticias.categoria_id = categorias.id
WHERE noticias.id = $id" ; // id de la noticia seleccionada 
// La consulta selecciona todos las noticias.
// y devuelve su ID, título, descripción, imagen, el nombre del usuario que la realizo, y el nombre de la categoria asociada.

// Ejecuta la consulta SQL en la BBDD y guarda el resultado en la variable $result
$result = $conn->query($sql);


// Verifica si se encontraron resultados
if ($result->num_rows > 0) {
    // Obtiene la siguiente fila de resultados como un array asociativo


$noticia = $result->fetch_assoc();
//echo $noticia['texto']; 
    // Aquí puedes acceder a $noticia['id'], $noticia['titulo'],$noticia['texto'],$noticia['imagen_lik'],$noticia['autor_nombre'] y  $noticia['categoria_nombre'] etc.
} else {
    echo "No se encontraron noticias."; // Mensaje para indicar que no hay resultados
    exit; // Detiene la ejecución si no hay usuarios
}

// Ejecutar una consulta SQL para obtener todas las categorías
$sql2 = "SELECT * FROM categorias";
$result2 = $conn->query($sql2); // Ejecutar la consulta

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Incluir Bootstrap para el diseño de la página -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar noticia</title>
</head>

<body>
    <div>
        <div class="container">
            <!-- Título del formulario -->
            <h2 class="my-4">Editar noticia</h2>
            <h6 class="my-4">Autor :  <?php echo $noticia['autor_nombre']; ?> </h6>
            <form method="POST" action="proceso_editar_noticia.php">
                <input type="hidden" name="id" value="<?php echo $id ;?>">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título : </label>
                    <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $noticia['titulo']; ?>"  required>
            
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Imagen : </label>
                    <input type="text" class="form-control" id="imagen" name="imagen" value="<?php echo $noticia['imagen_link']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class = "form-label">Descripción : </label>
                    <textarea name="descripcion" id="descripcion" class="form-control" rows="5" required><?php echo $noticia['texto']; ?> </textarea>
                </div>
                <!--no se ve en el formulario  las cetegorias-->
                <div class = "mb-3">
                    <label for="categoria" class="form-label">Categoría: </label>
                    <select id="categoria" name="categoria" class="form-select" aria-label="Default select example">
                        <?php
                        if ($result2->num_rows > 0) {
                            while ($row = $result2->fetch_assoc()) {
  
                                if ($row['id'] == $noticia['categoria_id']) {
                                    echo "<option value={$row['id']} selected>{$row['nombre']}</option>";
                                } else {
                                    echo "<option value={$row['id']}>{$row['nombre']}</option>";
                                }    
                            }
                        }
                        ?>
                    </select>
                </div>

                <!-- Botón para enviar el formulario -->
                <button type="submit" class="btn mt-5 btn-primary">Guardar cambios</button>
            </form>
        </div>
    </div>

</body>

</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>