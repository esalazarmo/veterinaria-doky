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

// Consulta para obtener usuarios
$queryUsuarios = "SELECT IdUsuario, Nombre_usuario FROM USUARIO";
$resultUsuarios = $conn->query($queryUsuarios);

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Mascota</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <h2>Registrar Nueva Mascota</h2>
        <form action="guardar_mascota.php" method="POST">
            <div class="form-group">
                <label for="id_usuario">Dueño de la Mascota:</label>
                <select name="id_usuario" id="id_usuario" required>
                    <option value="">Seleccionar Usuario</option>
                    <?php
                    while ($row = $resultUsuarios->fetch_assoc()) {
                        echo "<option value='".$row['IdUsuario']."'>".$row['Nombre_usuario']."</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="nombre_mascota">Nombre de la Mascota:</label>
                <input type="text" id="nombre_mascota" name="nombre_mascota" required>
            </div>

            <div class="form-group">
                <label for="especie">Especie:</label>
                <input type="text" id="especie" name="especie" required>
            </div>

            <div class="form-group">
                <label for="raza">Raza:</label>
                <input type="text" id="raza" name="raza" required>
            </div>

            <div class="form-group">
                <label for="edad">Edad:</label>
                <input type="number" id="edad" name="edad" min="0" required>
            </div>

            <button type="submit">Registrar Mascota</button>
        </form>
    </div>
</body>
</html>
