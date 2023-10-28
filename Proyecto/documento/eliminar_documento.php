<?php
include('conexion.php');

if ($conn){

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
  $empleadoID = $_GET["id"];

  // Elimina el departamento con el nombre especificado
  $sql = "DELETE FROM DocumentosEmpleados WHERE documento_id = '$empleadoID'";

  if ($conn->query($sql) === TRUE) {
    echo '<script>alert("Documento eliminado con éxito."); window.location.href = "http://solidarista.infinityfreeapp.com/documentos.php";</script>';

  } else {
    echo '<script>alert("Error al eliminar el Documento."); window.location.href = "http://solidarista.infinityfreeapp.com/documentos.php";</script>';
  }
}
}else{
  echo "No se pudo establecer conexión a la base de datos.";

}
?>
