<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 3</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar, $_7var, myvar, $myvar, $var7, $_element1, $house*5</p>

    <?php
        $_myvar = '';
        $_7var = '';
        $myvar = '';
        $var7 = '';
        $_element1 = '';
        
        echo '<h4>Respuesta:</h4>';   
        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>myvar es inválida porque no tiene el signo de dólar ($).</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
        echo '</ul>';
    ?>

    <h2>Ejercicio 2</h2>
    <?php
        $a = "ManejadorSQL";
        $b = "MySQL";
        $c = &$a;

        echo "<p>Valor de a: $a</p>";
        echo "<p>Valor de b: $b</p>";
        echo "<p>Valor de c: $c</p>";

        $a = "PHP server";
        $b = &$a;

        echo "<p>Valor de a: $a</p>";
        echo "<p>Valor de b: $b</p>";
        echo "<p>Valor de c: $c</p>";

        echo '<h4>Respuesta:</h4>'; 
        echo '<p>Las variables $a, $b y $c comparten una referencia, por lo tanto, al cambiar $a, también cambian $b y $c.</p>';
    ?>

    <h2>Ejercicio 3</h2>
    <?php
        $a = "PHP5";
        $z[] = &$a;
        $b = "5a version de PHP";
        @$c = $b * 10;
        $a .= $b;
        $b *= $c;
        $z[0] = "MySQL";

        echo "<p>\$a = " . htmlspecialchars($a) . "</p>";
        echo "<p>\$b = " . htmlspecialchars($b) . "</p>";
        echo "<p>\$c = " . htmlspecialchars($c) . "</p>";
        echo "<p>\$z = "; print_r($z); echo "</p>";
    ?>

    <h2>Ejercicio 4</h2>
    <?php
        unset($a, $b, $c, $z);
        $a = "PHP5";
        $z[] = &$a;
        $b = "5a version de PHP";
        @$c = $b * 10;

        echo "<p>\$a = " . var_export($GLOBALS['a'], true) . "</p>";
        echo "<p>\$b = " . var_export($GLOBALS['b'], true) . "</p>";
        echo "<p>\$c = " . var_export($GLOBALS['c'], true) . "</p>";
    ?>

    <h2>Ejercicio 5</h2>
    <?php
        $a = "7 personas";
        $b = (integer) $a;
        $a = "9E3";
        $c = (double) $a;

        echo "<p>\$a = " . htmlspecialchars($a) . "</p>";
        echo "<p>\$b = " . htmlspecialchars($b) . "</p>";
        echo "<p>\$c = " . htmlspecialchars($c) . "</p>";
    ?>

    <h2>Ejercicio 6</h2>
    <?php
        $a = "0";
        $b = "TRUE";
        $c = false;

        echo "<p>\$a = ".var_export((bool)$a, true)."</p>";
        echo "<p>\$b = ".var_export((bool)$b, true)."</p>";
        echo "<p>\$c = ".var_export($c, true)."</p>";
    ?>

    <h2>Ejercicio 7</h2>
    <ul>
        <li><strong>Versión de Apache y PHP:</strong> <?php echo htmlspecialchars($_SERVER['SERVER_SOFTWARE']); ?></li>
        <li><strong>Sistema Operativo del Servidor:</strong> <?php echo htmlspecialchars(php_uname()); ?></li>
        <li><strong>Idioma del Navegador (Cliente):</strong> <?php echo htmlspecialchars($_SERVER['HTTP_ACCEPT_LANGUAGE']); ?></li>
    </ul>

    <p>
        <a href="https://validator.w3.org/markup/check?uri=referer">
            <img src="https://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" />
        </a>
    </p>
</body>
</html>