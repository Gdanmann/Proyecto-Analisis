<?php
$servername = "sql111.infinityfree.com";
$username = "if0_35297284";
$password = "rH4o1mIHTiuKhqM";
$dbname = "if0_35297284_solidarista";

// Crear una conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
}
?>
