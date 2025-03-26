<?php
require_once __DIR__ . '/DataBase.php';

Class Products extends DataBase{
    private $data;

    public function __construct($a,$b= 'root',$c='Angueles.3'){
        $db= new DataBase($a,$b,$c);
        $this->data=[];    
    }
    public function singleByName($name){
        $this->data = array(
            'status'  => 'error',
            'message' => 'No encontrado',
            'result'  => []
        );
        $sql ="SELECT * FROM productos WHERE nombre = '{$name->nombre}' AND eliminado = 0";
        $result = $this->conexion->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);   
        if(!is_null($rows)) {
            foreach($rows as $num => $row) {
                foreach($row as $key => $value) {
                    $data[$num][$key] = utf8_encode($value);
                }
            }
            $data['status'] =  "success";
            $data['message'] =  "Encontrado";
            $data['result'] =  $rows;
        }
        $this->conexion->close();
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
        $sql ="SELECT * FROM productos WHERE nombre = '{$objeto['nombre']->nombre}' AND eliminado = 0";
        $result = $this->conexion->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);   
        if(is_null($rows)) {
            $this->conexion->set_charset("utf8");
            $sql = "INSERT INTO productos VALUES (null, '{$objeto['nombre']->nombre}', '{$objeto['marca']->marca}', '{$objeto['modelo']->modelo}', {$objeto['precio']->precio}, '{$objeto['detalles']->detalles}', {$objeto['unidades']->unidades}, '{$objeto['imagen']->imagen}', 0)";
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
        $sql ="SELECT * FROM productos WHERE nombre = '{$string->nombre}' AND eliminado = 0";
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
        $sql ="SELECT * FROM productos WHERE id = '{$objeto['id']->id}' AND eliminado = 0";
        $result = $this->conexion->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);   
        if(!is_null($rows)) {
            $this->conexion->set_charset("utf8");
            $sql = "UPDATE productos 
            SET nombre = '{$objeto['nombre']}', 
                marca = '{$objeto['marca']}', 
                modelo = '{$objeto['modelo']}',
                precio = '{$objeto['precio']}', 
                detalles = '{$objeto['detalles']}', 
                unidades = '{$objeto['unidades']}', 
                imagen = '{$objeto['imagen']}'
            WHERE id = '{$objeto['id']}'";

            if($this->conexion->query($sql)){
                $data['status'] =  "success";
                $data['message'] =  "Producto editado";
            } else {
                $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
            }
        }
        $this->conexion->close(); 
    }
}
?>