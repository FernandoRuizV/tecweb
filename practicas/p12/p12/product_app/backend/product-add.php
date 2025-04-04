<?php
    
    use TECWEB\MYAPI\Create as Create;
    require_once __DIR__ . '/myapi/Create.php';
    
    $prodObj = new TECWEB\MYAPI\Create('marketzone');
    $Producto = (object)$_POST;
    $prodObj->add($Producto);
    echo $prodObj->getData(); 

?>