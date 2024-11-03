<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Agregar categoria</title>
</head>

<body>
    <div>
        <div class="container">
            <h2 class="my-4">Agregar categoria </h2>
            <form method="POST" action="registrar_categoria.php">
                <div class="mb-3">
                    <label for="title" class="form-label">Categoria</label>
                    <input type="text" class="form-control" id="categoria" name="categoria" required>
                </div>



                <button type="submit" class="btn mt-5 btn-primary">Agregar catergoria</button>
            </form>
        </div>
    </div>

</body>

</html>
