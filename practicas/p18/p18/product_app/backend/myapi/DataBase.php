<?php
 namespace MYAPI;
 abstract class DataBase {
     
     protected $conexion;
     protected $data;
     
     public function __construct($user, $pass, $db) {
        $this->conexion = @mysqli_connect(
            'localhost', 
            $user, 
            $pass, 
            $db
         );
        if (!$this->conexion) {   
             die('¡Base de datos no encontrada!') ;
          }
        $this->data= [];
    }

    public function getData(){
        $jsonData = json_encode($this->data, JSON_PRETTY_PRINT);
        return $jsonData;
    }

         
 }
 ?>