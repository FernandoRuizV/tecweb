<?php
    
    use TECWEB\MYAPI\Read as Read;
    require_once __DIR__ . '/myapi/Read.php';
    
    $prodObj = new TECWEB\MYAPI\Read('marketzone');

    $search = ($_POST['search']);
    $prodObj->search($search);
    echo $prodObj->getData(); 
?>