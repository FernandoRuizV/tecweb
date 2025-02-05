<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 3</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar,  $_7var,  myvar,  $myvar,  $var7,  $_element1, $house*5</p>
    <?php
        //AQUI VA MI CÓDIGO PHP
        $_myvar;
        $_7var;
        //myvar;       // Inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Invalida
        
        echo '<h4>Respuesta:</h4>';   
    
        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>myvar es inválida porque no tiene el signo de dolar ($).</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
        echo '</ul>';
    ?>
        <h2>Ejercicio 2</h2>
    <?php
    $a = "ManejadorSQL";
    $b = 'MySQL';
    $c = &$a;

    echo "Valor de a: $a<br>";
    echo "Valor de b: $b<br>";
    echo "Valor de c: $c<br><br>";

    $a = "PHP server";
    $b = &$a;

    echo "Valor de a: $a<br>";
    echo "Valor de b: $b<br>";
    echo "Valor de c: $c<br>";

    echo '<h4>Respuesta:</h4>'; 
    echo '<p>El valor de $a era igual a "ManejadorSQL", el de b igual a "MySQL" y el de c
    era igual al valor de a, por su referencia. <br>Finalmente el valor de a se modifica y a su vez
    el valor de b cambia a ser el valor referenciado de a, por lo que todas pasan a tener
    el mismo valor.</p>';
    ?>

        <h2>Ejercicio 3</h2>
    <?php

    $a = "PHP5";
    print_r($a);
    echo "<br>";
    $z[] = &$a;
    print_r($z);
    echo "<br>";
    $b = "5a version de PHP";
    print_r($b);
    echo "<br>";
    @$c = $b*10;
    echo "$c";
    echo "<br>";
    $a .= $b;
    print_r($a);
    echo "<br>";
    $b *= $c;
    print_r($b);
    echo "<br>";
    $z[0] = "MySQL";
    print_r($z);
    echo "<br><br>";
    ?>
        <h2>Ejercicio 4</h2>   
    <?php

    unset($a, $b, $c, $z);
    $a = "PHP5";
    $z[] = &$a;
    $b = "5a version de PHP";
    @$c = $b*10;
    $a .= $b;
    @$b *= $c;
    $z[0] = "MySQL";
    
    echo "\$a = ";
    var_dump($GLOBALS['a']);
	echo "<br><br>";

	echo "\$z = ";
	var_dump($GLOBALS['z']);
	echo "<br><br>";

	echo "\$b = ";
	var_dump($GLOBALS['b']);
	echo "<br><br>";

	echo "\$c = ";
	var_dump($GLOBALS['c']);
	echo "<br><br>";

    ?>
        <h2>Ejercicio 5</h2>
    <?php

    unset($a, $b, $c);

    $a = "7 personas";
    $b = (integer) $a;
    $a = "9E3";
    $c = (double) $a;

    echo "El valor de a: $a <br>";
    echo "El valor de b: $b <br>";
    echo "El valor de c: $c <br><br>";
    ?>
        <h2>Ejercicio 6</h2>
    
    <?php
	$a = "0";
    $b = "TRUE";
    $c = FALSE;
    $d = ($a OR $b);
    $e = ($a AND $c);
    $f = ($a XOR $b);

	var_dump((bool)$a);
    echo "<br>";
    var_dump((bool)$b);
    echo "<br>";
    var_dump($c);
    echo "<br>";
    var_dump($d);
    echo "<br>";
    var_dump($e);
    echo "<br>";
    var_dump($f);
    echo "<br><br>";

    echo "<br>\$c = " . var_export($c, true) . "<br>";
	echo "\$e = " . var_export($e, true) . "<br>";
    ?>

    <h2>Ejercicio 7</h2>

    <ul>
    <li><strong>Versión de Apache y PHP:</strong> <?php echo $_SERVER['SERVER_SOFTWARE']; ?></li>
    <li><strong>Sistema Operativo del Servidor:</strong> <?php echo php_uname(); ?></li>
    <li><strong>Idioma del Navegador (Cliente):</strong> <?php echo $_SERVER['HTTP_ACCEPT_LANGUAGE']; ?></li>
	</ul>

<script>
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>

</body>
</html>