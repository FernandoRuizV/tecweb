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
    /*while(($a%$num !=0))
    {
        $a=mt_rand(1,100);
    }*/
    do{
        $a=mt_rand(1,100);

    }while(($a%$num !=0));
    echo "<br>";
    echo "El número entero encontrado es ".$a." y es múltiplo de ".$num;
}
function funcion4()
{
    $arr= [];
    for($i=97; $i<123; $i++)
    {
        $arr[$i]= chr($i);
        
    }
    echo "<table border='1'>";
    echo "<tr><th>Código ASCII</th><th>Carácter</th></tr>";
    foreach ($arr as $key => $value) {
        echo "<tr>";
        echo "<td>$key</td>";
        echo "<td>$value</td>";
        echo "</tr>";
    }echo "</table>";
    
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

function funcion6($matri, $todos)
{
    $Listado = [
        "ABC1234" => [
            "Auto" => [
                "Marca" => "Vocho",
                "Modelo" => 2022,
                "Tipo" => "Sedan"
            ],
            "Propietario" => [
                "Nombre" => "Ricardo Hernández",
                "Ciudad" => "Oaxaca de Juárez",
                "Dirección" => "Calle Macedonio Alcalá 101"
            ]
        ],
        "XYZ5664" => [
            "Auto" => [
                "Marca" => "Honda",
                "Modelo" => 2020,
                "Tipo" => "Hatchback"
            ],
            "Propietario" => [
                "Nombre" => "Silvia Vargas",
                "Ciudad" => "Oaxaca de Juárez",
                "Dirección" => "Avenida Independencia 222"
            ]
        ],
        "LMN7012" => [
            "Auto" => [
                "Marca" => "Ford",
                "Modelo" => 2019,
                "Tipo" => "Camioneta"
            ],
            "Propietario" => [
                "Nombre" => "Roberto Castillo",
                "Ciudad" => "Oaxaca de Juárez",
                "Dirección" => "Calle de los Libres 333"
            ]
        ],
        "DEF3456" => [
            "Auto" => [
                "Marca" => "Chevrolet",
                "Modelo" => 2021,
                "Tipo" => "Sedan"
            ],
            "Propietario" => [
                "Nombre" => "Fernanda López",
                "Ciudad" => "Oaxaca de Juárez",
                "Dirección" => "Calle García Vigil 444"
            ]
        ],
        "GHI6789" => [
            "Auto" => [
                "Marca" => "Nissan",
                "Modelo" => 2018,
                "Tipo" => "Hatchback"
            ],
            "Propietario" => [
                "Nombre" => "Emilio Ramos",
                "Ciudad" => "Oaxaca de Juárez",
                "Dirección" => "Calle Manuel Doblado 555"
            ]
        ],
        "JKL1122" => [
            "Auto" => [
                "Marca" => "Mazda",
                "Modelo" => 2022,
                "Tipo" => "Camioneta"
            ],
            "Propietario" => [
                "Nombre" => "Carla Méndez",
                "Ciudad" => "Oaxaca de Juárez",
                "Dirección" => "Calle de la Constitución 666"
            ]
        ],
        "MNO3344" => [
            "Auto" => [
                "Marca" => "Volkswagen",
                "Modelo" => 2017,
                "Tipo" => "Sedan"
            ],
            "Propietario" => [
                "Nombre" => "Javier Ortega",
                "Ciudad" => "Oaxaca de Juárez",
                "Dirección" => "Calle 20 de Noviembre 777"
            ]
        ],
        "PQR5566" => [
            "Auto" => [
                "Marca" => "Hyundai",
                "Modelo" => 2020,
                "Tipo" => "Hatchback"
            ],
            "Propietario" => [
                "Nombre" => "Adriana Guzmán",
                "Ciudad" => "Oaxaca de Juárez",
                "Dirección" => "Calle Las Casas 888"
            ]
        ],
        "STU7788" => [
            "Auto" => [
                "Marca" => "Kia",
                "Modelo" => 2021,
                "Tipo" => "Camioneta"
            ],
            "Propietario" => [
                "Nombre" => "Gerardo Sánchez",
                "Ciudad" => "Oaxaca de Juárez",
                "Dirección" => "Calle Mina 999"
            ]
        ],
        "VWX9900" => [
            "Auto" => [
                "Marca" => "Jeep",
                "Modelo" => 2016,
                "Tipo" => "Camioneta"
            ],
            "Propietario" => [
                "Nombre" => "Margarita Flores",
                "Ciudad" => "Oaxaca de Juárez",
                "Dirección" => "Calle Porfirio Díaz 1010"
            ]
        ],
        "YZA2233" => [
            "Auto" => [
                "Marca" => "Mercedes-Benz",
                "Modelo" => 2023,
                "Tipo" => "Sedan"
            ],
            "Propietario" => [
                "Nombre" => "Oscar Navarro",
                "Ciudad" => "Oaxaca de Juárez",
                "Dirección" => "Calle Reforma 1111"
            ]
        ],
        "BCD4455" => [
            "Auto" => [
                "Marca" => "BMW",
                "Modelo" => 2022,
                "Tipo" => "Hatchback"
            ],
            "Propietario" => [
                "Nombre" => "Daniela Pineda",
                "Ciudad" => "Oaxaca de Juárez",
                "Dirección" => "Calle Crespo 1212"
            ]
        ],
        "EFG6677" => [
            "Auto" => [
                "Marca" => "Audi",
                "Modelo" => 2020,
                "Tipo" => "Sedan"
            ],
            "Propietario" => [
                "Nombre" => "Raúl Velázquez",
                "Ciudad" => "Oaxaca de Juárez",
                "Dirección" => "Calle Morelos 1313"
            ]
        ],
        "HIJ8899" => [
            "Auto" => [
                "Marca" => "Tesla",
                "Modelo" => 2021,
                "Tipo" => "Sedan"
            ],
            "Propietario" => [
                "Nombre" => "Andrea Córdova",
                "Ciudad" => "Oaxaca de Juárez",
                "Dirección" => "Calle Vicente Guerrero 1414"
            ]
        ],
        "KLM1123" => [
            "Auto" => [
                "Marca" => "Subaru",
                "Modelo" => 2019,
                "Tipo" => "Camioneta"
            ],
            "Propietario" => [
                "Nombre" => "Luis Moreno",
                "Ciudad" => "Oaxaca de Juárez",
                "Dirección" => "Calle Hidalgo 1515"
            ]
        ]
    ];

        if(isset($Listado[$matri]))
        {
            echo "La información solicitada es la siguiente <br>";
            print_r($Listado[$matri]);
        }else{
            echo "No fue encontrada dicha matrícula<br>";
        }

        if($todos=="si" || $todos=="Si")
        {
            foreach ($Listado as $matricula => $vehiculo)
            {
                print_r($Listado);
            }
        }else{
            echo "No fue seleccionado <br>";
        }
    
    
}