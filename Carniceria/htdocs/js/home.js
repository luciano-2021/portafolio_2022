$(function(){

    /******************** VALIDACIONES ********************************/

    var numeros = '1234567890';
    var decimal = '1234567890.';
    var letras  = 'qwertyuiopasdfghjklzxcvbnm'+
                  'QWERTYUIOPLKJHGFDSAZXCVBNM '+
                  'ÁÚÍÓÉáéúíó';

    var letras2 = 'qwertyuiopasdfghjklzxcvbnm'+
                  'QWERTYUIOPLKJHGFDSAZXCVBNM1234567890 ';

    //solo letras
    $('#txtDescProd, #txtFilNomUsr, #txtFilPatUsr, #txtFilMayUsr').keypress(function(e){
        var caracter = String.fromCharCode(e.which);
        if(letras.indexOf(caracter)<0)
            return false;       
    });

    //letras y numeros
    $('#txtFilNomProducto' ).keypress(function(e){
        var letra = letras + numeros + '-';
        var caracter = String.fromCharCode(e.which);
        if(letra.indexOf(caracter)<0)
            return false;       
    });

    //solo numeros
    $('#txtStockMin, #txtStockMax, #txtStockIni, #txtPreProd').keypress(function(e){
        var letra = numeros;
        var caracter = String.fromCharCode(e.which);
        if(letra.indexOf(caracter)<0)
            return false;       
    });

     var Fn = {
        // Valida el rut con su cadena completa "XXXXXXXX-X"
        validaRut : function (rutCompleto) {
            if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( rutCompleto ))
                return false;
            var tmp     = rutCompleto.split('-');
            var digv    = tmp[1]; 
            var rut     = tmp[0];
            if ( digv == 'K' ) digv = 'k' ;
            return (Fn.dv(rut) == digv );
        },
        dv : function(T){
            var M=0,S=1;
            for(;T;T=Math.floor(T/10))
                S=(S+T%10*(9-M++%6))%11;
            return S?S-1:'k';
        }
    }

    /*********************************************************************************************/
    /*              FIN VALIDACIONES                                                             */
    /*********************************************************************************************/

    ocultarVaciar();
    $("#dvInicioEstadisticas").fadeIn("fast");

    $("#menUsuarios").click(function(){
        
        ocultarVaciar();
        cargaSelectTipoUsr()
        $("#dvFormUsuarios").fadeIn("slow");

    });

    $("#menReporteMin").click(function(){
            
        ocultarVaciar();
        $("#dvFormUsuarios").fadeIn("slow");
        reporteStocktbl(1);

    });


    $("#menReporteMin").click(function(){
            
        ocultarVaciar();
        $("#dvReporteMinimo").fadeIn("slow");
        reporteStocktbl(2);

    });


    $("#menReporteMax").click(function(){
        
        ocultarVaciar();
        $("#dvReporteMaximo").fadeIn("fast");

    });

    $("#menuParamet").click(function(){
        
        ocultarVaciar();
        $("#dvParametros").fadeIn("slow");

    });

    $("#menReporteVta").click(function(){
        
        ocultarVaciar();
        $("#dvReporteVenta").fadeIn("slow");

    });

    $("#menProducto").click(function(){
        
        ocultarVaciar();
        $("#dvFormProductos").fadeIn("slow");

    });

    $("#bt-listaUsuarios").click(function(){

        var rut =  $("#txtFilRutUsr").val(),
            tip =  $("#filSelTipoUsr").val();

        listaUsuarios(rut, tip);

    });
   

    $("#btnGrabaUsuario").click(function(){

        var txtIdUsuario = $("#txtIdUsuario").val(),
            txtFilRutUsr = $("#txtFilRutUsrCrea").val(),
            txtFilNomUsr = $("#txtFilNomUsr").val(),
            txtFilPatUsr = $("#txtFilPatUsr").val(),
            txtFilMayUsr = $("#txtFilMayUsr").val(),
            txtFilCartUsr  = $("#txtFilCartUsr").val(),
            txtFiTipUsr = $("#txtFiTipUsr").val();

        var dataSet = { txtIdUsuario: txtIdUsuario, txtFilRutUsr: txtFilRutUsr, txtFilNomUsr: txtFilNomUsr, txtFilPatUsr: txtFilPatUsr, txtFilMayUsr: txtFilMayUsr, txtFilCartUsr: txtFilCartUsr, txtFiTipUsr: txtFiTipUsr };
        console.log(dataSet);
        if (txtFilRutUsr == "" || txtFilNomUsr == "" || txtFilPatUsr == "" || txtFilMayUsr == "" || txtFilCartUsr == 0 || txtFiTipUsr == 0 ) {
        
            alertify.alert('Usuarios', 'Debe completar todos los campos para continuar.', function(){ alertify.success('OK'); });

        }else{ 

           if(Fn.validaRut(txtFilRutUsr)){ 

                if (txtIdUsuario == 0) {

                    grabaUsuario(JSON.stringify(dataSet));

                } else {
                    actualizaUsuario(JSON.stringify(dataSet));
                }

            }else{

                 alertify.alert('Usuario', 'El rut ingresado no es valido o no cumple con el formato.', function(){ alertify.success('OK'); });

            }
           
        }

    });

    $("#btnCreaProducto").click(function(){

        var txtDescProd = $("#txtDescProd").val(),
            txtStockMin = $("#txtStockMin").val(),
            txtStockMax = $("#txtStockMax").val(),
            txtStockIni = $("#txtStockIni").val(),
            txtProdCarn = $("#txtProdCarn").val(),
            filImgProd  = $("#filImgProd").val(),
            txtPreProd = $("#txtPreProd").val();
            txtIdProducto = $("#txtIdProducto").val();

        if(txtIdProducto == 0){ 

            if (txtDescProd == "" || txtStockMin == "" || txtStockMax == "" || txtStockIni == "" || txtProdCarn == "" || filImgProd == "" || txtPreProd == "" ) {
            
                alertify.alert('Productos', 'Debe completar todos los campos para continuar.', function(){ alertify.success('OK'); });

            }else{ 

                var formData = new FormData($("#formCreaProducto")[0]); 
                
                $.ajax({
                    url: 'controller/controlProductos.php',  
                    type: 'POST',
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(e){

                        console.log(e);
                        if(e == 0){
                            alertify.alert('Productos', 'Hubo un problema al crear el producto, contactese con un administrador.', function(){ alertify.success('OK'); });

                        }else{
                            alertify.alert('Productos', 'Producto creado con exito, ID: '+e, function(){ 
                                alertify.success('OK'); 
                                    $("#txtIdProducto").val(0);
                                    $("#txtDescProd").val("");
                                    $("#txtStockMin").val("");
                                    $("#txtStockMax").val("");
                                    $("#txtStockIni").val("");
                                    $("#txtPreProd").val("");
                                    $("#txtProdCarn").empty();
                                    $("#filImgProd").val("");
                                    cargaSelectCarniceria(0);

                            });

                        }                 
                    }
                });
            }

        }else{

            if (txtDescProd == "" || txtStockMin == "" || txtStockMax == "" || txtStockIni == "" || txtProdCarn == "" || txtPreProd == "" ) {
            
                alertify.alert('Productos', 'Debe completar todos los campos para continuar.', function(){ alertify.success('OK'); });

            }else{ 

                var dataSet = { txtDescProd: txtDescProd, txtStockMin: txtStockMin, txtStockMax: txtStockMax, txtStockIni: txtStockIni, txtProdCarn: txtProdCarn, txtPreProd: txtPreProd, txtIdProducto: txtIdProducto };
                
                actualizaProducto(JSON.stringify(dataSet));
            }
        }
        

    });

    $("#btnListaProductos").click(function(){

        var prod  = $("#txtFilNomProducto").val();
        $("#dvTableUsuarios").fadeOut("fast");
        listaProductos(prod);

    });


    $("#btn-busca-reportes").click(function(){

        var desde = $("#txtFilRepDesde").val(),
            hasta = $("#txtFilRepHasta").val();



        if (desde != "" && hasta != "") {

            if (desde.valueOf() > hasta.valueOf()) {

                alertify.alert('Reportes', 'La fecha hasta, no puede ser inferior a la fecha desde.', function(){ alertify.success('OK'); });

            }else{

                generaReporteVentas(desde, hasta);

            }

        }else{
            generaReporteVentas(desde, hasta);
        }

    });
    
});

