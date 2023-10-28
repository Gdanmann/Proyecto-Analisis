<!DOCTYPE html>
<html>
<head>
    <title>Solidarista</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Formulario de Comisiones de Ventas</h2>
        <form action="agregarcomisiones.php" method="POST">
            <div class="form-group">
                <label for="fk_empleado_id">Empleado ID:</label>
                <input type="text" class="form-control" name="fk_empleado_id" id="fk_empleado_id" required>
            </div>
            <div class="form-group">
                <label for="ventas">Ventas:</label>
                <input type="text" class="form-control" name="ventas" id="ventas" required>
            </div>
            <div class="form-group">
                <label for="comision">Comisión:</label>
                <input type="text" class="form-control" name="comision" id="comision" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Comisión</button>
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
        $ventas = $_POST["ventas"];
        $comision = $_POST["comision"];

        if (empty($fk_empleado_id) || empty($ventas) || empty($comision)) {
            echo "Por favor, complete todos los campos del formulario.";
            exit;
        }

        $alterComisionesVentas = "ALTER TABLE ComisionesVentas MODIFY COLUMN comision_id INT AUTO_INCREMENT";

            if ($conn->query($alterComisionesVentas) !== TRUE) {
                echo "Error al modificar la tabla usuarios: " . $conn->error;
            }

        // Luego, inserta los valores en la base de datos
        $sql = "INSERT INTO ComisionesVentas (fk_empleado_id, ventas, comision) 
                VALUES ('$fk_empleado_id', '$ventas', '$comision')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("La comisión de ventas se registró con éxito."); window.location.href = "http://solidarista.infinityfreeapp.com/comisiones.php";</script>';
        } else {
            echo "Error al registrar la comisión de ventas: " . $conn->error;
        }
    }
}
?>
