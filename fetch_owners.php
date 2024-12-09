<?php
$conexion = new mysqli("localhost", "root", "", "dokibase");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$search = isset($_GET['search']) ? $conexion->real_escape_string($_GET['search']) : '';

$query = "SELECT IdUsuario, Nombre_usuario, Correo_electronico, Telefono 
          FROM USUARIO 
          WHERE Nombre_usuario LIKE '%$search%' OR Correo_electronico LIKE '%$search%'";

$result = $conexion->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['IdUsuario']}</td>
                <td>{$row['Nombre_usuario']}</td>
                <td>{$row['Correo_electronico']}</td>
                <td>{$row['Telefono']}</td>
                <td><button onclick='openModal({$row['IdUsuario']})'>Ver Detalles</button></td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No se encontraron resultados.</td></tr>";
}

$conexion->close();
?>