function ocultarVaciar(){

    $("#dvReporteMinimo").hide();
    $("#dvReporteMaximo").hide();
    $("#dvFormUsuarios").hide();
    $("#dvProductos").hide()
    $("#dvParametros").hide();
    $("#dvReporteVenta").hide();
    $("#dvInicioEstadisticas").hide();
    $("#dvSelecionaReporteVenta").hide();
    $("#dvFormProductos").hide();
    $("#dvTableUsuarios").empty();
    $("#dvTableProductos").empty();
    $("#filSelTipoUsr").empty();

}

function editarUsuario(id){

    $("#lblUsuarios").text("Editar Usuario");
    $("#txtFilRutUsrCrea").val();
    $("#txtFilNomUsr").val();
    $("#txtFilPatUsr").val();
    $("#txtFilMayUsr").val();
    $("#txtFilCartUsr").val();
    $("#txtFiTipUsr").val();
    $("#txtIdUsuario").val(id);

    cargaSelectCarniceria(2);
    cargaSelectTipoUsr();

    $.ajax({
        type: 'POST',
        url: 'controller/controlUsuarios.php',  
        data:{
                proceso: "editaUsuarios",
                id: id
             }, 
        cache: false,
        success: function(e){

            console.log(e);
            var data = JSON.parse(e);

            $("#txtFilRutUsrCrea").val(data[0]);
            $("#txtFilNomUsr").val(data[1]);
            $("#txtFilPatUsr").val(data[2]);
            $("#txtFilMayUsr").val(data[3]);
           
            $("#txtFilCartUsr option[value='"+data[4]+"']").attr("selected", true);
            $("#txtFiTipUsr option[value='"+data[5]+"']").attr("selected", true);

        }
    });

}

