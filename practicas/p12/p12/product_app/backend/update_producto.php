<?php
    
    use TECWEB\MYAPI\Update as Update;
    require_once __DIR__ . '/myapi/Update.php';
    
    $prodObj = new TECWEB\MYAPI\Update('marketzone');

    $id = ($_POST['id']);
    $prodObj->asignar($id);
    echo $prodObj->getData(); 

?>
