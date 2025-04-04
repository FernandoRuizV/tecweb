<?php
    
    require_once __DIR__ . '/vendor/autoload.php';
    use MYAPI\DELETE\Delete as Delete;
    
    $prodObj = new Delete('marketzone');

    $id = ($_POST['id']);
    $prodObj->delete($id);
    echo $prodObj->getData(); 
?>