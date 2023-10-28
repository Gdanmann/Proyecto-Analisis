<?php
// Incluye el archivo de conexión
include('conexion.php');

// Inicializa la variable de búsqueda
$busqueda = "";

// Verifica si se ha enviado una búsqueda
if (isset($_GET['busqueda'])) {
    $busqueda = $_GET['busqueda'];
    // Consulta SQL para obtener las pólizas contables que coinciden con la búsqueda
    $sql = "SELECT poliza_id, fk_empleado_id, descripcion, cuenta_contable, monto_acreditado, descuento, monto_total FROM PolizasContables WHERE fk_empleado_id LIKE '%$busqueda%' OR descripcion LIKE '%$busqueda%' OR cuenta_contable LIKE '%$busqueda%'";
} else {
    // Consulta SQL para obtener todas las pólizas contables
    $sql = "SELECT poliza_id, fk_empleado_id, descripcion, cuenta_contable, monto_acreditado, descuento, monto_total FROM PolizasContables";
}

// Ejecuta la consulta SQL
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Solidarista</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #FFFFFF;
        }

        color_nav {
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

        .margin-left {
            margin-left: 20px;
        }

        @media screen and (max-width: 768px) {
            body {
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

    <form action="index.php" method="POST">
        <header>
            <div class="logo">
                <img src="imagen/logo.png" alt="Logo">
            </div>
            <nav>
                <ul>
                    <li><a href="principal.php">Inicio</a></li>

  

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Empleado</a>
                        <ul class="dropdown-menu" style="">
                            <li><a class="dropdown-item" href="empleado.php">Empleado</a></li>
                            <li><a class="dropdown-item" href="ausencias.php">Ausencias</a></li>
                            <li><a class="dropdown-item" href="documentos.php">Documentos</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Nomina</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="planilla.php">Planilla</a></li>
                            <li><a class="dropdown-item" href="historialaumento.php">Historial Aumentos</a></li>
                            <li><a class="dropdown-item" href="horaextras.php">Horas extras</a></li>
                            <li><a class="dropdown-item" href="prestamos.php">Prestamos</a></li>
                            <li><a class="dropdown-item" href="polizacontable.php">Poliza contable</a></li>

                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Tienda Solidarista</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="comprasolidarista.php">Compra solidarista</a></li>
                            <li><a class="dropdown-item" href="comisiones.php">Comisiones ventas</a></li>
                            <li><a class="dropdown-item" href="bonificacion.php">Bonificacion produccion</a></li>
                        </ul>
                    </li>
     
                </ul>
            </nav>
            <button type="submit" name="cerrar_sesion" class="btn btn-outline-secondary" onclick="return confirm('¿Está seguro de que desea cerrar sesión?')">Cerrar sesión</button>
        </header>
    </form>

<div class="container">
    <h2>Lista de Pólizas Contables</h2>
    <form class="form-inline mb-3">
        <input type="text" class="form-control mr-2" placeholder="Buscar por empleado ID, descripción o cuenta contable" name="busqueda"
               value="<?php echo $busqueda; ?>">
        <button class="btn btn-primary">Buscar</button>
            <a href="agregarpolizacontable.php" class="btn btn-success margin-left">Agregar poliza contable</a>

    </form>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Póliza ID</th>
            <th>Empleado ID</th>
            <th>Descripción</th>
            <th>Cuenta Contable</th>
            <th>Monto Acreditado</th>
            <th>Descuento</th>
            <th>Monto Total</th>
            <th>Borrar Poliza</th>
        </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["poliza_id"] . "</td>";
                    echo "<td>" . $row["fk_empleado_id"] . "</td>";
                    echo "<td>" . $row["descripcion"] . "</td>";
                    echo "<td>" . $row["cuenta_contable"] . "</td>";
                    echo "<td>" . $row["monto_acreditado"] . "</td>";
                    echo "<td>" . $row["descuento"] . "</td>";
                    echo "<td>" . $row["monto_total"] . "</td>";

                    echo "<td>
                        <button class='btn btn-danger' onclick='borrar(\"" . $row["poliza_id"] . "\")'>Borrar</button>
                      </td>";


                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No se encontraron pólizas contables.</td></tr>";
            }
            ?>
        </tbody>
    </table>

     <script>     
        function borrar(polizaId) {
            if (confirm("¿Estás seguro que deseas eliminar esta poliza?")) {
                window.location.href = "poliza/eliminar_poliza.php?id=" + polizaId;
            }
        }

    </script>


</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
<?php
$conn->close();
?>
