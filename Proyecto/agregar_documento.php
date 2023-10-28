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
    <h2>Agregar Documento</h2>
    <form method="post" action="agregar_documento.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="fk_empleado_id">Código del Empleado:</label>
            <input type="text" class="form-control" name="fk_empleado_id" required>
        </div>
        <div class="form-group">
            <label for="tipo_documento">Tipo de Documento:</label>
            <input type="text" class="form-control" name="tipo_documento" required>
        </div>
        <div class="form-group">
            <label for="archivo_pdf">Archivo PDF:</label>
            <input type="text" class="form-control-file" name="archivo_pdf" >
        </div>
        <button type="submit" class="btn btn-success">Agregar Documento</button>
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
        $tipo_documento = $_POST["tipo_documento"];
        $archivo_pdf = $_POST["archivo_pdf"];

        // Verifica que los campos obligatorios no estén vacíos
        if (empty($fk_empleado_id) || empty($tipo_documento) || empty($archivo_pdf)) {
            echo "Todos los campos obligatorios deben estar llenos. <a href='agregar_documento.php'>Volver al formulario</a>";
        } else {
            // Consulta SQL para agregar un nuevo documento
            $alterDocumentosEmpleados = "ALTER TABLE DocumentosEmpleados MODIFY COLUMN documento_id INT AUTO_INCREMENT";

            if ($conn->query($alterDocumentosEmpleados) !== TRUE) {
                echo "Error al modificar la tabla usuarios: " . $conn->error;
            }
  
            $sql = "INSERT INTO DocumentosEmpleados (fk_empleado_id, tipo_documento, archivo_pdf) VALUES ('$fk_empleado_id', '$tipo_documento', '$archivo_pdf')";

            if ($conn->query($sql) === TRUE) {
                echo '<script>alert("Documento agregado con éxito."); window.location.href = "http://solidarista.infinityfreeapp.com/documentos.php";</script>';
            } else {
                echo "Error al agregar el documento: " . $conn->error;
            }
        }
    }
}
?>

