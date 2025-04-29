<?php
namespace MYAPI\Delete;
require_once __DIR__ . '/../../vendor/autoload.php';
use MYAPI\DataBase;
 class Delete extends DataBase{
     
    public function __construct($db) {
        parent:: __construct('root', 'Angueles.3',$db);
    }

    public function delete($string){
        $conexion= $this->conexion;
        $this->data = array(
            'status'  => 'error',
            'message' => 'No eliminado',
        );
        $sql ="SELECT * FROM productos WHERE id = '{$string}' AND eliminado = 0";
        $result = $conexion->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        
        if(!empty($rows)) {
            $sql = "UPDATE productos SET eliminado=1 WHERE id = {$string}";
            if ( $conexion->query($sql) ) {
                $this->data['status'] =  "success";
                $this->data['message'] =  "Producto eliminado";
            } else {
                $this->data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($conexion);
            }
        }
        $conexion->close();
        
    }
}
 ?>