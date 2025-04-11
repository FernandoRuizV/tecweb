<?php
    
    require_once __DIR__ . '/vendor/autoload.php';
    use MYAPI\CREATE\Create as Create;
    
    $prodObj = new Create('marketzone');
    $Producto = (object)$_POST;
    $prodObj->add($Producto);
    echo $prodObj->getData(); 

?>