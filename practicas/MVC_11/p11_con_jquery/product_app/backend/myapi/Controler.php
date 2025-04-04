<?php
namespace TECWEB\MYAPI;
use TECWEB\MYAPI\Modelo as Modelo;
require_once __DIR__ . '/Modelo.php';


//ASIGNACIONES ->Solo recopilar valores

Class Controler{
    private $info=NULL;

    public function add($objeto){
        if($objeto){
            $conexion = $objeto->get_con();
            $msj = new View();

            $nombre   = $conexion->real_escape_string($objeto->get_nom());
            $marca    = $conexion->real_escape_string($objeto->get_mar());
            $modelo   = $conexion->real_escape_string($objeto->get_mod());
            $detalles = $conexion->real_escape_string($objeto->get_det());
            $precio   = floatval($objeto->get_pre());
            $unidades = intval($objeto->get_uni());
            $imagen   = $conexion->real_escape_string($objeto->get_ima());


            $sql ="SELECT * FROM productos WHERE nombre = '{$nombre}' AND eliminado = 0";
            $result = $conexion->query($sql);
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if(empty($rows)) {
                $sql = "INSERT INTO productos (id, nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) 
                    VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', 0)";
                if($conexion->query($sql)){
                    $msj->ins_exi();
                    echo $msj->getData();
                } else {
                    $msj->ins_fal();
                    echo $msj->getData();
                }
            } else {
                $msj->ins_ine();
                echo $msj->getData();
            }
        }
        
    }
    public function delete($string,$obj){
        $msj = new View();
        $conexion= $obj->get_con();
        $sql ="SELECT * FROM productos WHERE id = '{$string}' AND eliminado = 0";
        $result = $conexion->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        
        if(!empty($rows)) {
            $sql = "UPDATE productos SET eliminado=1 WHERE id = {$string}";
            if ( $conexion->query($sql) ) {
                $msj->eli_exi();
                echo $msj->getData();
            } else {
                $msj->eli_fal();
                echo $msj->getData();
            }
        }
        $conexion->close();
        
    }
    public function edit($objeto){
        $msj = new View();
        $conexion= $objeto->get_con();

        $sql ="SELECT * FROM productos WHERE id = '{$objeto->get_id()}' AND eliminado = 0";
        $result = $conexion->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);   
        if(!empty($rows)) {
            $conexion->set_charset("utf8");
            $sql = "UPDATE productos 
            SET nombre = '{$objeto->get_nom()}', 
                marca = '{$objeto->get_mar()}', 
                modelo = '{$objeto->get_mod()}',
                precio = '{$objeto->get_pre()}', 
                detalles = '{$objeto->get_det()}', 
                unidades = '{$objeto->get_uni()}', 
                imagen = '{$objeto->get_ima()}'
            WHERE id = '{$objeto->get_id()}'";
            
            if($conexion->query($sql)){
                $msj->edi_exi();
            } else {
                $msj->edi_fal();
            }
            echo $msj->getData();
        }else{
            $msj->edi_ine();
            echo $msj->getData();
        }
        $conexion->close(); 
    }
    public function extraer($id,$obj){
        $msj = new View();
        $conexion= $obj->get_con();
        $asig= new Controler();
        if($id) {
            $sql = "SELECT * FROM productos WHERE id = '{$id}'";
            $result = mysqli_query($conexion, $sql);
    
            if (!$result) {
                $msj->ext_fal();
                echo $msj->getData();
            } else {
                if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    echo $asig->extra($row); 
                }
            }
            $conexion->close();
        }
        
    }
    public function list($obj){
        $msj = new View();
        $dat= [];
        $conexion= $obj->get_con();

        if ($result = $conexion->query("SELECT * FROM productos WHERE eliminado = 0")) {
            $dat = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
        } else {
            die('Query Error: ' . $conexion->error);
        }
    
        $conexion->close();
        $msj->set_data($dat);
        echo $msj->get_data();
    }
    public function extra($array){
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
        $jsonData = json_encode($arr, JSON_PRETTY_PRINT);
        return $jsonData;
    }
    public function search($search, $obj){
        $msj = new View();
        $dat= [];
        $conexion= $obj->get_con();
        if ($result = $conexion->query("SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '$search%' OR marca LIKE '$search%' OR detalles LIKE '$search%') AND eliminado = 0")) {
            $dat = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
        } else {
            die('Query Error: ' . $conexion->error);
        }
        
        $conexion->close();
        $msj->set_data($dat);
        echo $msj->get_data();  
    }
    public function busq($name, $obj) {
        $msj = new View();
        $dat = [];
        $conexion = $obj->get_con();
    
        if ($name) {
            $sql = "SELECT * FROM productos WHERE nombre LIKE ?";
            $stmt = $conexion->prepare($sql);
    
            if (!$stmt) {
                $msj->sear_err();
                echo $msj->get_data();
                return;
            }
    
            $searchParam = "%{$name}%";
            $stmt->bind_param("s", $searchParam);
            $stmt->execute();
            $result = $stmt->get_result();
            $rows = $result->fetch_all(MYSQLI_ASSOC);
    
            if (!empty($rows)) {
                $dat = $rows;
            } else {
                $msj->edi_ine();
            }
    
            $stmt->close();
        }
    
        $conexion->close();
        $msj->set_data($dat);
        echo $msj->get_data();
    }
    
}

?>