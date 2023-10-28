<!DOCTYPE html>
<html>
<head>
    <title>solidarista</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
            <style>
    body{
  background-color: #FFFFFF;
}

.color_nav{
    background-color: #AED0EF; 

}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #AED0EF; 
    padding: 10px 20px;
}

.logo img {
    max-height: 40px;
}

nav ul {
    list-style: none;
    display: flex;
    margin: 0;
    padding: 0;
}

nav ul li {
    margin-right: 20px;
}

nav ul li:last-child {
    margin-right: 0; 
}

nav ul li a {
    text-decoration: none;
    color: #000; 
    font-weight: bold;
}


table {
    width: 70%;
    border-collapse: collapse;
    margin: 20px;
    background-color: #FFFFFF;
}

th, td {
    border: 1px solid black;
    padding: 10px;
    text-align: left;
}

th {
    background-color: #ECECEC;
}

.margin-left{
    margin-left:20px;
}



@media screen and (max-width: 768px) {
    body{
        background-color: #FFFFFF;
      }
      
      header {
          display: flex;
          justify-content: space-between;
          align-items: center;
          background-color: #AED0EF; 
          padding: 10px 20px;
      }
      
      .logo img {
          max-height: 40px; 
      }
      
      nav ul {
          list-style: none;
          display: flex;
          margin: 0;
          padding: 0;
      }
      
      nav ul li {
          margin-right: 15px; 
      }
      
      nav ul li:last-child {
          margin-right: 0; 
      }
      
      nav ul li a {
          text-decoration: none;
          color: #000; 
          font-weight: bold;
      }
      
      
      
}
    </style>
    
</head>
<body>

 <header>
            <div class="logo">
                <img src="imagen/logo.png" alt="Logo">
            </div>
    </header>


    <div class="container">
        <h2>Agregar Ausencia</h2>
        <form method="post" action="agregar_ausencia.php">
            <div class="form-group">
                <label for="fk_empleado_id">ID del Empleado:</label>
                <input type="number" class="form-control" name="fk_empleado_id" required>
            </div>
            <div class="form-group">
                <label for="motivo">Motivo:</label>
                <input type="text" class="form-control" name="motivo" required>
            </div>
            <div class="form-group">
                <label for="fecha_inicio">Fecha de Inicio:</label>
                <input type="date" class="form-control" name="fecha_inicio" required>
            </div>
            <div class="form-group">
                <label for="fecha_fin">Fecha de Fin:</label>
                <input type="date" class="form-control" name="fecha_fin" required>
            </div>
            <div class="form-group">
                <label for="autorizada">Autorizada:</label>
                <select class="form-control" name="autorizada" required>
                    <option value="Si">Sí</option>
                    <option value="No">No</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Agregar Ausencia</button>
        </form>
    </div>
</body>
</html>

<?php
// Incluye el archivo de conexión a la base de datos
include('conexion.php'); // Asegúrate de incluir el archivo correcto

if ($conn) {
    // Verifica si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recupera y verifica los valores de los campos del formulario
        $fk_empleado_id = $_POST["fk_empleado_id"];
        $motivo = $_POST["motivo"];
        $fecha_inicio = $_POST["fecha_inicio"];
        $fecha_fin = $_POST["fecha_fin"];
        $autorizada = $_POST["autorizada"];

        // Verifica que los campos obligatorios no estén vacíos
        if (empty($fk_empleado_id) || empty($motivo) || empty($fecha_inicio) || empty($fecha_fin) || empty($autorizada)) {
            echo "Todos los campos obligatorios deben estar llenos. <a href='agregar_ausencia.php'>Volver al formulario</a>";
        } else {
            // Consulta SQL para agregar una nueva ausencia
            $sql = "INSERT INTO Ausencias (fk_empleado_id, motivo, fecha_inicio, fecha_fin, autorizada) 
                    VALUES ('$fk_empleado_id', '$motivo', '$fecha_inicio', '$fecha_fin', '$autorizada')";

            $alterAusenciasSql = "ALTER TABLE Ausencias MODIFY COLUMN ausencia_id INT AUTO_INCREMENT";
            
            if ($conn->query($alterAusenciasSql) !== TRUE) {
                echo "Error al modificar la tabla usuarios: " . $conn->error;
            }
  

            if ($conn->query($sql) === TRUE) {
                echo '<script>alert("Ausencia agregada con éxito."); window.location.href = "http://solidarista.infinityfreeapp.com/ausencias.php";</script>';

            } else {
                echo "Error al agregar la ausencia: " . $conn->error;
            }
        }
    }
}
?>
