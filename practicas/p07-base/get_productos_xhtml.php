<?php
// Enviar encabezado correcto para XHTML
header("Content-Type: application/xhtml+xml; charset=UTF-8");

// Verificar si se recibió el parámetro "tope"
if (!isset($_GET['tope'])) {
    die('<p style="color: red; text-align: center;">Parámetro "tope" no detectado...</p>');
}

$tope = intval($_GET['tope']); // Convertir a entero para evitar SQL Injection
$productos = [];

// Conectar a la base de datos
@$link = new mysqli('localhost', 'root', 'Angueles.3', 'marketzone');

// Comprobar conexión
if ($link->connect_errno) {
    die('<p style="color: red; text-align: center;">Error en la conexión: ' . htmlspecialchars($link->connect_error) . '</p>');
}

// Ejecutar consulta
if ($result = $link->query("SELECT * FROM productos WHERE unidades <= $tope")) {
    $productos = $result->fetch_all(MYSQLI_ASSOC);
    $result->free();
}
$link->close();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Lista de Productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
        crossorigin="anonymous" />
</head>
<body>
    <h3 style="text-align: center;">Productos</h3>
    <br />

    <?php if (count($productos) > 0): ?>
        <table class="table table-bordered" style="width: 90%; margin: auto;">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Unidades</th>
                    <th scope="col">Detalles</th>
                    <th scope="col">Imagen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <th scope="row"><?= htmlspecialchars($producto['id']) ?></th>
                        <td><?= htmlspecialchars($producto['nombre']) ?></td>
                        <td><?= htmlspecialchars($producto['marca']) ?></td>
                        <td><?= htmlspecialchars($producto['modelo']) ?></td>
                        <td><?= htmlspecialchars($producto['precio']) ?></td>
                        <td><?= htmlspecialchars($producto['unidades']) ?></td>
                        <td><?= htmlspecialchars($producto['detalles']) ?></td>
                        <td><img src="<?= htmlspecialchars($producto['imagen']) ?>" alt="Imagen" style="width: 100px; height: auto;" /></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="color: red; text-align: center;">No hay productos con unidades menores o iguales a <?= $tope ?>.</p>
    <?php endif; ?>
</body>
</html>

