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

// Obtener el ID de la mascota
$idMascota = isset($_GET['id_mascota']) ? intval($_GET['id_mascota']) : 0;

if ($idMascota > 0) {
    // Consulta para obtener las historias clínicas de la mascota
    $queryHistorias = "SELECT id_historia, CONCAT('Consulta: ', fecha_consulta, ' - Diagnóstico: ', diagnostico) AS descripcion 
                       FROM HISTORIA_CLINICA 
                       WHERE id_mascota = ?";
    
    $stmt = $conn->prepare($queryHistorias);
    $stmt->bind_param("i", $idMascota);
    $stmt->execute();
    $result = $stmt->get_result();

    $historias = [];
    while ($row = $result->fetch_assoc()) {
        $historias[] = $row;
    }

    // Retornar las historias en formato JSON
    echo json_encode($historias);
} else {
    echo json_encode([]);
}

$conn->close();
?>
