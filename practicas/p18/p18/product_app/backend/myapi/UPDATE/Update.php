<?php
namespace MYAPI\Update;
require_once __DIR__ . '/../../vendor/autoload.php';
use MYAPI\DataBase;
 class Update extends DataBase {
     
    public function __construct($db) {
        parent:: __construct('root', 'Angueles.3',$db);
    }
    public function edit($objeto){
        $this->data = array(
            'status'  => 'error',
            'message' => 'No editado',
        );
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
                $this->data['status'] =  "success";
                $this->data['message'] =  "Producto editado";
            } else {
                $this->data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
            }
        }
        $this->conexion->close(); 
    }
    
 }
 ?>