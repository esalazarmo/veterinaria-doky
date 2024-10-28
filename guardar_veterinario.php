<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$bd = "dokibase";

$conn = new mysqli($servidor, $usuario, $clave, $bd);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre_veterinario = $_POST['nombre_veterinario'];
$especialidad = $_POST['especialidad'];
$telefono = $_POST['telefono'];

$sql = $conn->prepare("INSERT INTO VETERINARIO (nombre_veterinario, especialidad, telefono) VALUES (?, ?, ?)");
$sql->bind_param("sss", $nombre_veterinario, $especialidad, $telefono);

if ($sql->execute()) {
    echo "Veterinario registrado con éxito.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
