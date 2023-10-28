<?php
include('conexion.php');

if ($conn) {
    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
        $planillaID = $_GET["id"];

        // Actualiza la planilla con el ID especificado
        $sql = "UPDATE Planillas SET columna1 = planilla_id, columna2 = fk_empleado_id, columna3 = tipo_planilla, columna4 = fecha_planilla, columna5 = monto_total WHERE planilla_id = '$planillaID'";

        // Reemplaza "columna1 = valor1, columna2 = valor2, ..." con las columnas y valores que deseas actualizar en tu tabla.

        if ($conn->query($sql) === TRUE) {
            echo '<script>alert("Planilla editada con éxito."); window.location.href = "http://solidarista.infinityfreeapp.com/planilla.php";</script>';
        } else {
            echo '<script>alert("Error al editar la Planilla."); window.location.href = "http://solidarista.infinityfreeapp.com/planilla.php";</script>';
        }
    } else {
        echo "No se pudo establecer conexión a la base de datos.";
    }
}
?>


, , , , 