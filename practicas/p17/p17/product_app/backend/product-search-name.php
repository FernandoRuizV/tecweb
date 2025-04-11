<?php
    
    require_once __DIR__ . '/vendor/autoload.php';
    use MYAPI\READ\Read as Read;
    
    $prodObj = new Read('marketzone');

    $name = ($_GET['name']);
    $prodObj->single($name);
    echo $prodObj->getData(); ;
?>