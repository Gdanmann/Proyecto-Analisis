<?php
// Incluye el archivo de conexión
include('conexion.php');

// Inicializa la variable de búsqueda
$busqueda = "";

// Verifica si se ha enviado una búsqueda
if (isset($_GET['busqueda'])) {
    $busqueda = $_GET['busqueda'];
    // Consulta SQL para obtener las compras solidaristas que coinciden con la búsqueda
    $sql = "SELECT compra_id, fk_empleado_id, fecha_compra, monto_compra FROM ComprasSolidarista WHERE fk_empleado_id LIKE '%$busqueda%' OR fecha_compra LIKE '%$busqueda%'";
} else {
    // Consulta SQL para obtener todas las compras solidaristas
    $sql = "SELECT compra_id, fk_empleado_id, fecha_compra, monto_compra FROM ComprasSolidarista";
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
    <h2>Lista de Compras Solidaristas</h2>
    <form class="form-inline mb-3">
        <input type="text" class="form-control mr-2" placeholder="Buscar por empleado ID, fecha de compra o nombre del producto" name="busqueda"
               value="<?php echo $busqueda; ?>">
        <button class="btn btn-primary">Buscar</button>
        <a href="agregarcomprasolidarista.php" class="btn btn-success margin-left">Agregar compra</a>
    </form>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Compra ID</th>
            <th>Empleado ID</th>
            <th>Fecha de Compra</th>
            <th>Monto de Compra</th>
        </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["compra_id"] . "</td>";
                    echo "<td>" . $row["fk_empleado_id"] . "</td>";
                    echo "<td>" . $row["fecha_compra"] . "</td>";
                    echo "<td>" . $row["monto_compra"] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No se encontraron compras solidaristas.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
<?php
$conn->close();
?>
