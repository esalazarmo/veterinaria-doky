<?php
// Configuración de la conexión
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dokibase"; 

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar veterinarios
$veterinarios = $conn->query("SELECT id_veterinario, nombre_veterinario, especialidad FROM VETERINARIO");

// Consultar estilistas
$estilistas = $conn->query("SELECT id_estilista, nombre_estilista, especialidad FROM ESTILISTA");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinaria Doky - Agendar Cita</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@latest/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
    <link rel="stylesheet" href="stile.css">
    <style>
        /* Estilos para el modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
            padding: 20px;
            box-sizing: border-box;
        }
        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            width: 400px;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Encabezado -->
    <div class="header bg-light p-3 mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="logo d-flex align-items-center">
                <img alt="Logo" height="40" src="https://i.ibb.co/JcFc0Lv/Imagen-de-Whats-App-2024-10-10-a-las-15-35-43-a45846db-removebg-preview.png" width="40" />
                <h1 class="ms-2 mb-0">Doki</h1>
            </div>
            <nav class="nav">
                <a href="Inicio.html" class="nav-link">Inicio</a>
                <a href="historiac.html" class="nav-link">Historial médico</a>
                <a href="producto.php" class="nav-link">Productos</a>
                <a href="calificacion.html" class="nav-link">Calificación</a>
                <a href="cita.php" class="nav-link active">Agendar Cita</a>
                <a href="Membresia.html" class="nav-link">Membresía</a>
                <a href="reguser.html" class="nav-link">Regístrate</a>
            </nav>
        </div>
    </div>

    <!-- Contenido Principal -->
    <main class="container">
        <div class="card shadow-sm p-4">
            <h3 class="card-title mb-4">Agendar Cita</h3>
            <form action="guardar_cita.php" method="POST">
                <div class="row">
                    <!-- Columna Izquierda -->
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label for="tipo_servicio" class="form-label">Especialidad:</label>
                            <select id="tipo_servicio" name="tipo_servicio" class="form-select" required>
                                <option value="desparasitacion">Desparasitación</option>
                                <option value="vacunacion">Vacunación</option>
                                <option value="consulta">Consulta General</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="hora" class="form-label">Hora:</label>
                            <input type="time" id="hora" name="hora" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label for="tipo_mascota" class="form-label">Tipo de Mascota:</label>
                            <select id="tipo_mascota" name="tipo_mascota" class="form-select" required>
                                <option value="perro">Perro</option>
                                <option value="gato">Gato</option>
                                <option value="ave">Ave</option>
                            </select>
                        </div>
                        
                    </div>
                    <!-- Columna Derecha -->
                    <div class="col-md-6">
                        <div class="mb-4">
                            <label for="fecha_cita" class="form-label">Fecha:</label>
                            <input type="date" id="fecha_cita" name="fecha_cita" class="form-control" required>
                        </div>
                        <div class="mb-4">
                            <label for="veterinario" class="form-label">Seleccionar Veterinario:</label>
                            <select id="veterinario" name="veterinario" class="form-select" required>
                                <option value="">-- Selecciona un Veterinario --</option>
                                <?php while ($vet = $veterinarios->fetch_assoc()): ?>
                                    <option value="<?= $vet['id_veterinario'] ?>">
                                        <?= $vet['nombre_veterinario'] ?> - <?= $vet['especialidad'] ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="estilista" class="form-label">Seleccionar Estilista:</label>
                            <select id="estilista" name="estilista" class="form-select">
                                <option value="">-- Selecciona un Estilista --</option>
                                <?php while ($est = $estilistas->fetch_assoc()): ?>
                                    <option value="<?= $est['id_estilista'] ?>">
                                        <?= $est['nombre_estilista'] ?> - <?= $est['especialidad'] ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="correo" class="form-label">Correo Electrónico:</label>
                            <input type="email" id="correo" name="correo" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-4">Reservar</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <script>
        function showModal() {
            document.getElementById('loginModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('loginModal').style.display = 'none';
        }
    </script>
</body>
</html>  

