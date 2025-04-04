<?php

use TECWEB\MYAPI\Update as Update;
require_once __DIR__ . '/myapi/Update.php';

    $prodObj = new TECWEB\MYAPI\Update('marketzone');
    $Producto = (object)$_POST;
    $prodObj->edit($Producto);
    echo $prodObj->getData(); 
?>
