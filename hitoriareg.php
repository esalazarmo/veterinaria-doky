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

// Consulta para obtener mascotas
$queryMascotas = "SELECT id_mascota, nombre_mascota FROM MASCOTA";
$resultMascotas = $conn->query($queryMascotas);

// Consulta para obtener veterinarios
$queryVeterinarios = "SELECT id_veterinario, nombre_veterinario FROM VETERINARIO";
$resultVeterinarios = $conn->query($queryVeterinarios);

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Historia Clínica</title>
    <link rel="stylesheet" href="reghitoria.css"> <!-- Vinculación al CSS -->
    <script>
        // Función para cargar las mascotas del usuario seleccionado
        function cargarMascotas() {
            var idUsuario = document.getElementById('id_usuario').value;
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'obtener_mascotas.php?id_usuario=' + idUsuario, true);
            xhr.onload = function() {
                if (this.status == 200) {
                    var mascotas = JSON.parse(this.responseText);
                    var selectMascota = document.getElementById('id_mascota');
                    selectMascota.innerHTML = '<option value="">Seleccionar Mascota</option>';
                    for (var i = 0; i < mascotas.length; i++) {
                        selectMascota.innerHTML += '<option value="' + mascotas[i].id_mascota + '">' + mascotas[i].nombre_mascota + '</option>';
                    }
                }
            };
            xhr.send();
        }
    </script>
</head>
<body>
    <div class="container">
        <!-- Formulario para registrar una historia clínica -->
        <h2>Registrar Historia Clínica</h2>
        <form action="guardar_historia_clinica.php" method="POST">
            <label for="id_usuario">Dueño de la Mascota:</label>
            <select name="id_usuario" id="id_usuario" required onchange="cargarMascotas()">
                <option value="">Seleccionar Usuario</option>
                <?php
                while ($row = $resultUsuarios->fetch_assoc()) {
                    echo "<option value='".$row['IdUsuario']."'>".$row['Nombre_usuario']."</option>";
                }
                ?>
            </select>

            <label for="id_mascota">Mascota:</label>
            <select name="id_mascota" id="id_mascota" required>
                <option value="">Seleccionar Mascota</option>
                <?php
                while ($row = $resultMascotas->fetch_assoc()) {
                    echo "<option value='".$row['id_mascota']."'>".$row['nombre_mascota']."</option>";
                }
                ?>
            </select>

            <label for="id_veterinario">Veterinario:</label>
            <select name="id_veterinario" id="id_veterinario" required>
                <option value="">Seleccionar Veterinario</option>
                <?php
                while ($row = $resultVeterinarios->fetch_assoc()) {
                    echo "<option value='".$row['id_veterinario']."'>".$row['nombre_veterinario']."</option>";
                }
                ?>
            </select>

            <label for="fecha_consulta">Fecha de la consulta:</label>
            <input type="date" id="fecha_consulta" name="fecha_consulta" required>

            <label for="diagnostico">Diagnóstico:</label>
            <input type="text" id="diagnostico" name="diagnostico" required>

            <label for="tratamiento">Tratamiento:</label>
            <input type="text" id="tratamiento" name="tratamiento" required>

            <label for="observaciones">Observaciones:</label>
            <textarea id="observaciones" name="observaciones"></textarea>

            <button type="submit">Guardar Historia Clínica</button>
        </form>
    </div>
</body>
</html>

