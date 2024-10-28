<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$bd = "dokibase";

$conn = new mysqli($servidor, $usuario, $clave, $bd);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre_estilista = $_POST['nombre_estilista'];
$especialidad = $_POST['especialidad'];
$telefono = $_POST['telefono'];

$sql = $conn->prepare("INSERT INTO ESTILISTA (nombre_estilista, especialidad, telefono) VALUES (?, ?, ?)");
$sql->bind_param("sss", $nombre_estilista, $especialidad, $telefono);

if ($sql->execute()) {
    echo "Estilista registrado con éxito.";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
