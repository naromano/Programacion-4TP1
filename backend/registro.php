<?php
require_once 'conexion.php';

$usuario = isset($_POST['usuario']) ? trim($_POST['usuario']) : '';
$clave = isset($_POST['clave']) ? trim($_POST['clave']) : '';
$apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$bloqueado = isset($_POST['bloqueado']) ? trim($_POST['bloqueado']) : 'N';

if ($usuario === '' || $clave === '' || $apellido === '' || $nombre === '') {
    echo "<h2>Faltan completar datos obligatorios.</h2>";
    echo '<a href="../frontend/registro.html">Volver</a>';
    exit;
}

if ($bloqueado !== 'Y' && $bloqueado !== 'N') {
    echo "<h2>El valor de bloqueado es inválido.</h2>";
    echo '<a href="../frontend/registro.html">Volver</a>';
    exit;
}

$sqlCheck = "SELECT id FROM usuarios_utn WHERE usuario = ?";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param("s", $usuario);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result();

if ($resultCheck->num_rows > 0) {
    echo "<h2>El usuario ya existe.</h2>";
    echo '<a href="../frontend/registro.html">Volver</a>';
    $stmtCheck->close();
    $conn->close();
    exit;
}
$stmtCheck->close();

$sqlInsert = "INSERT INTO usuarios_utn (usuario, clave, apellido, nombre, bloqueado)
              VALUES (?, ?, ?, ?, ?)";

$stmtInsert = $conn->prepare($sqlInsert);
$stmtInsert->bind_param("sssss", $usuario, $clave, $apellido, $nombre, $bloqueado);

if ($stmtInsert->execute()) {
    echo "<h2>Usuario registrado correctamente.</h2>";
    echo '<a href="../frontend/login.html">Ir al login</a>';
} else {
    echo "<h2>Error al registrar el usuario.</h2>";
    echo '<a href="../frontend/registro.html">Volver</a>';
}

$stmtInsert->close();
$conn->close();
?>