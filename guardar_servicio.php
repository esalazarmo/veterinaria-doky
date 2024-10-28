<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$bd = "dokibase";

$conn = new mysqli($servidor, $usuario, $clave, $bd);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre_servicio = $_POST['nombre_servicio'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$id_estilista = $_POST['id_estilista'];
$id_veterinario = $_POST['id_veterinario'];

$sql = $conn->prepare("INSERT INTO SERVICIO (nombre_servicio, descripcion, precio, id_estilista, id_veterinario) VALUES (?, ?, ?, ?, ?)");
$sql->bind_param("ssdii", $nombre_servicio, $descripcion, $precio, $id_estilista, $id_veterinario);

if ($sql->execute()) {
    echo "Servicio registrado con éxito.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
