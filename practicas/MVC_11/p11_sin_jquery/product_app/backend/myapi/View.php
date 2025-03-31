<?php
namespace TECWEB\MYAPI;
use TECWEB\MYAPI\Modelo as Modelo;
require_once __DIR__ . '/Modelo.php';

//Vistas ->Solo devuelve mensajes

Class View{
    private $data=NULL;

    public function __construct() {
        $this->data = array(
            'status' => 'error',
            'message' => 'Hubo un error al procesar',
        );
    }
    public function getData(){
        $jsonData = json_encode($this->data, JSON_PRETTY_PRINT);
        return $jsonData;
    }
    public function ins_exi(){
        $this->data['status'] =  "success";
        $this->data['message'] =  "Producto agregado";
    }
    public function ins_fal(){
        $this->data['status'] =  "error";
        $this->data['message'] =  "Producto no agregado";
    }
    public function ins_ine(){
        $this->data['status'] =  "error";
        $this->data['message'] =  "Producto ya existente";
    }
    public function edi_exi(){
        $this->data['status'] =  "success";
        $this->data['message'] =  "Producto agregado correctamente";
    }
    public function edi_fal(){
        $this->data['status'] =  "error";
        $this->data['message'] =  "Producto no editado";
    }
    public function ext_exi(){
        $this->data['status'] =  "success";
        $this->data['message'] =  "Producto extraido correctamente";
    }
    public function ext_fal(){
        $this->data['status'] =  "error";
        $this->data['message'] =  "Producto no extraido";
    }
}

?>