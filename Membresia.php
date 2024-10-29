<?php
// Configuración de la conexión a la base de datos
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibe los datos del formulario
    $tipo_membresia = $_POST['tipo_membresia'];
    $precio_mensual = $_POST['precio_mensual'];
    $beneficios = $_POST['beneficios'];

    // Inserta los datos en la tabla membresia
     // Preparar y ejecutar la consulta
     $stmt = $conn->prepare("INSERT INTO membresia (tipo_membresia, precio_mensual, beneficios) VALUES (?, ?, ?)");
     $stmt->bind_param("sis", $tipo_membresia, $precio_mensual, $beneficios); // "sis" representa el tipo de los parámetros: string, integer, string.
     
     if ($stmt->execute()) {
        
        echo "
        <script>
            alert('Membresía añadida correctamente');
            window.location.href = 'Inicio.html';
        </script>
        ";
     } else {
         echo "Error al añadir la membresía: " . $stmt->error;
     }
     
     // Cerrar la declaración y la conexión
     $stmt->close();
     $conn->close();
 }
?>