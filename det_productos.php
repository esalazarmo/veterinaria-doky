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
    echo "<script>alert('Producto no encontrado.'); window.location.href='producto.php';</script>";
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
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }
        h2 {
            color: #007BFF;
        }
        p {
            line-height: 1.6;
            color: #555;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 15px;
            background: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }
        a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Detalles del Producto</h1>
    <div class="container">
        <?php
        $imagenPath = "img_prod/pro-" . $producto['id_producto'] . ".jpg";
        echo "<img src='$imagenPath' alt='Imagen del producto'>";
        echo "<h2>" . htmlspecialchars($producto['nombre_producto']) . "</h2>";
        echo "<p><strong>Descripción:</strong> " . htmlspecialchars($producto['descripcion']) . "</p>";
        echo "<p><strong>Precio:</strong> S/." . number_format($producto['precio'], 2) . "</p>";
        echo "<p><strong>Disponibilidad:</strong> " . ($producto['disponibilidad'] ? "Disponible" : "No Disponible") . "</p>";
        ?>
        <a href="producto.php">Volver a la lista de productos</a>
    </div>
</body>
</html>