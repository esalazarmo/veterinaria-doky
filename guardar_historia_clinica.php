<?php
// Conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$clave = "";
$bd = "dokibase";

$conn = new mysqli($servidor, $usuario, $clave, $bd);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$id_mascota = $_POST['id_mascota'];
$id_veterinario = $_POST['id_veterinario'];
$fecha_consulta = $_POST['fecha_consulta'];
$diagnostico = $_POST['diagnostico'];
$tratamiento = $_POST['tratamiento'];
$observaciones = $_POST['observaciones'];

// Preparar la consulta para insertar datos
$sql = "INSERT INTO HISTORIA_CLINICA (id_mascota, id_veterinario, fecha_consulta, diagnostico, tratamiento, observaciones)
        VALUES ('$id_mascota', '$id_veterinario', '$fecha_consulta', '$diagnostico', '$tratamiento', '$observaciones')";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    // Obtener el último ID insertado
    $ultimo_id = $conn->insert_id;
    echo "Historia clínica registrada con éxito. El ID de la historia es: " . $ultimo_id;
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
