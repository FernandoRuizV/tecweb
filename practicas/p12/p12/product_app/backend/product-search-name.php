<?php
    
    use TECWEB\MYAPI\Read as Read;
    require_once __DIR__ . '/myapi/Read.php';
    
    $prodObj = new TECWEB\MYAPI\Read('marketzone');

    $name = ($_GET['name']);
    $prodObj->single($name);
    echo $prodObj->getData(); ;
?>