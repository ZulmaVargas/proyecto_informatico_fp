<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body class="d-flex align-items-center justify-content-center" style="height: 100vh; background-color: #f8f9fa; margin: 100;">
    <div class="card mt-5 mx-auto" style="background-color: #d4edda; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <h3 class="text-center">Registrar nuevo usuario</h3>

        <form method="POST" action="registrar.php">
            <input type="hidden" name="roles" value="3">
            <div class="mb-3">
                <label for="username" class="form-label">Usuario</label>
                <input type="text" class="form-control" id="username" name="username" required>
                <div id="usernameHelp" class="form-text">Ingrese su nombre.</div>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo electronico</label>
                <input type="email" class="form-control" id="email" name="email" required>
                <div id="emailHelp" class="form-text">Ingrese su correo electronico</div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <div id="passwordHelp" class="form-text">Ingrese una contraseña.</div>
            </div>
            <!--<div class="mb-3">
            <label for="roles">Selecciona un rol:</label>
                <select id="roles" name="roles">
                    <option value="1">Administrador</option>
                    <option value="2">Editor</option>
                    <option value="3">Usuario</option>
                </select>
            </div>-->
            <button type="submit" class="btn btn-primary">Registrar nuevo usuario</button>
        </form>
      
    </div>
</body>
</html>