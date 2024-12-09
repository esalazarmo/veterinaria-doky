<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$bd = "dokibase";

$conn = new mysqli($servidor, $usuario, $clave, $bd);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$nombre_mascota = $_POST['nombre_mascota'];
$especie = $_POST['especie'];
$raza = $_POST['raza'];
$edad = $_POST['edad'];
$id_usuario = $_POST['id_usuario'];

$sql = $conn->prepare("INSERT INTO MASCOTA (nombre_mascota, especie, raza, edad, id_Usuario) VALUES (?, ?, ?, ?, ?)");
$sql->bind_param("sssii", $nombre_mascota, $especie, $raza, $edad, $id_usuario);

if ($sql->execute()) {
    echo "<script>alert('Mascota registrada con éxito.'); window.location.href='historiac.html';</script>";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
