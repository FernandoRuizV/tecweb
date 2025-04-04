<?php
namespace MYAPI\Read;

require_once __DIR__ . '/../../vendor/autoload.php';
use MYAPI\DataBase;
 class Read extends DataBase{
     
    public function __construct($db) {
        parent:: __construct('root', 'Angueles.3',$db);
    }

    public function list(){
        $this->data = array();
        if ( $result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0") ) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if(!is_null($rows)) {
                foreach($rows as $num => $row) {
                    foreach($row as $key => $value) {
                        $this->data[$num][$key] = utf8_encode($value);
                    }
                }
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($this->conexion));
        }
        $this->conexion->close();
    }
    public function search($search){
        $this->data = array();
        if($search) {
            $sql = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '$search%' OR marca LIKE '$search%' OR detalles LIKE '$search%') AND eliminado = 0";
            if ( $result = $this->conexion->query($sql) ) {
                $rows = $result->fetch_all(MYSQLI_ASSOC);
    
                if(!is_null($rows)) {

                    foreach($rows as $num => $row) {
                        foreach($row as $key => $value) {
                            $this->data[$num][$key] = utf8_encode($value);
                        }
                    }
       
                }
                $result->free();
            } else {
                die('Query Error: '.mysqli_error($conexion));
            }
            $this->conexion->close();
        } 
    }
    public function single($name){
        if($name) {
            $sql = "SELECT * FROM productos WHERE nombre LIKE '%{$name}%'";
            if ( $result = $this->conexion->query($sql) ) {
                $rows = $result->fetch_all(MYSQLI_ASSOC);
                if(!empty($rows)) 
                    $data= array();
                    foreach($rows as $num => $row) {
                        foreach($row as $key => $value) {
                            $this->data[$num][$key] = utf8_encode($value);
                        }
                    }
                }else{
                    $this->data = array(
                        'error' => true,
                        'message' => 'Producto no encontrado',
                        'data' => []
                    );
                }
                $result->free();
            }else{
                $this->data = array(
                    'error'   => true,
                    'message' => 'Error en la consulta: ' . mysqli_error($this->conexion),
                    'data'    => []
                );
            }
            $this->conexion->close();
        }
 }
 ?>