function nuevoUsuario(){

    $("#txtIdUsuario").val(0);
    $("#txtFilRutUsrCrea").val("");
    $("#txtFilNomUsr").val("");
    $("#txtFilPatUsr").val("");
    $("#txtFilMayUsr").val("");
    $("#txtFilCartUsr").empty();
    $("#txtFiTipUsr").empty();
    $("#lblUsuarios").text("Nuevo Usuario");
    cargaSelectCarniceria(2);
    cargaSelectTipoUsr();

}

function grabaUsuario(dataSet){

    $.ajax({
        type: 'POST',
        url: 'controller/controlUsuarios.php',  
        data:{
                proceso: "grabaUsuario",
                set: dataSet
             }, 
        cache: false,
        success: function(e){

            console.log(e);
            if (e == 1) {

                alertify.alert('Usuarios', 'Usuario creado correctamente.', function(){ alertify.success('OK'); });

            }else{
                alertify.alert('Usuarios', 'Hubo un problema al crear el usuario, favor contactese con un administrador.', function(){ alertify.success('OK'); });
            }
            

        }
    });

}

function cargaSelectTipoUsr(){

    $.ajax({
        type: 'POST',
        url: 'controller/controlUsuarios.php',  
        data:{
                proceso: "cargaSelectTipoUsr"
             }, 
        cache: false,
        success: function(e){

            console.log(e);
            $("#txtFiTipUsr").append(e);
            $("#filSelTipoUsr").append(e);

        }
    });

}

function cargaSelectCarniceria(inpt){

    $.ajax({
        type: 'POST',
        url: 'controller/controlProductos.php',  
        data:{
                proceso: "cargaSelectCarniceria"
             }, 
        cache: false,
        success: function(e){

            if (inpt == 0) {
           
                $("#txtProdCarn").append(e);

            }else{

                $("#txtFilCartUsr").append(e);
            }
          
        }
    });

}

function nuevoProducto(){

    $("#txtIdProducto").val(0);
    $("#txtDescProd").val("");
    $("#txtStockMin").val("");
    $("#txtStockMax").val("");
    $("#txtStockIni").val("");
    $("#txtPreProd").val("");
    $("#txtProdCarn").empty();
    $("#filImgProd").val("");
    $(".divImgProd").show();
    $("#lblProducto").text("Nuevo Producto");

    cargaSelectCarniceria(0);
   
}

function editarProducto(id){

    $("#txtIdProducto").val(id);
    $("#txtDescProd").val("");
    $("#txtStockMin").val("");
    $("#txtStockMax").val("");
    $("#txtStockIni").val("");
    $("#txtPreProd").val("");
    $("#txtProdCarn").empty();
    $("#filImgProd").val("");
    $(".divImgProd").hide();
    $("#lblProducto").text("Edita Producto");

    cargaSelectCarniceria(0);

    $.ajax({
        type: 'POST',
        url: 'controller/controlProductos.php',  
        data:{
                proceso: "editaProductos",
                id: id
             }, 
        cache: false,
        success: function(e){
            var data = JSON.parse(e);
            console.log(JSON.parse(e));

            $("#txtDescProd").val(data[0]);
            $("#txtStockMin").val(data[1]);
            $("#txtStockMax").val(data[2]);
            $("#txtStockIni").val(data[3]);
            $("#txtPreProd").val(data[4]);
           
            $("#txtProdCarn option[value='"+data[5]+"']").attr("selected", true);

        }
    });

}
                                                
