<?php
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

// Obtener el término de búsqueda, si existe
$busqueda = isset($_GET['search']) ? $_GET['search'] : '';

// Consulta para obtener los productos (con filtro de búsqueda si se proporciona)
$sql = "SELECT * FROM PRODUCTO";
if ($busqueda) {
    $sql .= " WHERE nombre_producto LIKE '%" . $conn->real_escape_string($busqueda) . "%'";
}

$resultado = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Lista de Productos</title>
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
        <!-- Formulario de búsqueda -->
        <form method="GET" action="producto.php" class="search-form">
            <input type="text" name="search" placeholder="Buscar productos..." value="<?php echo htmlspecialchars($busqueda); ?>" />
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
        <div class="section-title">Delicioso alimento</div>
        <div class="section-subtitle">Envío en horas</div>


        <!-- Lista de productos -->
        <div class="product-list">
            <?php
            // Verificar si hay productos
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
                    if (isset($producto['disponibilidad'])) {
                        $disponibilidad = $producto['disponibilidad'] ? 'Disponible' : 'No Disponible';
                        echo '<div class="availability">' . htmlspecialchars($disponibilidad) . '</div>';
                    }

                    echo "<a href='det_productos.php?id=" . $producto['id_producto'] . "'>Ver detalles</a>";
                    echo '<button class="add-to-cart">+ Agregar</button>';
                    echo '</div>';
                }
            } else {
                echo "No se encontraron productos.";
            }

            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
