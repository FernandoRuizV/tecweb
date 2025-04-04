<?php
    
    use TECWEB\MYAPI\Delete as Delete;
    require_once __DIR__ . '/myapi/Delete.php';
    
    $prodObj = new TECWEB\MYAPI\Delete('marketzone');

    $id = ($_POST['id']);
    $prodObj->delete($id);
    echo $prodObj->getData(); 
?>