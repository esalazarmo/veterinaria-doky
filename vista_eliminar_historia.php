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

// Consulta para obtener los usuarios
$queryUsuarios = "SELECT IdUsuario, Nombre_usuario FROM USUARIO";
$resultUsuarios = $conn->query($queryUsuarios);

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Historia Clínica</title>
    <link rel="stylesheet" href="estilos.css">
    <script>
        // Función para cargar las mascotas del usuario seleccionado
        function cargarMascotas() {
            var idUsuario = document.getElementById('id_usuario').value;
            if (idUsuario) {
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
        }

        // Función para cargar historias clínicas de la mascota seleccionada
        function cargarHistorias() {
            var idMascota = document.getElementById('id_mascota').value;
            if (idMascota) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', 'obtener_historias.php?id_mascota=' + idMascota, true);
                xhr.onload = function() {
                    if (this.status == 200) {
                        var historias = JSON.parse(this.responseText);
                        var selectHistoria = document.getElementById('id_historia');
                        selectHistoria.innerHTML = '<option value="">Seleccionar Historia Clínica</option>';
                        for (var i = 0; i < historias.length; i++) {
                            selectHistoria.innerHTML += '<option value="' + historias[i].id_historia + '">' + historias[i].descripcion + '</option>';
                        }
                    }
                };
                xhr.send();
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Eliminar Historia Clínica</h2>
        <form action="eliminar_historia.php" method="POST">
            <div class="form-group">
                <label for="id_usuario">Dueño de la Mascota:</label>
                <select name="id_usuario" id="id_usuario" required onchange="cargarMascotas()">
                    <option value="">Seleccionar Usuario</option>
                    <?php
                    while ($row = $resultUsuarios->fetch_assoc()) {
                        echo "<option value='".$row['IdUsuario']."'>".$row['Nombre_usuario']."</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="id_mascota">Mascota:</label>
                <select name="id_mascota" id="id_mascota" required onchange="cargarHistorias()">
                    <option value="">Seleccionar Mascota</option>
                </select>
            </div>

            <div class="form-group">
                <label for="id_historia">Historia Clínica:</label>
                <select name="id_historia" id="id_historia" required>
                    <option value="">Seleccionar Historia Clínica</option>
                </select>
            </div>

            <button type="submit">Eliminar Historia Clínica</button>
        </form>
    </div>
</body>
</html>

