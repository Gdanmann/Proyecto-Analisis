<!DOCTYPE html>
<html>
<head>
    <title>Agregar Aumento de Salario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Agregar Aumento de Salario</h2>
    <form method="post" action="agregaraumento.php">
        <div class="form-group">
            <label for="fk_empleado_id">Código de Empleado:</label>
            <input type="number" class="form-control" name="fk_empleado_id" required>
        </div>
        <div class="form-group">
            <label for="fecha_aumento">Fecha de Aumento:</label>
            <input type="date" class="form-control" name="fecha_aumento" required>
        </div>
        <div class="form-group">
            <label for="nuevo_salario">Nuevo Salario:</label>
            <input type="number" step="0.01" class="form-control" name="nuevo_salario" required>
        </div>
        <button type="submit" class="btn btn-success">Agregar Aumento de Salario</button>
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
        $fecha_aumento = $_POST["fecha_aumento"];
        $nuevo_salario = $_POST["nuevo_salario"];

        if (empty($fk_empleado_id) || empty($fecha_aumento) || empty($nuevo_salario)) {
            echo "Por favor, complete todos los campos del formulario.";
            exit;
        }

        $alterHistorialAumentos = "ALTER TABLE HistorialAumentos MODIFY COLUMN historia_id INT AUTO_INCREMENT";

            if ($conn->query($alterHistorialAumentos) !== TRUE) {
                echo "Error al modificar la tabla usuarios: " . $conn->error;
            }

        // Luego, inserta los valores en la base de datos (ajustar la consulta)
        $sql = "INSERT INTO HistorialAumentos (fk_empleado_id, fecha_aumento, nuevo_salario) 
                VALUES ('$fk_empleado_id', '$fecha_aumento', '$nuevo_salario')";

        if ($conn->query($sql) === TRUE) {
            $UpdateSalario = "UPDATE Empleados SET salario_base = $nuevo_salario WHERE empleado_id = $fk_empleado_id";
            if($conn->query($UpdateSalario) === TRUE){
                echo '<script>alert("Se actualizo su nuevo salario."); window.location.href = "http://solidarista.infinityfreeapp.com/historialaumento.php";</script>';
            }
        } else {
            echo "Error al agregar el aumento de salario: " . $conn->error;
        }
    }
}
?>
