<!DOCTYPE html>
<html>
<head>
    <title>Solidarista</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Formulario de Bonificaciones de Producción</h2>
        <form action="agregarbonificacion.php" method="POST">
            <div class="form-group">
                <label for="fk_empleado_id">ID del Empleado:</label>
                <input type="text" class="form-control" id="fk_empleado_id" name="fk_empleado_id" required>
            </div>
            <div class="form-group">
                <label for="piezas_elaboradas">Piezas Elaboradas:</label>
                <input type="text" class="form-control" id="piezas_elaboradas" name="piezas_elaboradas" required>
            </div>
            <div class="form-group">
                <label for="bonificacion">Bonificación:</label>
                <input type="text" class="form-control" id="bonificacion" name="bonificacion" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Bonificación</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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
        $piezas_elaboradas = $_POST["piezas_elaboradas"];
        $bonificacion = $_POST["bonificacion"];

        if (empty($fk_empleado_id) || empty($piezas_elaboradas) || empty($bonificacion)) {
            echo "Por favor, complete todos los campos del formulario.";
            exit;
        }

        $alterBonificacion = "ALTER TABLE BonificacionesProduccion MODIFY COLUMN bonificacion_id INT AUTO_INCREMENT";

            if ($conn->query($alterBonificacion) !== TRUE) {
                echo "Error al modificar la tabla usuarios: " . $conn->error;
            }

        // Inserta los valores en la base de datos (ajustar la consulta)
        $sql = "INSERT INTO BonificacionesProduccion (fk_empleado_id, piezas_elaboradas, bonificacion) 
                VALUES ('$fk_empleado_id', '$piezas_elaboradas', '$bonificacion')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("La información se guardo correctamente."); window.location.href = "http://solidarista.infinityfreeapp.com/bonificacion.php";</script>';
        } else {
            echo "Error al agregar la bonificación de producción: " . $conn->error;
        }
    }
}
?>
