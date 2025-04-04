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
    private $id=NULL;
    private $nom=NULL;
    private $mar=NULL;
    private $mod=NULL;
    private $pre=NULL;
    private $det=NULL;
    private $uni=NULL;
    private $ima=NULL;
    private $eli=NULL;

    public function __construct( $db,$obj=null,$user='root', $pass='Angueles.3') {
        if($obj!=null){
            $obj = (object)$obj;
            $this->id = isset($obj->id) ? $obj->id : null;
            $this->nom= $obj->nombre;
            $this->mar= $obj->marca;
            $this->mod= $obj->modelo;
            $this->pre= $obj->precio;
            $this->det= $obj->detalles;
            $this->uni= $obj->unidades;
            $this->ima= $obj->imagen;   
        }
        
        parent:: __construct($user, $pass, $db);
    }
    public function get_con(){
        return $this->conexion;
    }
    public function set_nom($nomb){
        $this->nom=$nomb;
    }
    public function set_mar($marc){
        $this->mar=$marc;
    }
    public function set_mod($mode){
        $this->mod=$mode;
    }
    public function set_pre($prec){
        $this->pre=$prec;
    }
    public function set_det($deta){
        $this->det=$deta;
    }
    public function set_uni($unid){
        $this->uni=$unid;
    }
    public function set_ima($imag){
        $this->ima=$imag;
    }
    public function set_eli($elim){
        $this->eli=$elim;
    }
    public function get_id(){
        return $this->id;
    }
    public function get_nom(){
        return $this->nom;
    }
    public function get_mar(){
        return $this->mar;
    }
    public function get_mod(){
        return $this->mod;
    }
    public function get_pre(){
        return $this->pre;
    }
    public function get_det(){
        return $this->det;
    }
    public function get_uni(){
        return $this->uni;
    }
    public function get_ima(){
        return $this->ima;
    }
    public function get_eli(){
        return $this->eli;
    }
   
}

?>