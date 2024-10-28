<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$bd = "dokibase";

$conn = new mysqli($servidor, $usuario, $clave, $bd);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id_cita = $_POST['id_cita'];
$fecha_disponible = $_POST['fecha_disponible'];
$hora_disponible = $_POST['hora_disponible'];
$id_veterinario = $_POST['id_veterinario'];

$sql = $conn->prepare("INSERT INTO CALENDARIO (id_cita, fecha_disponible, hora_disponible, id_veterinario) VALUES (?, ?, ?, ?)");
$sql->bind_param("issi", $id_cita, $fecha_disponible, $hora_disponible, $id_veterinario);

if ($sql->execute()) {
    echo "Calendario registrado con éxito.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
