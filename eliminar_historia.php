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

// Obtener el ID de la historia clínica a eliminar
$idHistoria = isset($_POST['id_historia']) ? intval($_POST['id_historia']) : 0;

if ($idHistoria > 0) {
    // Consulta para eliminar la historia clínica
    $queryEliminar = "DELETE FROM HISTORIA_CLINICA WHERE id_historia = ?";
    $stmt = $conn->prepare($queryEliminar);
    $stmt->bind_param("i", $idHistoria);

    if ($stmt->execute()) {
        echo "Historia clínica eliminada con éxito.";
    } else {
        echo "Error al eliminar la historia clínica: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "ID de historia clínica no válido.";
}

$conn->close();
?>
