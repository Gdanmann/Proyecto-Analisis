<!DOCTYPE html>
<html>
<head>
    <title>Solidarista</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Formulario de Préstamo</h2>
        <form method="post" action="agregarprestamos.php">
            <div class="form-group">
                <label for="fk_empleado_id">Código de Empleado:</label>
                <input type="number" class="form-control" name="fk_empleado_id" required>
            </div>
            <div class="form-group">
                <label for="monto_prestamo">Monto del Préstamo:</label>
                <input type="number" step="0.01" class="form-control" name="monto_prestamo" required>
            </div>
            <div class="form-group">
                <label for="plazo_meses">Plazo en Meses:</label>
                <input type="number" class="form-control" name="plazo_meses" required>
            </div>
            <div class="form-group">
                <label for="saldo_pendiente">Saldo Pendiente:</label>
                <input type="number" step="0.01" class="form-control" name="saldo_pendiente" required>
            </div>
            <button type="submit" class="btn btn-success">Agregar Préstamo</button>
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
        $monto_prestamo = $_POST["monto_prestamo"];
        $plazo_meses = $_POST["plazo_meses"];
        $saldo_pendiente = $_POST["saldo_pendiente"];

        if (empty($fk_empleado_id) || empty($monto_prestamo) || empty($plazo_meses) || empty($saldo_pendiente)) {
            echo "Por favor, complete todos los campos del formulario.";
            exit;
        }

        $alterPrestamos = "ALTER TABLE Prestamos MODIFY COLUMN prestamo_id INT AUTO_INCREMENT";

            if ($conn->query($alterPrestamos) !== TRUE) {
                echo "Error al modificar la tabla usuarios: " . $conn->error;
            }

        // Consulta SQL para insertar el préstamo en la base de datos
        $sql = "INSERT INTO Prestamos (fk_empleado_id, monto_prestamo, plazo_meses, saldo_pendiente) 
                VALUES ('$fk_empleado_id', '$monto_prestamo', '$plazo_meses', '$saldo_pendiente')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("La información del prestamo se actualizo."); window.location.href = "http://solidarista.infinityfreeapp.com/prestamos.php";</script>';
        } else {
            echo "Error al agregar el préstamo: " . $conn->error;
        }
    }
}
?>
