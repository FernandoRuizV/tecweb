<?php
    
    use TECWEB\MYAPI\Read as Read;
    require_once __DIR__ . '/myapi/Read.php';
    
    $prodObj = new TECWEB\MYAPI\Read('marketzone');
    $prodObj->list();
    echo $prodObj->getData();
?>