<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$bd = "dokibase";

$conn = new mysqli($servidor, $usuario, $clave, $bd);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre_producto = $_POST['nombre_producto'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$disponibilidad = $_POST['disponibilidad'];

$sql = $conn->prepare("INSERT INTO PRODUCTO (nombre_producto, descripcion, precio, disponibilidad) VALUES (?, ?, ?, ?)");
$sql->bind_param("ssdi", $nombre_producto, $descripcion, $precio, $disponibilidad);

if ($sql->execute()) {
    echo "Producto registrado con éxito.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
