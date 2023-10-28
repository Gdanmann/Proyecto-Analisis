<?php
include('conexion.php');

if ($conn){

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
  $polizaId = $_GET["id"];

  // Elimina el departamento con el nombre especificado
  $sql = "DELETE FROM PolizasContables WHERE poliza_id = '$polizaId'";

  if ($conn->query($sql) === TRUE) {
    echo '<script>alert("poliza eliminada con éxito."); window.location.href = "http://solidarista.infinityfreeapp.com/polizacontable.php";</script>';

  } else {
    echo '<script>alert("Error al eliminar la poliza."); window.location.href = "http://solidarista.infinityfreeapp.com/polizacontable.php";</script>';
  }
}
}else{
  echo "No se pudo establecer conexión a la base de datos.";

}
?>



