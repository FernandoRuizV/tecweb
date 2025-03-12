// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

$(document).ready(function(){
    let edit = false;

    let JsonString = JSON.stringify(baseJSON,null,2);
    $('#description').val(JsonString);
    $('#product-result').hide();
    listarProductos();

    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function(response) {
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                const productos = JSON.parse(response);
            
                // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                if(Object.keys(productos).length > 0) {
                    // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                    let template = '';

                    productos.forEach(producto => {
                        // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                        let descripcion = '';
                        descripcion += '<li>precio: '+producto.precio+'</li>';
                        descripcion += '<li>unidades: '+producto.unidades+'</li>';
                        descripcion += '<li>modelo: '+producto.modelo+'</li>';
                        descripcion += '<li>marca: '+producto.marca+'</li>';
                        descripcion += '<li>detalles: '+producto.detalles+'</li>';
                    
                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger" onclick="eliminarProducto()">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                    $('#products').html(template);
                }
            }
        });
    }

    $('#search').keyup(function() {
        if($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: './backend/product-search.php?search='+$('#search').val(),
                data: {search},
                type: 'GET',
                success: function (response) {
                    if(!response.error) {
                        // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                        const productos = JSON.parse(response);
                        
                        // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                        if(Object.keys(productos).length > 0) {
                            // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                            let template = '';
                            let template_bar = '';

                            productos.forEach(producto => {
                                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                                let descripcion = '';
                                descripcion += '<li>precio: '+producto.precio+'</li>';
                                descripcion += '<li>unidades: '+producto.unidades+'</li>';
                                descripcion += '<li>modelo: '+producto.modelo+'</li>';
                                descripcion += '<li>marca: '+producto.marca+'</li>';
                                descripcion += '<li>detalles: '+producto.detalles+'</li>';
                            
                                template += `
                                    <tr productId="${producto.id}">
                                        <td>${producto.id}</td>
                                        <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                        <td><ul>${descripcion}</ul></td>
                                        <td>
                                            <button class="product-delete btn btn-danger">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                `;

                                template_bar += `
                                    <li>${producto.nombre}</il>
                                `;
                            });
                            // SE HACE VISIBLE LA BARRA DE ESTADO
                            $('#product-result').show();
                            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                            $('#container').html(template_bar);
                            // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                            $('#products').html(template);    
                        }
                    }
                }
            });
        }
        else {
            $('#product-result').hide();
        }
    });


    $("#product-form").submit(function(e) {
        e.preventDefault();

            $('button.btn-primary').text("Agregar Producto");
            $("#product-result").show().html("");
            let errores = false;

            let nombre = $("#name").val().trim();
            let precio = $("#precio").val().trim();
            let marca = $("#marca").val().trim();
            let unidades = $("#unidades").val().trim();
            let modelo = $("#modelo").val().trim();
            let detalles = $("#detalles").val().trim();
            let imagen = $("#imagen").val().trim();
            let id = $("#productId").val().trim(); 
    

            // VALIDACIONES
            if (!nombre) {
                $("#product-result").append(`<p>El nombre es requerido.</p>`);
                errores = true;
            } else if (nombre.length > 100) {
                $("#product-result").append(`<p>El nombre debe tener 100 caracteres o menos.</p>`);
                errores = true;
            }
    
            if (!modelo.match(/^[A-Za-z0-9]+$/)) {
                $("#product-result").append(`<p>El modelo debe ser alfanumérico.</p>`);
                errores = true;

            } else if (modelo.length > 25) {
                $("#product-result").append(`<p>El modelo debe tener 25 caracteres o menos.</p>`);
                errores = true;
            }
    
            if (!marca || marca === "NA") {
                $("#product-result").append(`<p>La marca es requerida.</p>`);
                errores = true;
            }
    
            if (isNaN(precio) || precio <= 99.99) {
                $("#product-result").append(`<p>El precio debe ser un número mayor a 99.99.</p>`);
                errores = true;
            }
    
            if (detalles === "NA") {
                $("#product-result").append(`<p>Los detalles no pueden ser nulos.</p>`);
                errores = true;
            } else if (detalles.length > 250) {
                $("#product-result").append(`<p>Los detalles no pueden exceder los 250 caracteres.</p>`);
                errores = true;
            }
    
            if (isNaN(unidades) || unidades < 0) {
                $("#product-result").append(`<p>Las unidades deben ser un número igual o mayor a 0.</p>`);
                errores = true;
                
            }
    
            if (!imagen) {
                imagen = "/tecweb/practicas/p08-base/img/imagen.png"; 
            }
    
            if (errores) return;

            let postData = { nombre, precio, marca, unidades, modelo, detalles, imagen };
            const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';
            if (edit) {
                postData.id = id;
            }
    
            $.post(url, postData, (response) => {
                let respuesta = JSON.parse(response);
                let template_bar = `
                    <li style="list-style: none;">Status: ${respuesta.status}</li>
                    <li style="list-style: none;">Message: ${respuesta.message}</li>
                `;
    
                $("#product-result").html(template_bar).show();
                $("#name").val('');
                $("#precio").val('');
                $("#marca").val('');
                $("#unidades").val('');
                $("#modelo").val('');
                $("#detalles").val('');
                $("#imagen").val('');
                if (!edit) {
                    $("#product-form")[0].reset();
                }
                listarProductos();
                edit = false;
            });
        });
        $("#name, #modelo, #marca, #precio, #detalles, #unidades").blur(function() {
            if (!edit) {
                $("#product-result").html(""); 
                $("#product-form").submit(); 
            }
    });

    $(document).on('click', '.product-delete', (e) => {
        if(confirm('¿Realmente deseas eliminar el producto?')) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('productId');
            $.post('./backend/product-delete.php', {id}, (response) => {
                $('#product-result').hide();
                listarProductos();
            });
        }
        
    });

    $(document).on('click', '.product-item', (e) => {
        $('button.btn-primary').text("Modificar Producto");
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('productId');
        $.post('./backend/product-single.php', {id}, (response) => {
            // SE CONVIERTE A OBJETO EL JSON OBTENIDO
            let product = JSON.parse(response);
            // SE INSERTAN LOS DATOS ESPECIALES EN LOS CAMPOS CORRESPONDIENTES
            $('#name').val(product.nombre);
            // EL ID SE INSERTA EN UN CAMPO OCULTO PARA USARLO DESPUÉS PARA LA ACTUALIZACIÓN
            $('#productId').val(product.id);
            // SE ELIMINA nombre, eliminado E id PARA PODER MOSTRAR EL JSON EN EL <textarea>
            $('#marca').val(product.marca);
            $('#modelo').val(product.modelo);
            $('#detalles').val(product.detalles);
            $('#unidades').val(product.unidades);
            $('#imagen').val(product.imagen);
            $('#precio').val(product.precio);
            $('#productId').val(product.id);
            
            // SE PONE LA BANDERA DE EDICIÓN EN true
            edit = true;
        });
        e.preventDefault();
    });
      
});