<?php
abstract Class DataBase{
    protected $conexion;

    public function __construct($db,$user,$pass){
        $this->conexion= new mysqli('localhost',$user,$pass,$db); 
    }
}
?>