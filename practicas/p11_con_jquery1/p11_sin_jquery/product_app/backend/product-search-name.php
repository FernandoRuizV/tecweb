<?php
    /*include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();
    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_GET['name']) ) {
        $name = $_GET['name'];
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        $sql = "SELECT * FROM productos WHERE nombre LIKE '%{$name}%'";
        if ( $result = $conexion->query($sql) ) {
            // SE OBTIENEN LOS RESULTADOS
			$rows = $result->fetch_all(MYSQLI_ASSOC);

            if(!is_null($rows)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($rows as $num => $row) {
                    foreach($row as $key => $value) {
                        $data[$num][$key] = utf8_encode($value);
                    }
                }
            }
			$result->free();
		} else {
            echo json_encode(array("error" => "Query Error: " . mysqli_error($conexion)));
            $conexion->close();
            exit;
        }
		$conexion->close();
    } else {
        // Si no se recibe 'name', devolver un mensaje de error en formato JSON
        echo json_encode(array("error" => "No 'name' parameter provided"));
        exit;
    }
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);*/
    use TECWEB\MYAPI\Products as Products;
    require_once __DIR__ . '/myapi/Products.php';
    
    $prodObj = new TECWEB\MYAPI\Products('marketzone');

    $name = ($_GET['name']);
    $prodObj->busq($name);
    echo $prodObj->getData(); ;
?>