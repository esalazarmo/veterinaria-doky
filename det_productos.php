<?php
// Conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$clave = "";
$bd = "dokibase";

$conn = new mysqli($servidor, $usuario, $clave, $bd);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener ID del producto
$id_producto = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM PRODUCTO WHERE id_producto = $id_producto";
$resultado = $conn->query($sql);

if ($resultado->num_rows > 0) {
    $producto = $resultado->fetch_assoc();
} else {
    echo "Producto no encontrado.";
    exit();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Producto</title>
</head>
<body>
    <h1>Detalles del Producto</h1>
    <div>
        <?php
        $imagenPath = "img_prod/pro-" . $producto['id_producto'] . ".jpg";
        echo "<img src='$imagenPath' alt='Imagen del producto' width='200'>";
        echo "<h2>" . htmlspecialchars($producto['nombre_producto']) . "</h2>";
        echo "<p>Descripción: " . htmlspecialchars($producto['descripcion']) . "</p>";
        echo "<p>Precio: S/." . number_format($producto['precio'], 2) . "</p>";
        echo "<p>Disponibilidad: " . ($producto['disponibilidad'] ? "Disponible" : "No Disponible") . "</p>";
        ?>
    </div>
    <a href="producto.php">Volver a la lista de productos</a>
</body>
</html>
