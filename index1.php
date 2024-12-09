<?php

$servidor = "localhost";
$usuario = "root";
$clave = "";
$bd = "dokibase";

$conexion = mysqli_connect($servidor, $usuario, $clave, $bd);


if (!$conexion) {
    die("<div style='color: red; font-size: 20px;'>La conexión ha fallado: " . mysqli_connect_error() . "</div>");
} else {
    echo "<div style='color: green; font-size: 20px;'>Conexión exitosa a la base de datos  (0-0)</div>";
}


if (isset($_POST['enviar'])) {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    if (!empty($nombre) && !empty($correo) && !empty($telefono)) {

        $insertar = "INSERT INTO USUARIO (Nombre_usuario, Correo_electronico, Contraseña, Fecha_registro, Calificacion_servicio) 
                     VALUES ('$nombre', '$correo', '', NOW(), 0)";


        if (mysqli_query($conexion, $insertar)) {
            echo "<div style='color: green; font-size: 20px;'>Datos insertados correctamente</div>";
        } else {
            echo "<div style='color: red; font-size: 20px;'>Error al insertar los datos: " . mysqli_error($conexion) . "</div>";
        }
    } else {
        echo "<div style='color: red; font-size: 20px;'>Por favor, complete todos los campos</div>";
    }
}

// Cerrar la conexión --
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba de Conexión e Inserción (0-0)</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f4f4f4;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 300px;
        }
        input[type="text"], input[type="submit"] {
            padding: 10px;
            font-size: 16px;
        }
        input[type="submit"] {
            cursor: pointer;
            background-color: #007bff;
            color: white;
            border: none;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<form method="post">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="text" name="correo" placeholder="Correo" required>
    <input type="text" name="telefono" placeholder="Teléfono" required>
    <input type="submit" name="enviar" value="Enviar">
</form>

</body>
</html>
