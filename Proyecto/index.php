<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        body {
            background-color: #FFFFFF;
        }

        .login-btn {
            background-color: #2971FD;
            color: #FFFFFF;
            width: 330px;
            height: 55px;
            border-radius: 10px;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #AED0EF;
            padding: 10px 20px;
        }

        .logo img {
            max-height: 80px;
        }
    </style>
</head>



<body>
    <header>
        <div class="logo">
            <img src="imagen/logo.png" alt="Logo">
        </div>
    </header>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center"><h4>Iniciar sesión</h4></div>
                    <div class="container">
                    <form method="post" action="index.php">
                            <div class="form-group">
                                <label for="correo">Correo:</label>
                                <input type="text" class="form-control" name="correo_electronico" required>
                            </div>
                            <div class="form-group">
                                <label for="contrasena">Contraseña:</label>
                                <input type="password" class="form-control" name="contrasena" required>
                            </div>
                            <button type="submit" name="login_btn" class="btn login-btn">Iniciar Sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


<?php
// Incluye el archivo de conexión
include('conexion.php');



// Iniciar la sesión
session_start();






// Verifica si la conexión está establecida
if ($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $correo_electronico = $_POST["correo_electronico"];
        $contrasena = $_POST["contrasena"];
        
        if(isset($_POST['login_btn'])){

            if (!filter_var($correo_electronico, FILTER_VALIDATE_EMAIL)) {
                echo '<div class="alert alert-warning" role="alert" style="position: absolute; left: 20px; right: 20px;">
                Por favor, introduce una dirección de correo electrónico válida.
                </div>';
                exit();
            }else{
                $password_length = strlen($contrasena);
                if ($password_length < 8 || $password_length > 16) {
                    echo '<div class="alert alert-warning" role="alert" style="position: absolute; left: 20px; right: 20px;">
                    La contraseña debe tener entre 8 y 16 caracteres.
                </div>';
                    exit();
                }else{

                    $sql = "SELECT * FROM Empleados WHERE correo = '$correo_electronico' AND contrasena = '$contrasena'";
                    $result = mysqli_query($conn, $sql);
            
                    if ($result) {
                        if (mysqli_num_rows($result) == 1) {
                            // Login successful
                            header("Location: principal.php");
                            exit();
                        } else {
                            echo '<div class="alert alert-warning" role="alert" style="position: absolute; left: 20px; right: 20px;">
                            Correo electrónico o contraseña no válidos. Inténtalo de nuevo.
                </div>';
                        }
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                }
            }
        }
    }

} else {
    echo "No se pudo establecer conexión a la base de datos.";
}


// Destruir la sesión
session_destroy();



// Deshabilitar el almacenamiento en caché
header('Cache-Control: no-store');



?>


