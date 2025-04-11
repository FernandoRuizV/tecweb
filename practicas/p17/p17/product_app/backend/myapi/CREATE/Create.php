<?php
namespace MYAPI\Create;
require_once __DIR__ . '/../../vendor/autoload.php';
use MYAPI\DataBase;
 class Create extends DataBase {
     
    public function __construct($db) {
        parent:: __construct('root', 'Angueles.3',$db);
    }
    public function add($objeto){
        $this->data = array(
            'status'  => 'error',
            'message' => 'No añadido',
        );
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
                $this->data['status'] =  "success";
                $this->data['message'] =  "Producto agregado";
            } else {
                $this->data['message'] = "ERROR: No se ejecuto la consulta. " . mysqli_error($this->conexion);
            }
        } else {
            $this->data['message'] = "El producto ya existe.";
        }
    }
 }
 ?>