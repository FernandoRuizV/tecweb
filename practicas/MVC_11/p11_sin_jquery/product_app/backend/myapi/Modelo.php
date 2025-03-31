<?php
namespace TECWEB\MYAPI;
use TECWEB\MYAPI\DataBase as DataBase;
use TECWEB\MYAPI\View as View;
use TECWEB\MYAPI\Controler as Controler;
require_once __DIR__ . '/DataBase.php';
require_once __DIR__ . '/View.php';
require_once __DIR__ . '/Controler.php';

//Coordinaciones ->Final

Class Modelo extends DataBase{
    private $prod=NULL;

    public function __construct( $db, $user='root', $pass='Angueles.3') {
        $this->prod = array();
        parent:: __construct($user, $pass, $db);
    }
    
    public function add($objeto){
        if($objeto){
            $asig = new Controler();
            $msj = new View();


            $objeto= $asig->asignar($objeto);
    
            $nombre   = mysqli_real_escape_string($this->conexion, $objeto->nombre);
            $marca    = mysqli_real_escape_string($this->conexion, $objeto->marca);
            $modelo   = mysqli_real_escape_string($this->conexion, $objeto->modelo);
            $detalles = mysqli_real_escape_string($this->conexion, $objeto->detalles);
            $precio   = floatval($objeto->precio);
            $unidades = intval($objeto->unidades);
            $imagen   = mysqli_real_escape_string($this->conexion, $objeto->imagen);

            $sql ="SELECT * FROM productos WHERE nombre = '{$nombre}' AND eliminado = 0";
            $result = $this->conexion->query($sql);
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if(empty($rows)) {
                $sql = "INSERT INTO productos (id, nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) 
                    VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', 0)";
                if($this->conexion->query($sql)){
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
    public function delete($string){
        $msj = new View();
        
        $sql ="SELECT * FROM productos WHERE id = '{$string}' AND eliminado = 0";
        $result = $this->conexion->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        if(!empty($rows)) {
            $sql = "UPDATE productos SET eliminado=1 WHERE id = {$string}";
            /*if ( $this->conexion->query($sql) ) {
                
            } else {
                
            }*/
        }
        $this->conexion->close();
        
    }
    public function edit($objeto){
        $msj = new View();
        $asig = new Controler();
        $objeto= $asig->asignar($objeto);

        $sql ="SELECT * FROM productos WHERE id = '{$objeto->id}' AND eliminado = 0";
        $result = $this->conexion->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);   
        if(!empty($rows)) {
            $this->conexion->set_charset("utf8");
            $sql = "UPDATE productos 
            SET nombre = '{$objeto->nombre}', 
                marca = '{$objeto->marca}', 
                modelo = '{$objeto->modelo}',
                precio = '{$objeto->precio}', 
                detalles = '{$objeto->detalles}', 
                unidades = '{$objeto->unidades}', 
                imagen = '{$objeto->imagen}'
            WHERE id = '{$objeto->id}'";

            if($this->conexion->query($sql)){
                $msj->edi_exi();
                echo $msj->getData();
            } else {
                $msj->edi_fal();
                echo $msj->getData();
            }
        }
        $this->conexion->close(); 
    }
    public function extraer($id){
        $msj = new View();
        $asig = new Controler();
        if($id) {
            $sql = "SELECT * FROM productos WHERE id = '{$id}'";
            $result = mysqli_query($this->conexion, $sql);
    
            if (!$result) {
                $msj->ext_fal();
                echo $msj->getData();
            } else {
                if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $asig->extraer($row);
                    $msj->ext_exi();
                    echo $msj->getData();  
                
                }
            }
            $this->conexion->close();
        }
        
    }
    public function list(){
        
    }
    
    public function search($search){
        
    }
    public function busq($name){
        
        }
}

?>