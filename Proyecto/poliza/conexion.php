<?php
$server = "sql111.infinityfree.com";
$username = "if0_35297284";
$pass = "rH4o1mIHTiuKhqM";
$db = "if0_35297284_solidarista";

// Crear una conexión
$conn = new mysqli($server, $username, $pass, $db);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
}
?>
