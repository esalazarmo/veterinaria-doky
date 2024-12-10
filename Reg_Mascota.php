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
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #444;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        select, input, button {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }
        select:focus, input:focus, button:focus {
            border-color: #007bff;
            outline: none;
        }
        button {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            border: none;
            font-weight: bold;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
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
