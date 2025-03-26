<?php
namespace TECWEB\MYAPI;
use TECWEB\MYAPI\DataBase as DataBase;
require_once __DIR__ . '/DataBase.php';

Class Products extends DataBase{
    private $data=NULL;

    public function __construct( $db, $user='root', $pass='Angueles.3') {
        $this->data = array();
        parent:: __construct($user, $pass, $db);
    }
    public function singleByName($name){
        $this->data = array(
            'status' => 'error',
            'message' => 'Producto no encontrado',
            'data' => []
        );
        if($name) {
            $sql = "SELECT * FROM productos WHERE nombre = '{$name}'";
            $result = mysqli_query($this->conexion, $sql);
    
            if (!$result) {
                die('QUERY FAILED');
            } else {
                if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $data = array(
                        'status' => 'success',
                        'message' => 'Producto encontrado',
                        'data' => array(
                            array(
                                'nombre' => $row['nombre'],
                                'marca' => $row['marca'],
                                'modelo' => $row['modelo'],
                                'precio' => $row['precio'],
                                'detalles' => $row['detalles'],
                                'unidades' => $row['unidades'],
                                'imagen' => $row['imagen'],
                                'id' => $row['id'],
                            )
                        )
                    );
                }
            }
            $this->conexion->close();
        }
    }
    public function getData(){
        $jsonData = json_encode($this->data, JSON_PRETTY_PRINT);
        return $jsonData;
    }

    public function add($objeto){
        $this->data = array(
            'status'  => 'error',
            'message' => 'No añadido',
        );
        $sql ="SELECT * FROM productos WHERE nombre = '{$objeto->nombre}' AND eliminado = 0";
        $result = $this->conexion->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);   
        if(is_null($rows)) {
            $this->conexion->set_charset("utf8");
            $sql = "INSERT INTO productos VALUES (null, '{$objeto->nombre}', '{$objeto->marca}', '{$objeto->modelo}', {$objeto->precio}, '{$objeto->detalles}', {$objeto->unidades}, '{$objeto->imagen}', 0)";
            if($this->conexion->query($sql)){
                $data['status'] =  "success";
                $data['message'] =  "Producto agregado";
            } else {
                $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
            }
        }
        $this->conexion->close();
    }
    public function delete($string){
        $this->data = array(
            'status'  => 'error',
            'message' => 'No eliminado',
        );
        $sql ="SELECT * FROM productos WHERE nombre = '{$string}' AND eliminado = 0";
        $result = $this->conexion->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        if(!is_null($rows)) {
            $sql = "UPDATE productos SET eliminado=1 WHERE nombre = {$string}";
            if ( $this->conexion->query($sql) ) {
                $data['status'] =  "success";
                $data['message'] =  "Producto eliminado";
            } else {
                $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($conexion);
            }
        }
        $this->conexion->close();
        
    }
    public function edit($objeto){
        $this->data = array(
            'status'  => 'error',
            'message' => 'No editado',
        );
        $sql ="SELECT * FROM productos WHERE id = '{$objeto->id}' AND eliminado = 0";
        $result = $this->conexion->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);   
        if(!is_null($rows)) {
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
                $data['status'] =  "success";
                $data['message'] =  "Producto editado";
            } else {
                $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
            }
        }
        $this->conexion->close(); 
    }
    public function list(){
        $this->data = array();
        if ( $result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0") ) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            if(!is_null($rows)) {
                foreach($rows as $num => $row) {
                    foreach($row as $key => $value) {
                        $data[$num][$key] = utf8_encode($value);
                    }
                }
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($this->conexion));
        }
        $this->conexion->close();
    }
    public function asignar($id){
        $this->data = array(
            'status' => 'error',
            'message' => 'Producto no encontrado',
            'data' => []
        );
        if($id) {
            $sql = "SELECT * FROM productos WHERE id = '{$id}'";
            $result = mysqli_query($this->conexion, $sql);
    
            if (!$result) {
                die('QUERY FAILED');
            } else {
                if ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                    $data = array(
                        'status' => 'success',
                        'message' => 'Producto encontrado',
                        'data' => array(
                            array(
                                'nombre' => $row['nombre'],
                                'marca' => $row['marca'],
                                'modelo' => $row['modelo'],
                                'precio' => $row['precio'],
                                'detalles' => $row['detalles'],
                                'unidades' => $row['unidades'],
                                'imagen' => $row['imagen'],
                                'id' => $row['id'],
                            )
                        )
                    );
                }
            }
            // Cerrar la conexión
            $this->conexion->close();
        }
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
                            $data[$num][$key] = utf8_encode($value);
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
    public function busq($name){
        if($name) {
            $sql = "SELECT * FROM productos WHERE nombre LIKE '%{$name}%'";
            if ( $result = $this->conexion->query($sql) ) {
                $rows = $result->fetch_all(MYSQLI_ASSOC);
                if(!is_null($rows)) {
                    foreach($rows as $num => $row) {
                        foreach($row as $key => $value) {
                            $data[$num][$key] = utf8_encode($value);
                        }
                    }
                    $this->data = array(
                        'error' => false,
                        'message' => 'Producto encontrado',
                        'data' => $data
                    );
                }else{
                    $this->data = array(
                        'error' => true,
                        'message' => 'Producto no encontrado',
                        'data' => []
                    );
                }
                $result->free();
            } 
            $this->conexion->close();
        }
    }
}
?>