<?php
session_start();

$servidor = "localhost";
$usuario = "root";
$clave = "";
$bd = "dokibase";

$conexion = mysqli_connect($servidor, $usuario, $clave, $bd);

if (!$conexion) {
    die("<div style='color: red; font-size: 20px;'>La conexión ha fallado: " . mysqli_connect_error() . "</div>");
}

if (isset($_POST['iniciar_sesion'])) {
    $correo = $_POST['correo'];
    $contraseña = $_POST['contraseña'];
    $calificacion = $_POST['calificacion'];
    $comentario = $_POST['comentario'];

    // Verificar las credenciales del usuario
    $consulta = "SELECT * FROM USUARIO WHERE Correo_electronico='$correo' AND Contraseña='$contraseña'";
    $resultado = mysqli_query($conexion, $consulta);

    if (mysqli_num_rows($resultado) == 1) {
        $usuario = mysqli_fetch_assoc($resultado);
        $idUsuario = $usuario['IdUsuario'];

        // Actualizar la calificación y el comentario del usuario
        $actualizar = "UPDATE USUARIO SET Calificacion_servicio='$calificacion', Comentario='$comentario' WHERE IdUsuario='$idUsuario'";

        if (mysqli_query($conexion, $actualizar)) {
            echo "<script>alert('Gracias por calificarnos.'); window.location.href='Inicio.html';</script>";
        } else {
            echo "<div style='color: red; font-size: 20px;'>Error al guardar los datos: " . mysqli_error($conexion) . "</div>";
        }
    } else {
        echo "<div style='color: red; font-size: 20px;'>Correo o contraseña incorrectos</div>";
    }
}

mysqli_close($conexion);
?>

