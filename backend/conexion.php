<?php
$host = "localhost";
$puerto = 3306;
$usuario_db = "root";
$password_db = "";
$base_datos = "utn_db";

$conn = new mysqli($host, $usuario_db, $password_db, $base_datos, $puerto);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8");
?>