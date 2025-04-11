<?php

    require_once __DIR__ . '/vendor/autoload.php';
    use MYAPI\UPDATE\Update as Update;

    $prodObj = new Update('marketzone');
    $Producto = (object)$_POST;
    $prodObj->edit($Producto);
    echo $prodObj->getData(); 
?>
