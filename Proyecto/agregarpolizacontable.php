<!DOCTYPE html>
<html>
<head>
    <title>Solidarista</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Formulario para Agregar Pólizas Contables</h2>
        <form action="agregarpolizacontable.php" method="POST">
            <div class="form-group">
                <label for="fk_empleado_id">Empleado ID:</label>
                <input type="text" class="form-control" name="fk_empleado_id" id="fk_empleado_id" required>
            </div>
            <br>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" required>
            </div>
            <br>
            <div class="form-group">
                <label for="cuenta_contable">Cuenta Contable:</label>
                <input type="text" class="form-control" name="cuenta_contable" id="cuenta_contable" required>
            </div>
            <br>
            <div class="form-group">
                <label for="monto_acreditado">Monto Acreditado:</label>
                 <input type="number" step="0.01" class="form-control" name="monto_acreditado" id="monto_acreditado" required>
            </div>
            <div class="form-group">
                <label for="descuento">Descuento:</label>
                 <input type="number" step="0.01" class="form-control" name="descuento" id="descuento" required>
            </div>
            <div class="form-group">
                <label for="monto_total">Monto Total:</label>
                 <input type="number" step="0.01" class="form-control" name="monto_total" id="monto_total" required>
            </div>
            <br>
            <button type="submit" class="btn btn-success">Agregar Póliza Contable</button>
        </form>
    </div>


    <script>
    document.addEventListener("DOMContentLoaded", function() {
    function calcularMontoTotal() {
        var montoAcreditado = parseFloat(document.getElementById("monto_acreditado").value);
       // var descuento = document.getElementById("descuento").value;
        var descuento1, descuento2, descuento3;
    
        descuento1 = montoAcreditado * 0.0483;
        descuento2 = montoAcreditado * 0.01;
        
        if (montoAcreditado <= 30000) {
            descuento3 = montoAcreditado * 0.05;
        } else {
            descuento3 = montoAcreditado * 0.07;
        }
        
        var descuento = descuento1 + descuento2 + descuento3;
        var montoTotal = montoAcreditado - descuento;
        
        document.getElementById("descuento").value = descuento.toFixed(2);
        document.getElementById("monto_total").value = montoTotal.toFixed(2);
    }
    
    document.getElementById("monto_acreditado").addEventListener("input", calcularMontoTotal);
    document.getElementById("descuento").addEventListener("input", calcularMontoTotal);
    
    calcularMontoTotal();
});





</script>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-pzjw8f+ua7Kw1TIq0v8FqFjcJ6pajs/rfdfs3SO+kD5tr5P6n5F5f5p4p6b2C6z6I" crossorigin="anonymous"></script>
</body>
</html>

<?php
// Incluye el archivo de conexión a la base de datos
include('conexion.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recopila los datos del formulario
    $fk_empleado_id = $_POST['fk_empleado_id'];
    $descripcion = $_POST['descripcion'];
    $cuenta_contable = $_POST['cuenta_contable'];
    $monto_acreditado = $_POST['monto_acreditado'];
    $descuento = $_POST['descuento'];
    $monto_total = $_POST['monto_total'];

    // Verifica si algún campo obligatorio está vacío
    if (empty($fk_empleado_id) || empty($descripcion) || empty($cuenta_contable) || empty($monto_acreditado) || empty($descuento)|| empty($monto_total)) {
        echo "Todos los campos son obligatorios. Por favor, llene todos los campos.";
    } else {
        // Inserta los datos en la tabla de Pólizas Contables
        $alterPolizasContables = "ALTER TABLE PolizasContables MODIFY COLUMN poliza_id INT AUTO_INCREMENT";

            if ($conn->query($alterPolizasContables) !== TRUE) {
                echo "Error al modificar la tabla usuarios: " . $conn->error;
            }

        $sql = "INSERT INTO PolizasContables (fk_empleado_id, descripcion, cuenta_contable, monto_acreditado, descuento, monto_total) VALUES ('$fk_empleado_id', '$descripcion', '$cuenta_contable', '$monto_acreditado', '$descuento', '$monto_total')";


        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Se agrego éxitosamente."); window.location.href = "http://solidarista.infinityfreeapp.com/polizacontable.php";</script>';
        } else {
            echo "Error al agregar la póliza contable: " . $conn->error;
        }
    }

    // Cierra la conexión a la base de datos
    $conn->close();
}
?>