<?php
    
    require_once __DIR__ . '/vendor/autoload.php';
    use MYAPI\READ\Read as Read;
    
    $prodObj = new Read('marketzone');

    $search = ($_POST['search']);
    $prodObj->search($search);
    echo $prodObj->getData(); 
?>