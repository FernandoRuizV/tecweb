<?php
    
    
    require_once __DIR__ . '/vendor/autoload.php';
    use MYAPI\READ\Read as Read;
    
    $prodObj = new Read('marketzone');
    $prodObj->list();
    echo $prodObj->getData();
?>