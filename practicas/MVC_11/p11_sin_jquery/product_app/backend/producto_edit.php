<?php

    use TECWEB\MYAPI\Modelo as Modelo;
    use TECWEB\MYAPI\Controler as Controler;
    require_once __DIR__ . '/myapi/Modelo.php';
   
    $prodObj = new TECWEB\MYAPI\Modelo('marketzone',$_POST);
    $prod = new TECWEB\MYAPI\Controler();
    $prod->edit($prodObj);

?>
