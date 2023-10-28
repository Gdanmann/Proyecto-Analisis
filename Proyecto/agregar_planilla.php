<!DOCTYPE html>
<html>
<head>
    <title>Agregar Planilla</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2>Agregar Planilla</h2>
    <form method="post" action="agregar_planilla.php">
        <div class="form-group">
            <label for="fk_empleado_id">Código de Empleado:</label>
            <input type="number" class="form-control" name="fk_empleado_id" id="fk_empleado_id" required>
        </div>
        <div class="form-group">
            <label for="salario">Salario del Empleado:</label>
            <input type="number" step="0.01" class="form-control" name="salario" id="salario" required>
        </div>
        <div class="form-group">
            <label for="tipo_planilla">Tipo de Planilla:</label>
            <select class="form-control" name="tipo_planilla" id="tipo_planilla" required>
                <option value="IGSS">IGSS</option>
                <option value="IRTRA">IRTRA</option>
                <option value="ISR">ISR</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fecha_planilla">Fecha de Planilla:</label>
            <input type="date" class="form-control" name="fecha_planilla" required>
        </div>
        <div class="form-group">
            <label for="monto_debitado">Monto Debitado:</label>
            <input type="number" step="0.01" class="form-control" name="monto_debitado" id="monto_debitado" required>
        </div>
        <button type="submit" class="btn btn-success">Agregar Planilla</button>
    </form>
</div>
<script>

    function calcularMontoTotal() {
        var salario = parseFloat(document.getElementById("salario").value);
        var tipoPlanilla = document.getElementById("tipo_planilla").value;
        var montoTotal = 0;

        if (tipoPlanilla === "IGSS") {

            montoTotal = salario * 0.0483;

        } else if (tipoPlanilla === "IRTRA") {

            montoTotal = salario * 0.01;
            
        } else if (tipoPlanilla === "ISR") {

            if (salario <= 30000) {
                montoTotal = salario * 0.05;
            } else {
                montoTotal = salario * 0.07;
            }
        }

        document.getElementById("monto_debitado").value = montoTotal.toFixed(2);
    }

    document.getElementById("salario").addEventListener("input", calcularMontoTotal);
    document.getElementById("tipo_planilla").addEventListener("change", calcularMontoTotal);

    calcularMontoTotal();
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqFjcJ6pajs/rfdfs3SO+kD5tr5P6n5F5f5p4p6b2C6z6I" crossorigin="anonymous"></script>
</body>
</html>

<?php

include('conexion.php');

if ($conn) {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $fk_empleado_id = $_POST["fk_empleado_id"];
        $tipo_planilla = $_POST["tipo_planilla"];
        $fecha_planilla = $_POST["fecha_planilla"];
        $monto_debitado = $_POST["monto_debitado"];

        if (empty($fk_empleado_id) || empty($tipo_planilla) || empty($fecha_planilla) || empty($monto_debitado)) {
            echo "Por favor, complete todos los campos del formulario.";
            exit;
        }

        if (!is_numeric($monto_debitado)) {
            echo "El monto total debe ser un valor numérico.";
            exit;
        }

         $alterPlanilla = "ALTER TABLE Planillas MODIFY COLUMN planilla_id INT AUTO_INCREMENT";

        if ($conn->query($alterPlanilla) !== TRUE) {
            echo "Error al modificar la tabla usuarios: " . $conn->error;
        }

        $sql = "INSERT INTO Planillas (fk_empleado_id, tipo_planilla, fecha_planilla, monto_debitado) 
                VALUES ('$fk_empleado_id', '$tipo_planilla', '$fecha_planilla', '$monto_debitado')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Planilla agregada con éxito."); window.location.href = "http://solidarista.infinityfreeapp.com/planilla.php";</script>';

        } else {
            echo "Error al agregar la planilla: " . $conn->error;
        }
    }
}
?>
