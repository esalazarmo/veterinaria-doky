<?php
// Configuración de la conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dokibase";

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los datos del formulario
$tipo_servicio = $_POST['tipo_servicio'];
$hora = $_POST['hora'];
$fecha_cita = $_POST['fecha_cita'];
$veterinario = $_POST['veterinario'];
$estilista = $_POST['estilista'];
$email = $_POST['correo']; // Correo electrónico

// Insertar en la tabla Cita
$sql = "INSERT INTO CITA (tipo_servicio, hora, fecha_cita, id_veterinario, id_estilista, email)
VALUES ('$tipo_servicio', '$hora', '$fecha_cita', '$veterinario', '$estilista', '$email')";

if ($conn->query($sql) === TRUE) {
    echo "Cita registrada correctamente.";
    header("Location: cita.php"); // Redirigir a la página de confirmación o a la lista de citas
} else {
    echo "Error al registrar la cita: " . $conn->error;
}

$conn->close();
?>
