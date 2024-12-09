<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$bd = "dokibase";

// Conexión a la base de datos
$conn = new mysqli($servidor, $usuario, $clave, $bd);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$idUsuario = $_GET['id_usuario'];
$queryMascotas = "SELECT id_mascota, nombre_mascota FROM MASCOTA WHERE id_usuario = ?";
$stmt = $conn->prepare($queryMascotas);
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$result = $stmt->get_result();

$mascotas = array();
while ($row = $result->fetch_assoc()) {
    $mascotas[] = $row;
}

echo json_encode($mascotas);

$conn->close();
?>
