<?php
session_start();

// Verificar si la sesión del carrito está inicializada
if (empty($_SESSION['cart'])) {
    echo "No hay productos en el carrito.";
    exit;
}

// Procesar la solicitud de quitar un producto
if (isset($_GET['remove_from_cart'])) {
    $idProducto = $_GET['remove_from_cart'];
    // Eliminar el producto del carrito
    if (($key = array_search($idProducto, $_SESSION['cart'])) !== false) {
        unset($_SESSION['cart'][$key]);
    }
}

// Conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$clave = ""; 
$bd = "dokibase";

// Crear conexión
$conn = new mysqli($servidor, $usuario, $clave, $bd);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar detalles de productos en el carrito
$ids = implode(",", $_SESSION['cart']);
$sql = "SELECT * FROM PRODUCTO WHERE id_producto IN ($ids)";
$resultado = $conn->query($sql);

$conn->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Carrito de Compras</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="productos.css"/>
</head>
<body>
    <div class="header">
        <div class="logo">
            <img alt="Logo" height="30" src="https://i.ibb.co/JcFc0Lv/Imagen-de-Whats-App-2024-10-10-a-las-15-35-43-a45846db-removebg-preview.png" width="30"/>
            <span>Doki</span>
        </div>
        <div class="nav">
            <a href="Inicio.html" class="nav-link">Inicio</a>
            <a href="historiac.html" class="nav-link">Historial médico</a>
            <a href="producto.php" class="nav-link">Productos</a>
            <a href="calificacion.html" class="nav-link">Calificación</a>
            <a href="cita.html" class="nav-link">Agendar Cita</a>
            <a href="Membresia.html">Membresía</a>
            <a href="reguser.html">Regístrate</a>
        </div>
    </div>
    <div class="container">
        <h1>Carrito de Compras</h1>
        <div class="product-list">
            <?php
            if ($resultado->num_rows > 0) {
                while ($producto = $resultado->fetch_assoc()) {
                    $imagenPath = 'img_prod/pro-' . $producto['id_producto'] . '.jpg'; // Ruta de la imagen
                    echo '<div class="product">';
                    echo '<img alt="' . htmlspecialchars($producto['nombre_producto']) . '" height="150" src="' . htmlspecialchars($imagenPath) . '" width="150"/>';

                    // Mostrando campos que existen en la tabla
                    if (isset($producto['precio'])) {
                        echo '<div class="price">S/.' . number_format($producto['precio'], 2) . '</div>';
                    }
                    if (isset($producto['descripcion'])) {
                        echo '<div class="description">' . htmlspecialchars($producto['descripcion']) . '</div>';
                    }
                    echo '<a href="?remove_from_cart=' . $producto['id_producto'] . '" class="remove-from-cart">- Quitar</a>';
                    echo '</div>';
                }
            } else {
                echo "No hay productos en el carrito.";
            }
            ?>
        </div>
    </div>
</body>
</html>
