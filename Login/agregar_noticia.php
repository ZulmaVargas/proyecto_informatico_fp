<?php
// Incluir el archivo de conexión a la base de datos
include '../conexion.php';

// Ejecutar una consulta SQL para obtener todas las categorías
$sql = "SELECT * FROM categorias";
$result = $conn->query($sql); // Ejecutar la consulta
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Incluir Bootstrap para el diseño de la página -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registro de noticia</title>
</head>

<body>
    <div>
        <div class="container">
            <!-- Título del formulario -->
            <h2 class="my-4">Registro de noticia</h2>
            <form method="POST" action="registrar_noticia.php">
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" required>
                    <div id="tituloHelp" class="form-text">Ingrese un Título.</div>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Imagen</label>
                    <input type="text" class="form-control" id="imagen" name="imagen" required>
                    <div id="imagenHelp" class="form-text">Ingrese link de la imagen.</div>
                </div>
                <div class="mb-3">
                    
                    <label for="floatingTextarea" class = "form-label">Descripción</label>
                    <textarea name="descripcion" id="descripcion" class="form-control" rows="5" required></textarea>
                    <div id="descripcionHelp" class="form-text">Ingrese la descripción de la noticia.</div>

                </div>
                
                
                <div class = "mb-3">
                    <label for="categoria" class="form-label">Categoria</label>
                    <select id="categoria" name="categoria" class="form-select" aria-label="Default select example">
                        <?php
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                // Mostrar cada categoría como una opción en el menú
                                echo "<option value={$row['id']}>{$row['nombre']}</option>";
                            }
                        }
                        ?>

                    </select>
                    <div id="categoriaHelp" class="form-text">Seleccione la categoria correspondiente.</div>
                </div>
                <!-- Botón para enviar el formulario -->
                <button type="submit" class="btn mt-5 btn-primary">Registrar Noticia</button>
            </form>
        </div>
    </div>

</body>

</html>

<?php
// Cerrar la conexión a la base de datos
$conn->close();
?>