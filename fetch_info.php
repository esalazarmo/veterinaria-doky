<?php
$conexion = new mysqli("localhost", "root", "", "dokibase");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$userId = $_GET['userId'];

// Obtener información de mascotas
$queryMascotas = "SELECT nombre_mascota, especie, raza, edad FROM MASCOTA WHERE id_Usuario = $userId";
$resultMascotas = $conexion->query($queryMascotas);

$petInfo = "<ul>";
while ($row = $resultMascotas->fetch_assoc()) {
    $petInfo .= "<li>{$row['nombre_mascota']} ({$row['especie']} - {$row['raza']}, {$row['edad']} años)</li>";
}
$petInfo .= "</ul>";

// Obtener historias clínicas
$queryHistoria = "SELECT fecha_consulta, diagnostico, tratamiento, observaciones 
                  FROM HISTORIA_CLINICA 
                  WHERE id_mascota IN (SELECT id_mascota FROM MASCOTA WHERE id_Usuario = $userId)";
$resultHistoria = $conexion->query($queryHistoria);

$historyInfo = "<table><thead><tr><th>Fecha</th><th>Diagnóstico</th><th>Tratamiento</th><th>Observaciones</th></tr></thead><tbody>";
while ($row = $resultHistoria->fetch_assoc()) {
    $historyInfo .= "<tr>
                        <td>{$row['fecha_consulta']}</td>
                        <td>{$row['diagnostico']}</td>
                        <td>{$row['tratamiento']}</td>
                        <td>{$row['observaciones']}</td>
                     </tr>";
}
$historyInfo .= "</tbody></table>";

// Devolver los resultados
echo $petInfo . "###" . $historyInfo;

$conexion->close();
?>
