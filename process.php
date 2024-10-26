<?php
// Configuración de la conexión a la base de datos
$server = "localhost";
$user = "root";
$pass = "";
$db = "dokibase";

// Crear la conexión
$conexion = new mysqli($server, $user, $pass, $db);

// Verificar la conexión
if ($conexion->connect_errno) {
    die("Conexión fallida: " . $conexion->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];

    // Verificar que las contraseñas coincidan
    if ($contrasena !== $confirmar_contrasena) {
        echo "<script>alert('Las contraseñas no coinciden. Por favor, inténtelo de nuevo.'); window.location.href='reguser.html';</script>";
        exit();
    }

    // Consulta de inserción en la tabla USUARIO
    $sql = "INSERT INTO USUARIO (Nombre_usuario, Correo_electronico, Contraseña, Fecha_registro, Calificacion_servicio) 
            VALUES (?, ?, ?, CURDATE(), ?)";

    // Preparar la consulta
    $stmt = $conexion->prepare($sql);

    // Verificar si la preparación fue exitosa
    if ($stmt) {
        // Generar un correo electrónico de ejemplo (puedes cambiarlo por un campo real)
        $correo_electronico = $usuario . '@dokivet.com';

        // Calificación predeterminada
        $calificacion_servicio = 5;

        // Enlazar los parámetros a la consulta preparada
        $stmt->bind_param("sssi", $nombres, $correo_electronico, $confirmar_contrasena, $calificacion_servicio);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "<script>alert('Usuario registrado con éxito.'); window.location.href='Inicio.html';</script>";
        } else {
            echo "<script>alert('Error al registrar el usuario: " . $stmt->error . "'); window.location.href='reguser.html';</script>";
        }

        // Cerrar la consulta
        $stmt->close();
    } else {
        echo "<script>alert('Error en la preparación de la consulta: " . $conexion->error . "'); window.location.href='reguser.html';</script>";
    }
}

// Cerrar la conexión
$conexion->close();
?>
