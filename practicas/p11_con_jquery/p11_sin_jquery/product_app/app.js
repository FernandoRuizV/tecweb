// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON,null,2);
    document.getElementById("description").value = JsonString;

    // SE LISTAN TODOS LOS PRODUCTOS
    //*listarProductos();*/
}

$(document).ready(function(){
    listar();
    let edit= false;
    $('#search').keyup(function(e){
        if($('#search').val()){
            let search= $('#search').val();
            if(search){
                $.ajax({
                    url:'http://localhost/tecweb/practicas/p11_con_jquery/p11_sin_jquery/product_app/backend/product-search.php',
                    type: 'POST',
                    data:{search},
                    success: function (response){
                        let tasks=JSON.parse(response);
                        let template='';
                        let estruc='';
                        tasks.forEach(producto => {
                            template+= `<li>
                                ${producto.nombre}
                            </li>`
                            estruc+= 
                            `<tr>
                                <td>${producto.id}</td>
                                <td>${producto.nombre}</td>
                                <td>
                                <li>precio: ${producto.precio}</li>
                                <li>unidades: ${producto.unidades}</li>
                                <li>modelo: ${producto.modelo}</li>
                                <li>marca: ${producto.marca}</li>
                                <li>detalles: ${producto.detalles}</li>
                                </td>
                                <td>
                                    <button class="eliminar btn btn-danger">
                                    Eliminar</button>
                                </td>
                                <td>
                                    <button class="editar btn btn-info">
                                    Editar</button>
                                </td>
                                </tr>`
                        });
                        console.log(template)
                        $('#container').html(template);
                        $('#products').html(estruc)
                        $('#product-result').removeClass('d-none').show();
                    }
                });    
            }else{
                listar();
            }
            
        }else{
            $('#product-result').hide();
        }
        
        
    });
    $('#product-form').submit(function(e){
        let description = $('#description').val().trim();
        let desc= JSON.parse(description);
        desc['nombre']=$('#name').val().trim();

        // Validaciones
        if (!desc.nombre) {
            alert("El nombre es requerido.");
            return;
        }
        if (desc.nombre.length > 100) {
            alert("El nombre debe tener 100 caracteres o menos.");
            return;
        }
        if (!desc.marca || desc.marca=="NA") {
            alert("La marca es requerida.");
            return;
        }
        if (!desc.modelo.match(/^[A-Za-z0-9]+$/)) {
            alert("El modelo debe ser alfanumérico.");
            return;
        }
        if (desc.modelo.length > 25) {
            alert("El modelo debe tener 25 caracteres o menos.");
            return;
        }
        if (isNaN(desc.precio) || desc.precio <= 99.99) {
            alert("El precio debe ser un número mayor a 99.99.");
            return;
        }
        if (desc.detalles == "NA") {
            alert("Los detalles no pueden ser nulos");
            return;
        }
        if (desc.detalles.length > 250) {
            alert("Los detalles no pueden exceder los 250 caracteres.");
            return;
        }
        if (isNaN(desc.unidades) || desc.unidades < 0) {
            alert("Las unidades deben ser un número igual o mayor a 0.");
            return;
        }
        if (!desc.imagen) {
            desc.imagen = "/tecweb/practicas/p08-base/img/imagen.png";
        }

        alert("Formulario validado correctamente. Enviando...");


        const postData={
            nombre: desc.nombre,
            precio: desc.precio,
            unidades: desc.unidades,
            modelo: desc.modelo,
            marca: desc.marca,
            detalles: desc.detalles,
            imagen: desc.imagen,
            id: $('#productId').val()
        };
        
        console.log("Datos a enviar:", postData);
        let url= edit==false ? 'http://localhost/tecweb/practicas/p11_con_jquery/p11_sin_jquery/product_app/backend/product-add.php': 'http://localhost/tecweb/practicas/p11_con_jquery/p11_sin_jquery/product_app/backend/producto_edit.php';
        $.post(url,postData,function(response) {

            console.log("Respuesta del servidor:", response);

            try {
                let res = JSON.parse(response);
                if (res.status === "success") {
                    alert(res.message);  // Mostrar mensaje de éxito
                    init();
                    $('#name').val('');
                    listar();
                } else {
                    alert(res.message);  // Mostrar mensaje de error
                }
            } catch (e) {
                console.error("Error al procesar la respuesta JSON:", e);
                alert("Hubo un error al procesar la respuesta del servidor.");
            }
        }); 
        e.preventDefault();
    })
    
    function listar(){
        $.ajax({
            url:'http://localhost/tecweb/practicas/p11_con_jquery/p11_sin_jquery/product_app/backend/product-list.php',
            type: 'GET',
            success: function (response){
                let productos=JSON.parse(response);
                let estruc='';
                productos.forEach(producto => {
                    estruc+= 
                    `<tr>
                        <td>${producto.id}</td>
                        <td>${producto.nombre}</td>
                        <td>
                        <li>precio: ${producto.precio}</li>
                        <li>unidades: ${producto.unidades}</li>
                        <li>modelo: ${producto.modelo}</li>
                        <li>marca: ${producto.marca}</li>
                        <li>detalles: ${producto.detalles}</li>
                        </td>
                        <td>
                            <button class="eliminar btn btn-danger">
                            Eliminar</button>
                        </td>
                        <td>
                            <button class="editar btn btn-info">
                            Editar</button>
                        </td>
                        </tr>`
               });
                $('#products').html(estruc);
                
            }
        });
    }

    $(document).on('click', '.eliminar',function(){
        if(confirm('¿Estás seguro de querer eliminar el elemento?')){
            let fila = $(this).closest('tr');
            let id= fila.find('td').first().text();
        
            $.post('http://localhost/tecweb/practicas/p11_con_jquery/p11_sin_jquery/product_app/backend/product-delete.php',{id: id},function(response) {
                console.log(id);
                console.log(response);
                try {
                    let resp = JSON.parse(response);
                    if (resp.status === "success") {
                        alert(resp.message);  // Mostrar mensaje de éxito
                        listar();
                    } else {
                        alert(resp.message);  // Mostrar mensaje de error
                    }   
                } catch (e) {
                    console.error("Error al procesar la respuesta JSON:", e);
                    alert("Hubo un error al procesar la respuesta del servidor.");
                }
            })   
        }
        
    });

    $(document).on('click', '.editar', function() {
        if (confirm('¿Estás seguro de querer editar el elemento?')) {
            let fila = $(this).closest('tr');
            let id = fila.find('td').first().text();
            edit=true;
            $.post('http://localhost/tecweb/practicas/p11_con_jquery/p11_sin_jquery/product_app/backend/update_producto.php', {id: id}, function(response) {
                console.log("Respuesta del servidor:", response);
                
                try {
                    let prod = JSON.parse(response);
                    
                    if (prod.status === "success" && prod.data.length > 0) {
                        
                        let product = prod.data[0];
                        $('#name').val(product.nombre);
                        $('#productId').val(product.id);
                        let baseJSON = {
                            "precio": product.precio,
                            "unidades": product.unidades,
                            "modelo": product.modelo,
                            "marca": product.marca,
                            "detalles": product.detalles,
                            "imagen": product.imagen
                        };
                        
                        $('#description').val(JSON.stringify(baseJSON, null, 2));
                    } else {
                        alert("Producto no encontrado o respuesta incorrecta.");
                    }
                } catch (e) {
                    console.error("Error al procesar la respuesta JSON:", e);
                    alert("Hubo un error al procesar los datos.");
                }
            
            });
        }
    });
    


});