<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";  // Deja vacío si no tienes contraseña para MySQL en XAMPP
$bd = "dokibase";

// Crear conexión
$conn = new mysqli($servidor, $usuario, $clave, $bd);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>