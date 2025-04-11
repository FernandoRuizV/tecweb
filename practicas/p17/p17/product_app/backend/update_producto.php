<?php
    
    require_once __DIR__ . '/vendor/autoload.php';
    use MYAPI\UPDATE\Update as Update;
    
    $prodObj = new Update('marketzone');

    $id = ($_POST['id']);
    $prodObj->asignar($id);
    echo $prodObj->getData(); 

?>
