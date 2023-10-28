<!DOCTYPE html>
<html>
<head>
    <title>solidarista</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
    header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #AED0EF; /* Cambia el color de fondo según tus preferencias */
        padding: 10px 20px;
    }

    .logo_solidarista {
        weight: 40px;
        height: 40px;
    }
    </style>
    
</head>
<body>

<header>
    <img src="imagen/logo.png" class="logo_solidarista">
</header>

<div class="container">
    <h2>Agregar Empleado</h2>
    <form method="post" action="agregar_empleado.php">
        <div class="form-group">
            <label for="nombre">Codigo empleado:</label>
            <input type="number" class="form-control" name="cod" required>
        </div>
        <div class="form-group">
            <label for "nombre">Nombre:</label>
            <input type="text" class="form-control" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="salario">Salario Base:</label>
            <input type="text" class="form-control" name="salario" required>
        </div>
        <div class="form-group">
            <label for="departamento">Departamento:</label>
            <input type="text" class="form-control" name="departamento" required>
        </div>
        <div class="form-group">
            <label for="foto">Enlace a la Foto del Empleado:</label>
            <input type="text" class="form-control" name="foto" required>
        </div>
        <div class="form-group">
            <label for="correo">Correo:</label>
            <input type="email" class="form-control" name="correo" required>
        </div>
        <div class="form-group">
            <label for="contrasena">Contraseña:</label>
            <input type="password" class="form-control" name="contrasena" required>
        </div>
        <div class="form-group">
            <label for="esposo_esposa">Esposo/Esposa:</label>
            <input type="text" class="form-control" name="esposo_esposa">
        </div>
        <button type="submit" class="btn btn-success">Agregar Empleado</button>
    
    </form>
</div>
</body>
</html>

<?php
// Incluye el archivo de conexión a la base de datos
include('conexion.php');

if ($conn) {
    // Verifica si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupera y verifica los valores de los campos del formulario
        $cod = $_POST["cod"];
        $nombre = $_POST["nombre"];
        $salario = $_POST["salario"];
        $departamento = $_POST["departamento"];
        $foto = $_POST["foto"];
        $correo = $_POST["correo"];
        $contrasena = $_POST["contrasena"];
        $esposo_esposa = $_POST["esposo_esposa"];

        // Verifica que los campos obligatorios no estén vacíos
        if (empty($nombre) || empty($cod) || empty($salario) || empty($departamento) || empty($foto) || empty($correo) || empty($contrasena)) {
            echo "Todos los campos obligatorios deben estar llenos. <a href='agregar_empleado.php'>Volver al formulario</a>";
        } else {
            // Consulta SQL para agregar un nuevo empleado
            $sql = "INSERT INTO Empleados (empleado_id, nombre, salario_base, departamento, foto, correo, contrasena, esposa_esposo_nombre) 
                    VALUES ('$cod', '$nombre', '$salario', '$departamento', '$foto', '$correo', '$contrasena', '$esposo_esposa')";

                    if ($conn->query($sql) === TRUE) {
                         echo '<script>alert("Empleado agregado exitosamente."); window.location.href = "http://solidarista.infinityfreeapp.com/empleado.php";</script>';
                        } else {
                            echo "Error al agregar empleado: " . $conn->error;
                        }



        }
    }
}
?>
