<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();

    // SE VERIFICA HABER RECIBIDO ALGÚN PARÁMETRO
    if (isset($_POST['id']) || isset($_POST['nombre']) || isset($_POST['marca']) || isset($_POST['detalles'])) {
        // Obtener los valores de los parámetros y agregar el comodín "%" para el LIKE
        $id = isset($_POST['id']) ? $conexion->real_escape_string($_POST['id']) : '';
        $nombre = isset($_POST['nombre']) ? "%" . $conexion->real_escape_string($_POST['nombre']) . "%" : '';
        $marca = isset($_POST['marca']) ? "%" . $conexion->real_escape_string($_POST['marca']) . "%" : '';
        $detalles = isset($_POST['detalles']) ? "%" . $conexion->real_escape_string($_POST['detalles']) . "%" : '';

        // Construcción de la consulta de búsqueda
        $query = "SELECT * FROM productos WHERE 1=1";  // 1=1 es una forma de asegurar que siempre haya una condición

        // Agregar filtros según los parámetros recibidos
        if (!empty($id)) {
            $query .= " AND id='$id'";
        }
        if (!empty($nombre)) {
            $query .= " AND nombre LIKE '$nombre'";
        }
        if (!empty($marca)) {
            $query .= " AND marca LIKE '$marca'";
        }
        if (!empty($detalles)) {
            $query .= " AND detalles LIKE '$detalles'";
        }

        // Ejecutar la consulta
        if ($result = $conexion->query($query)) {
            // Verificamos si hay resultados
            while ($row = $result->fetch_assoc()) {
                // Agregar cada producto al arreglo de respuesta
                $data[] = $row;
            }
            // Liberar el resultado
            $result->free();
        } else {
            die('Query Error: ' . mysqli_error($conexion));
        }

        // Cerrar la conexión
        $conexion->close();
    }

    // Convertir el arreglo de datos a JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>
