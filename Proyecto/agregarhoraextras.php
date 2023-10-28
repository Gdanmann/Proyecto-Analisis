<!DOCTYPE html>
<html>
<head>
    <title>Solidarista</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Registro de Horas Trabajadas</h2>
    <form method="post" action="agregarhoraextras.php">
        <div class="form-group">
            <label for="fk_empleado_id">Código de Empleado:</label>
            <input type="number" class="form-control" name="fk_empleado_id" required>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha:</label>
            <input type="date" class="form-control" name="fecha" required>
        </div>
        <div class="form-group">
            <label for="horas_trabajadas">Horas Trabajadas:</label>
            <input type="number" step="0.01" class="form-control" name="horas_trabajadas" required>
        </div>
        <button type="submit" class="btn btn-success">Registrar Horas</button>
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
        $fk_empleado_id = $_POST["fk_empleado_id"];
        $fecha = $_POST["fecha"];
        $horas_trabajadas = $_POST["horas_trabajadas"];

        if (empty($fk_empleado_id) || empty($fecha) || empty($horas_trabajadas)) {
            echo "Por favor, complete todos los campos del formulario.";
            exit;
        }

        $alterHorasExtras = "ALTER TABLE HorasExtras MODIFY COLUMN horas_id INT AUTO_INCREMENT";

            if ($conn->query($alterHorasExtras) !== TRUE) {
                echo "Error al modificar la tabla usuarios: " . $conn->error;
            }

        // Luego, inserta los valores en la base de datos (ajustar la consulta)
        $sql = "INSERT INTO HorasExtras (fk_empleado_id, fecha, horas_trabajadas) 
                VALUES ('$fk_empleado_id', '$fecha', '$horas_trabajadas')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Horas trabajas registradas con éxito."); window.location.href = "http://solidarista.infinityfreeapp.com/horaextras.php";</script>';
        } else {
            echo "Error al registrar las horas trabajadas: " . $conn->error;
        }
    }
}
?>
