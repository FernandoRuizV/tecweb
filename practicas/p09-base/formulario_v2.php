<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
      ol, ul { 
      list-style-type: none;
      }
    </style>
    <title>Formulario</title>
</head>
<body>
    <h1>Datos de la tabla "productos"</h1>

    <form id="miFormulario" action="http://localhost/tecweb/practicas/p08-base/set_producto_v3.php" method="post">
        <fieldset>
            <legend>Actualiza los datos de los productos:</legend>
            <ul>
                <li>
                    <label>Id:</label>
                    <input type="text" name="id" value="<?= $_POST['id'] ?>" readonly />
                </li>
                <li><label>Nombre:</label> 
                    <input type="text" name="nombre" value="<?= isset($_POST['nombre']) ? $_POST['nombre'] : (isset($_GET['nombre']) ? $_GET['nombre'] : '') ?>">
                </li>
                <li>
                    <label>Marca:</label> 
                    <select name="marca">
                        <option value="">Seleccione una marca</option>
                        <option value="Oster" <?= (isset($_POST['marca']) && $_POST['marca'] == "Oster") || (isset($_GET['marca']) && $_GET['marca'] == "Oster") ? 'selected' : '' ?>>Oster</option>
                        <option value="Tefal" <?= (isset($_POST['marca']) && $_POST['marca'] == "Tefal") || (isset($_GET['marca']) && $_GET['marca'] == "Tefal") ? 'selected' : '' ?>>Tefal</option>
                        <option value="Tupperware" <?= (isset($_POST['marca']) && $_POST['marca'] == "Tupperware") || (isset($_GET['marca']) && $_GET['marca'] == "Tupperware") ? 'selected' : '' ?>>Tupperware</option>
                        <option value="Tramontina" <?= (isset($_POST['marca']) && $_POST['marca'] == "Tramontina") || (isset($_GET['marca']) && $_GET['marca'] == "Tramontina") ? 'selected' : '' ?>>Tramontina</option>
                    </select>
                </li>
                <li><label>Modelo:</label> 
                    <input type="text" name="modelo" value="<?= isset($_POST['modelo']) ? $_POST['modelo'] : (isset($_GET['modelo']) ? $_GET['modelo'] : '') ?>">
                </li>
                <li><label>Precio:</label> 
                    <input type="number" name="precio" step="0.01" value="<?= isset($_POST['precio']) ? $_POST['precio'] : (isset($_GET['precio']) ? $_GET['precio'] : '') ?>">
                </li>
                <li><label>Unidades:</label> 
                    <input type="number" name="unidades" value="<?= isset($_POST['unidades']) ? $_POST['unidades'] : (isset($_GET['unidades']) ? $_GET['unidades'] : '') ?>">
                </li>
                <li><label>Detalles:</label> 
                    <textarea name="detalles"><?= isset($_POST['detalles']) ? $_POST['detalles'] : (isset($_GET['detalles']) ? $_GET['detalles'] : '') ?></textarea>
                </li>
                <li><label>Imagen:</label> 
                    <input type="text" name="imagen" value="<?= isset($_POST['imagen']) ? $_POST['imagen'] : (isset($_GET['imagen']) ? $_GET['imagen'] : '') ?>">
                </li>
                <li><label>Eliminado:</label> 
                    <input type="number" name="eliminado" value="<?= isset($_POST['eliminado']) ? $_POST['eliminado'] : (isset($_GET['eliminado']) ? $_GET['eliminado'] : '') ?>">
                </li>
            </ul>
        </fieldset>
        <p>
            <input type="submit" value="ENVIAR">
        </p>
    </form>
    <script>
    document.getElementById("miFormulario").addEventListener("submit", function(event) {
        event.preventDefault(); 
        
        let nombre = document.querySelector("[name='nombre']").value.trim();
        let marca = document.querySelector("[name='marca']").value;
        let modelo = document.querySelector("[name='modelo']").value.trim();
        let precio = parseFloat(document.querySelector("[name='precio']").value);
        let detalles = document.querySelector("[name='detalles']").value.trim();
        let unidades = parseInt(document.querySelector("[name='unidades']").value);
        let imagen = document.querySelector("[name='imagen']").value.trim();

        // Validaciones
        if (!nombre) {
            alert("El nombre es requerido.");
            return;
        }
        if (nombre.length > 100) {
            alert("El nombre debe tener 100 caracteres o menos.");
            return;
        }
        if (!marca) {
            alert("La marca es requerida.");
            return;
        }
        if (!modelo.match(/^[A-Za-z0-9]+$/)) {
            alert("El modelo debe ser alfanumérico.");
            return;
        }
        if (modelo.length > 25) {
            alert("El modelo debe tener 25 caracteres o menos.");
            return;
        }
        if (isNaN(precio) || precio <= 99.99) {
            alert("El precio debe ser un número mayor a 99.99.");
            return;
        }
        if (detalles.length > 250) {
            alert("Los detalles no pueden exceder los 250 caracteres.");
            return;
        }
        if (isNaN(unidades) || unidades < 0) {
            alert("Las unidades deben ser un número igual o mayor a 0.");
            return;
        }
        if (!imagen) {
            imagen = "/tecweb/practicas/p08-base/img/imagen.png";
        }

        alert("Formulario validado correctamente. Enviando...");

        event.target.submit();
    });
</script>

</body>
</html>
