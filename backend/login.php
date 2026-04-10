<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'conexion.php';

$user = isset($_GET['user']) ? trim($_GET['user']) : '';
$pass = isset($_GET['pass']) ? trim($_GET['pass']) : '';

if ($user === '' || $pass === '') {
    echo json_encode([
        "respuesta" => "ERROR",
        "mje" => "Debe ingresar usuario y clave"
    ]);
    exit;
}

$sql = "SELECT id, usuario, clave, bloqueado
        FROM usuarios_utn
        WHERE usuario = ? AND clave = ?
        LIMIT 1";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo json_encode([
        "respuesta" => "ERROR",
        "mje" => "Error al preparar la consulta"
    ]);
    exit;
}

$stmt->bind_param("ss", $user, $pass);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();

    if ($row['bloqueado'] === 'Y') {
        echo json_encode([
            "respuesta" => "ERROR",
            "mje" => "Usuario bloqueado"
        ]);
    } else {
        echo json_encode([
            "respuesta" => "OK",
            "mje" => "Ingreso Valido. Usuario " . $row['usuario']
        ]);
    }
} else {
    echo json_encode([
        "respuesta" => "ERROR",
        "mje" => "Ingreso Invalido, usuario y/o clave incorrecta"
    ]);
}

$stmt->close();
$conn->close();
?>