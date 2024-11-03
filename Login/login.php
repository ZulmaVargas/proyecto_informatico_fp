<?php
include '../conexion.php';  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Iniciar session</title>
</head>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <title>Iniciar Sesión</title>
<body>
    <div class="d-flex align-items-center justify-content-center" style=" background-color: #f8f9fa; margin: 10;" >
        <div class="card mt-5 mx-auto" style="background-color: #d4edda; padding: 20px; border-radius: 8px;">
            <h3 class="text-center">Bienvenido</h3>
            <form method="POST" action="login.php" class="mx-auto" >
                <div class="mb-3">
                    <label for="username" class="form-label">Usuario</label>
                    <input type="text" class="form-control" id="username" name="username" required aria-describedby="usernameHelp">
                    <div id="usernameHelp" class="form-text">Ingrese su nombre de usuario.</div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required aria-describedby="passwordHelp">
                    <div id="passwordHelp" class="form-text">Ingrese contraseña.</div>
                </div>
                <div class="d-flex justify-content-center p-2">
                    <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                </div>
                
            </form>
        </div>
    </div>
</body>
</html>

<?php
    session_start();
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM usuarios WHERE nombre = '$username'";
        $result = $conn->query($sql);

        //Verifico que me este trayendo un usuario
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['contraseña'])) {
                //Estoy asignando un usuario a la sesión
                $_SESSION['username'] = $username; //asigna el  nombre del usuario
                $_SESSION['id'] = $user['id']; // asigna el id del usuario
                $_SESSION['rol_id'] = $user["rol_id"]; // asigna el rol_id del usuario en la session
                $rol_id = $user["rol_id"];  //variable para controlar el rol_id
               
                if ($rol_id == 1) {
                    //Es administrador.     
                    header("Location: ../Administrador/dashboard_administrador.php");
                    exit;
                }
                    if($rol_id == 2){
                        //Es editor  
                        header("Location: ../editor/dashboard_editor.php");
                        exit;
                    }
                    else{
                    header("Location: bienvenido.php");
                    }
                
            } 
            else {
                echo "<div class='alert alert-danger mt-3'>Contraseña incorrecta</div>";
            }
        } 
        else {
            echo "<div class='alert alert-danger mt-3'>Usuario no encontrado</div>";
        }
    }
    
 
?>