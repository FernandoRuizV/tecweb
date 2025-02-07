<?php
function funcion1($num)
{
    if ($num%5==0 && $num%7==0)
    {
        echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
    }
    else
    {
        echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
    }
}
function funcion2()
{
    $iteracion=0;
    do{
        $a=mt_rand(1, 100);
        $b=mt_rand(1, 100);
        $c=mt_rand(1, 100);
        $Matriz[]=[$a,$b,$c];
        print_r($Matriz);
        $iteracion++;
    }while(!($a%2 !=0 && $b%2 ==0 && $c%2 !=0));
    $elementos = count($Matriz, COUNT_RECURSIVE) - count($Matriz);
    echo "<br>";
    echo "Cantidad total de números en la matriz: " . $elementos . "  en  ".$iteracion."  iteraciones"."<br>";

}

function funcion3($num)
{
    $a=-1;
    while(($a%$num !=0))
    {
        $a=mt_rand(1,100);
    }
    echo "<br>";
    echo "El numero entero encontrado es ".$a." y es multiplo de ".$num;
}

function funcion5($edad, $sexo)
{
    if($sexo == "femenino")
    {
        if($edad>=18 && $edad<=35)
        {
            echo "Bienvenida, usted está en el rango de edad permitido."."<br>";
        }
        else{
            echo "Su edad no se encuentra dentro del rango aceptado"."<br>";
        }
    }
    if($sexo!= "femenino")
    {
        echo "Necesita ser una persona del sexo femenino para ser aceptada"."<br>";
    }
}

?>