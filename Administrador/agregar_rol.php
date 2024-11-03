<?php
include '../conexion.php';

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Agregar Rol</title>
</head>

<body>
    <div>
        <div class="container">
            <h2 class="my-4">Agregar Rol</h2>
            <form method="POST" action="registrar_rol.php">
                <div class="mb-3">
                    <label for="title" class="form-label">Rol</label>
                    <input type="text" class="form-control" id="rol" name="rol" required>
                </div>



                <button type="submit" class="btn mt-5 btn-primary">Agregar Rol</button>
            </form>
        </div>
    </div>

</body>

</html>

<?php
$conn->close();
?>