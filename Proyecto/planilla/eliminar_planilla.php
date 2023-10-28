<?php
include('conexion.php');

if ($conn){

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
  $planillaId = $_GET["id"];

  // Elimina el departamento con el nombre especificado
  $sql = "DELETE FROM Planillas WHERE planilla_id = '$planillaId'";

  if ($conn->query($sql) === TRUE) {
    echo '<script>alert("planilla eliminada con éxito."); window.location.href = "http://solidarista.infinityfreeapp.com/planilla.php";</script>';

  } else {
    echo '<script>alert("Error al eliminar la planilla."); window.location.href = "http://solidarista.infinityfreeapp.com/planilla.php";</script>';
  }
}
}else{
  echo "No se pudo establecer conexión a la base de datos.";

}
?>



