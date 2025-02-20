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
$eliminado= 0;
/** Crear una tabla que no devuelve un conjunto de resultados */
$sql_verificar = "SELECT COUNT(*) AS total FROM productos WHERE nombre = '{$nombre}' AND marca = '{$marca}' AND modelo = '{$modelo}'";
$resultado = mysqli_query($link, $sql_verificar);

if ($resultado) 
{
    list($total) = mysqli_fetch_row($resultado);
    if($total>0)
    {
        echo "SU REGISTRO YA SE ENCUENTRA EN EL SISTEMA  ". $total."VECES";
    }else{
        $sql_insertar = "INSERT INTO productos VALUES (null,'{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', {$eliminado})";
        if (mysqli_query($link, $sql_insertar)) 
        {
            echo "Registro exitoso <br>";
            echo "Valores insertados <br>".$sql_insertar;
        } else {
            echo "Error al registrar el producto: " . mysqli_error($link);
        }
}
} else {
    echo "Error en la consulta: " . mysqli_error($link);
}

$link->close();
?>