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

// Obtener el correo electrónico del GET
if (!isset($_GET['email'])) {
    die("Correo electrónico no disponible.");
}
$email = $_GET['email'];

// Preparar la consulta para obtener la id_usuario
$stmt = $conn->prepare("SELECT IdUsuario FROM usuario WHERE Correo_electronico = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(array("idUsuario" => $row['IdUsuario']));
} else {
    echo "Usuario no encontrado";
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>

