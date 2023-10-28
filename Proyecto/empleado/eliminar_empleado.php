<?php
include('conexion.php');

if ($conn){

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["id"])) {
  $empleadoID = $_GET["id"];

  // Elimina el departamento con el nombre especificado
  $sql = "DELETE FROM Empleados WHERE empleado_id = '$empleadoID'";

  if ($conn->query($sql) === TRUE) {
    echo '<script>alert("empledo eliminado con éxito."); window.location.href = "http://solidarista.infinityfreeapp.com/empleado.php";</script>';

  } else {
    echo '<script>alert("Error al eliminar el empledo."); window.location.href = "http://solidarista.infinityfreeapp.com/empleado.php";</script>';
  }
}
}else{
  echo "No se pudo establecer conexión a la base de datos.";

}
?>
