<?php
/** SE CREA EL OBJETO DE CONEXION */
@$link = new mysqli('localhost', 'root', 'Angueles.3', 'marketzone');	

/** comprobar la conexión */
if ($link->connect_errno) 
{
    die('Falló la conexión: '.$link->connect_error.'<br/>');
    /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
}

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$marca  = $_POST['marca']; 
$modelo = $_POST['modelo']; 
$precio = $_POST['precio']; 
$detalles = $_POST['detalles']; 
$unidades = $_POST['unidades']; 
$imagen   = $_POST['imagen']; 
$eliminado   = $_POST['eliminado']; 


$sql_actualizar = "UPDATE productos 
                    SET nombre = '{$nombre}', 
                        marca = '{$marca}', 
                        modelo = '{$modelo}',
                        precio = '{$precio}', 
                        detalles = '{$detalles}', 
                        unidades = '{$unidades}', 
                        imagen = '{$imagen}', 
                        eliminado = '{$eliminado}'
                         
                    WHERE id = '{$id}'";

if (mysqli_query($link, $sql_actualizar)) {
    echo "Producto actualizado con éxito.";
} else {
    echo "Error al actualizar el producto: " . mysqli_error($link);
}

$link->close();
?>
