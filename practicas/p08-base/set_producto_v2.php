<?php
/** SE CREA EL OBJETO DE CONEXION */
@$link = new mysqli('localhost', 'root', 'Angueles.3', 'marketzone');	

/** comprobar la conexión */
if ($link->connect_errno) 
{
    die('Falló la conexión: '.$link->connect_error.'<br/>');
    /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
}

$nombre = $_POST['nombre'];
$marca  = $_POST['marca']; 
$modelo = $_POST['modelo']; 
$precio = $_POST['precio']; 
$detalles = $_POST['detalles']; 
$unidades = $_POST['unidades']; 
$imagen   = $_POST['imagen']; 
$eliminado   = $_POST['eliminado']; 
/** Crear una tabla que no devuelve un conjunto de resultados */
$sql_verificar = "SELECT COUNT(*) AS total FROM productos WHERE nombre = '{$nombre}' AND marca = '{$marca}' AND modelo = '{$modelo}'";
$resultado = mysqli_query($link, $sql_verificar);

if ($resultado) 
{
    list($total) = mysqli_fetch_row($resultado);
    if ($total > 0) {
        $sql_actualizar = "UPDATE productos 
                            SET precio = '{$precio}', 
                               detalles = '{$detalles}', 
                               unidades = '{$unidades}', 
                               imagen = '{$imagen}', 
                               eliminado = '{$eliminado}'
                           WHERE nombre = '{$nombre}' 
                             AND marca = '{$marca}' 
                             AND modelo = '{$modelo}'";
    
        if (mysqli_query($link, $sql_actualizar)) {
            echo "Producto actualizado con éxito.";
        } else {
            echo "Error al actualizar el producto: " . mysqli_error($link);
        }
    } else {
        $sql_insertar = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado)
                         VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', '{$eliminado}')";
    
        if (mysqli_query($link, $sql_insertar)) {
            echo "Registro exitoso.";
        } else {
            echo "Error al registrar el producto: " . mysqli_error($link);
        }
    }
}
    
$link->close();
?>