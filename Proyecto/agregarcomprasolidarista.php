<!DOCTYPE html>
<html>
<head>
    <title>Formulario Compras Solidaristas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Formulario para Agregar Compras Solidaristas</h2>
        <form action="agregarcomprasolidarista.php" method="POST">
            <div class="form-group">
                <label for="fk_empleado_id">Empleado ID:</label>
                <input type="text" class="form-control" name="fk_empleado_id" id="fk_empleado_id" required>
            </div>

            <div class="form-group">
                <label for="fecha_compra">Fecha de Compra:</label>
                <input type="date" class="form-control" name="fecha_compra" id="fecha_compra" required>
            </div>

            <div class="form-group">
                <label for="monto_compra">Monto de Compra:</label>
                <input type="text" class="form-control" name="monto_compra" id="monto_compra" required>
            </div>

            <button type="submit" class="btn btn-primary">Agregar Compra</button>
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
        $fecha_compra = $_POST["fecha_compra"];
        $monto_compra = $_POST["monto_compra"];

        if (empty($fk_empleado_id) || empty($fecha_compra) || empty($monto_compra) ) {
            echo "Por favor, complete todos los campos del formulario.";
            exit;
        }

        $alterCompra = "ALTER TABLE ComprasSolidarista MODIFY COLUMN compra_id INT AUTO_INCREMENT";

            if ($conn->query($alterCompra) !== TRUE) {
                echo "Error al modificar la tabla usuarios: " . $conn->error;
            }

        // Luego, inserta los valores en la base de datos
        $sql = "INSERT INTO ComprasSolidarista (fk_empleado_id, fecha_compra, monto_compra) 
                VALUES ('$fk_empleado_id', '$fecha_compra', '$monto_compra')";

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("La compra se guardo correctamente."); window.location.href = "http://solidarista.infinityfreeapp.com/principal.php";</script>';
        } else {
            echo "Error al registrar la compra: " . $conn->error;
        }
    }
}
?>

