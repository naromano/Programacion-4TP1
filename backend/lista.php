<?php
header('Content-Type: application/json; charset=utf-8');
require_once 'conexion.php';

$action = isset($_GET['action']) ? trim($_GET['action']) : '';

if ($action === 'BUSCAR') {
    $usuario = isset($_GET['usuario']) ? trim($_GET['usuario']) : '';

    if ($usuario !== '') {
        $sql = "SELECT id, usuario, apellido, nombre, bloqueado
                FROM usuarios_utn
                WHERE usuario LIKE ?
                ORDER BY id ASC";

        $stmt = $conn->prepare($sql);
        $like = "%" . $usuario . "%";
        $stmt->bind_param("s", $like);
    } else {
        $sql = "SELECT id, usuario, apellido, nombre, bloqueado
                FROM usuarios_utn
                ORDER BY id ASC";

        $stmt = $conn->prepare($sql);
    }

    if (!$stmt) {
        echo json_encode([
            "respuesta" => "ERROR",
            "mje" => "Error al preparar la consulta"
        ]);
        exit;
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $usuarios = [];

    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }

    echo json_encode($usuarios);

    $stmt->close();
    $conn->close();
    exit;
}

if ($action === 'BLOQUEAR') {
    $idUser = isset($_GET['idUser']) ? intval($_GET['idUser']) : 0;
    $estado = isset($_GET['estado']) ? trim($_GET['estado']) : '';

    if ($idUser <= 0 || ($estado !== 'Y' && $estado !== 'N')) {
        echo json_encode([
            "respuesta" => "ERROR",
            "mje" => "Parámetros inválidos"
        ]);
        exit;
    }

    $sql = "UPDATE usuarios_utn SET bloqueado = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo json_encode([
            "respuesta" => "ERROR",
            "mje" => "Error al preparar la actualización"
        ]);
        exit;
    }

    $stmt->bind_param("si", $estado, $idUser);

    if ($stmt->execute()) {
        echo json_encode([
            "respuesta" => "OK",
            "mje" => "Actualización exitosa"
        ]);
    } else {
        echo json_encode([
            "respuesta" => "ERROR",
            "mje" => "No se pudo actualizar el usuario"
        ]);
    }

    $stmt->close();
    $conn->close();
    exit;
}

echo json_encode([
    "respuesta" => "ERROR",
    "mje" => "Acción no válida"
]);

$conn->close();
?>