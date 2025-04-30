$(document).ready(function(){
    listar();
    let edit= false;
    $('#search').keyup(function(e){
        if($('#search').val()){
            let search= $('#search').val();
            if(search){
                $.ajax({
                    url:`http://localhost/tecweb/practicas/p18/p18/product_app/backend/products/${search}`,
                    type: 'GET',
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
    $('#name').keyup(function() {
        if($('#name').val()) {
            let name = $('#name').val();
            $.ajax({
                url: 'http://localhost/tecweb/practicas/p18/p18/product_app/backend/search-name',
                data: { name: $('#name').val() },
                type: 'GET',
                success: function (response) {
                    if(!response.error) {
                        // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                        const productos = JSON.parse(response);
                        
                        // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                        if(Object.keys(productos).length > 0) {
                            console.log(productos);
                            let template_bar = '';
                            productos.forEach(producto => {

                                template_bar += `
                                    <li>${producto.nombre}</li>
                                `;
                                  
                            }); 
                            $('#container').html('');
                            $('#container').append("Producto con nombres similares");
                            $('#container').append(template_bar); 
                            $('#product-result').removeClass('d-none').show();                            
                        }else{
                            $('#container').html('');
                            $('#container').append("Producto con nombre válido");
                            $('#product-result').removeClass('d-none').show();
                        }
                    }
                }
            });
        }
        else {
            $('#product-result').hide();
        }
    }); 
    $('#product-form').submit(function(e){
        e.preventDefault();
        $('button.btn-primary').text("Agregar Producto");
        let errores = false;
        $("#product-result").html("").removeClass('d-none').show();
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
            
        console.log("Datos enviados:", postData);
                if (edit==true) {
                    postData.id = id;
                    $.ajax({
                        url: `http://localhost/tecweb/practicas/p18/p18/product_app/backend/product`,
                        type: 'PUT',
                        data: JSON.stringify(postData),
                        success: function(response) {
                            console.log("Respuesta del servidor:", response);
            
                            try {
                                let res = JSON.parse(response);
                                if (res.status === "success") {
                                    $("#container").html(response).show();
                                    $("#name").val('');
                                    $("#precio").val('');
                                    $("#marca").val('');
                                    $("#unidades").val('');
                                    $("#modelo").val('');
                                    $("#detalles").val('');
                                    $("#imagen").val('');
                                    edit = false;
                                    alert(res.message);
                                    listar();
                                } else {
                                    $("#container").html(response).show();
                                }
                            } catch (e) {
                                console.error("Error al procesar la respuesta JSON:", e);
                                console.log("Respuesta no JSON:", response);
                                alert("Hubo un error al procesar la respuesta del servidor.");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error en la solicitud AJAX:", error);
                            alert("No se pudo completar la operación.");
                        }
                    });
                }else{
                    $.ajax({
                        url: `http://localhost/tecweb/practicas/p18/p18/product_app/backend/product`,
                        type: 'POST',
                        data: postData,
                        success: function(response) {
                            console.log("Respuesta del servidor:", response);
            
                            try {
                                let res = JSON.parse(response);
                                if (res.status === "success") {
                                    $("#container").html(response).show();
                                    $("#name").val('');
                                    $("#precio").val('');
                                    $("#marca").val('');
                                    $("#unidades").val('');
                                    $("#modelo").val('');
                                    $("#detalles").val('');
                                    $("#imagen").val('');
                                    edit = false;
                                    alert(res.message);
                                    listar();
                                } else {
                                    $("#container").html(response).show();
                                }
                            } catch (e) {
                                console.error("Error al procesar la respuesta JSON:", e);
                                console.log("Respuesta no JSON:", response);
                                alert("Hubo un error al procesar la respuesta del servidor.");
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error("Error en la solicitud AJAX:", error);
                            alert("No se pudo completar la operación.");
                        }
                    });
                }
            });
            $("#name, #modelo, #marca, #precio, #detalles, #unidades").blur(function() {
                if (!edit) {
                    $("#product-result").html(""); 
                    $("#product-form").submit(); 
                }
        });
    
    function listar(){
        $.ajax({
            url:'http://localhost/tecweb/practicas/p18/p18/product_app/backend/products',
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

    $(document).on('click', '.eliminar', function() {
        if (confirm('¿Estás seguro de querer eliminar el elemento?')) {
            let fila = $(this).closest('tr');
            let id = fila.find('td').first().text();
            $.ajax({
                url: `http://localhost/tecweb/practicas/p18/p18/product_app/backend/product/${id}`,
                type: 'DELETE',
                success: function(response) {
                    console.log("ID eliminado:", id);
                    console.log("Respuesta:", response);
    
                    try {
                        let resp = JSON.parse(response);
                        if (resp.status === "success") {
                            alert(resp.message);
                            listar(); 
                        } else {
                            alert(resp.message);
                        }
                    } catch (e) {
                        console.error("Error al procesar la respuesta JSON:", e);
                        alert("Hubo un error al procesar la respuesta del servidor.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error en la solicitud AJAX:", error);
                    alert("No se pudo completar la operación.");
                }
            });
        }
    });
    

    $(document).on('click', '.editar', function() {
        if (confirm('¿Estás seguro de querer editar el elemento?')) {
            $('button.btn-primary').text("Modificar Producto");
            let fila = $(this).closest('tr');
            let id = fila.find('td').first().text();
            edit=true;
            $.ajax({
                url: `http://localhost/tecweb/practicas/p18/p18/product_app/backend/busq`,
                type: 'GET',
                data: {id: id},
                success: function(response) {
                    console.log("ID editado:", id);
                    console.log("Respuesta:", response);
    
                    try {
                        let prod = JSON.parse(response);
    
                        if (prod.status === "success" && prod.data.length > 0) {
    
                            let product = prod.data[0];
                            $('#name').val(product.nombre);
                            $('#productId').val(product.id);
                            $('#precio').val(product.precio);
                            $('#unidades').val(product.unidades);
                            $('#modelo').val(product.modelo);
                            $('#marca').val(product.marca);
                            $('#detalles').val(product.detalles);
                            $('#imagen').val(product.imagen);
                        } else {
                            alert("Producto no encontrado o respuesta incorrecta.");
                        }
                    } catch (e) {
                        console.error("Error al procesar la respuesta JSON:", e);
                        alert("Hubo un error al procesar los datos.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error en la solicitud AJAX:", error);
                    alert("No se pudo completar la operación.");
                }
            });

        }
    });


});