function listaProductos(prod){

    $.ajax({
        type: 'POST',
        url: 'controller/controlProductos.php',  
        data:{
                proceso: "listaProductos",
                produc: prod
             }, 
        cache: false,
        success: function(e){

            $("#dvTableProductos").empty();
            $("#dvTableProductos").append(e);


            $('#tblProductos').DataTable( {
                dom: 'Bfrtip',
                buttons: ['excel'],
                "order": [[ 0, "desc" ]],
                "searching": true,
                "autoWidth": true,
                colReorder: {order: [0]}
            
            });

            $("#dvTableProductos").fadeIn("slow");
          
        }
    });

}

function actualizaProducto(dataSet){

    $.ajax({
        type: 'POST',
        url: 'controller/controlProductos.php',  
        data:{
                proceso: "actualizaProductos",
                dataSet: dataSet
             }, 
        cache: false,
        success: function(e){

            if (e == 0) {

                alertify.alert('Productos', 'Hubo un problema al actualizar el producto, contáctese con un administrador.', function(){ 
                    alertify.success('OK'); 
                });

            }else{

                alertify.alert('Productos', 'Producto actualizado con exito.', function(){ 
                    alertify.success('OK'); 
                    var prod  = $("#txtFilNomProducto").val();
                    listaProductos(prod)
                   
                });

            }   
           
        }
    });
}

function listaUsuarios(rut, tipo){

    $.ajax({
        type: 'POST',
        url: 'controller/controlUsuarios.php',  
        data:{
                proceso: "listaUsuarios",
                rut: rut,
                tipo: tipo
             }, 
        cache: false,
        success: function(e){

            $("#dvTableUsuarios").empty();
            $("#dvTableUsuarios").append(e);

            $('#usuarioDataTable').DataTable( {
                dom: 'Bfrtip',
                buttons: ['excel'],
                "order": [[ 0, "desc" ]],
                "searching": true,
                "autoWidth": true,
                colReorder: {order: [0]}
            
            });

            $("#dvTableUsuarios").fadeIn("slow");

        }
    });
 
}

function actualizaUsuario(dataSet){

    console.log(dataSet);

    $.ajax({
        type: 'POST',
        url: 'controller/controlUsuarios.php',  
        data:{
                proceso: "actualizaCliente",
                set: dataSet
             }, 
        cache: false,
        success: function(e){

            if (e == 0) {

                alertify.alert('Usuarios', 'Hubo un problema al actualizar el usuario, contáctese con un administrador.', function(){ 
                    alertify.success('OK'); 
                });

            }else{

                alertify.alert('Usuarios', 'Usuario actualizado con exito.', function(){ 
                    alertify.success('OK'); 
                        var rut =  $("#txtFilRutUsr").val(),
                            tip =  $("#filSelTipoUsr").val();

                    listaUsuarios(rut, tip);

                });

            }   
           
        }
    });
}

function reporteStocktbl(tipo){

    $.ajax({
        type: 'POST',
        url: 'controller/controlReportes.php',  
        data:{
                proceso: "generaReportes",
                tipo: tipo
             }, 
        cache: false,
        success: function(e){

            if (tipo == 1) {

                $("#dvTableRepMinimo").empty();
                $("#dvTableRepMinimo").append(e);

                 $('#tblRepStock1').DataTable( {
                    dom: 'Bfrtip',
                    buttons: ['excel', 'pdf'],
                    "order": [[ 0, "desc" ]],
                    "searching": true,
                    "autoWidth": true,
                    colReorder: {order: [0]}
                });

            }else{

                $("#dvTableRepMaximo").empty();
                $("#dvTableRepMaximo").append(e);

                $('#tblRepStock2').DataTable( {
                    dom: 'Bfrtip',
                    buttons: ['excel', 'pdf'],
                    "order": [[ 0, "desc" ]],
                    "searching": true,
                    "autoWidth": true,
                    colReorder: {order: [0]}
                });

            }
          
        }
    });

}

function generaReporteVentas(desde, hasta){

    $.ajax({
        type: 'POST',
        url: 'controller/controlReportes.php',  
        data:{
                proceso: "generaReporteVentas",
                desde: desde,
                hasta: hasta
             }, 
        cache: false,
        success: function(e){
            console.log(e);
            $("#dvTableRepVtas").empty();
            $("#dvTableRepVtas").append(e);

            $('#tblRepVentas').DataTable( {
                dom: 'Bfrtip',
                buttons: ['excel', 'pdf'],
                "searching": true,
                "autoWidth": true
            });
          
        }
    });
}