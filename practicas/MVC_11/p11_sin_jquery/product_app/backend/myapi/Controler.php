<?php
namespace TECWEB\MYAPI;
use TECWEB\MYAPI\Modelo as Modelo;
require_once __DIR__ . '/Modelo.php';


//ASIGNACIONES ->Solo recopilar valores

Class Controler{
    private $info=NULL;

    public function asignar($obj){
        $Producto = (object)$obj;
        return $Producto;
    }
    public function extraer($array){
        $arr = array(
            'nombre' => $array['nombre'],
            'marca' => $array['marca'],
            'modelo' => $array['modelo'],
            'precio' => $array['precio'],
            'detalles' => $array['detalles'],
            'unidades' => $array['unidades'],
            'imagen' => $array['imagen'],
            'id' => $array['id'],
        );
        return json_encode($arr);
    }
}

?>