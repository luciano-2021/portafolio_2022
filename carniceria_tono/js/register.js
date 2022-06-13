$(function(){

    cargaSelect();

    var Fn = {
        // Valida el rut con su cadena completa "XXXXXXXX-X"
        validaRut : function (rutCompleto) {
            if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test( rutCompleto ))
                return false;
            var tmp 	= rutCompleto.split('-');
            var digv	= tmp[1]; 
            var rut 	= tmp[0];
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


    $("#btnCreaCuenta").click(function(){

        var txtRegCliNombre     = $("#txtRegCliNombre").val(),
            txtRegCliRut        = $("#txtRegCliRut").val(),
            txtRegCliPaterno    = $("#txtRegCliPaterno").val(),
            txtRegCliMaterno    = $("#txtRegCliMaterno").val(),
            txtRegCliRegion     = $("#txtRegCliRegion").val(),
            txtRegCliComuna     = $("#txtRegCliComuna").val(),
            txtRegCliDireccion  = $("#txtRegCliDireccion").val(),
            txtRegCliCorreo     = $("#txtRegCliCorreo").val(),
            txtRegCliMovil      = $("#txtRegCliMovil").val(),
            txtRegCliFijo       = $("#txtRegCliFijo").val(),
            txtRegCliPass1      = $("#txtRegCliPass1").val(),
            txtRegCliPass2      = $("#txtRegCliPass2").val();

        if(txtRegCliNombre == "" || txtRegCliRut    == "" || txtRegCliPaterno    == "" || txtRegCliMaterno    == "" || txtRegCliRegion == "0" || txtRegCliComuna == "0" || txtRegCliDireccion  == "" || txtRegCliCorreo == "" || txtRegCliMovil  == "" || txtRegCliFijo   == "" || txtRegCliPass1  == "" || txtRegCliPass2  == ""){
            
            alertify.alert('Registro Clientes', 'Debe ingresar todos los campos para continuar.', function(){ alertify.success('Datos Incompletos'); });

        }else{

            if(Fn.validaRut(txtRegCliRut)){
                
                if (txtRegCliPass1 == txtRegCliPass2) {
                   
                    var data = {nomCli:txtRegCliNombre, rutCli:txtRegCliRut, patCli:txtRegCliPaterno, matCli:txtRegCliMaterno, regCli:txtRegCliRegion, comCli:txtRegCliComuna, dirCli:txtRegCliDireccion, mailCli:txtRegCliCorreo, movCli:txtRegCliMovil, fijCli:txtRegCliFijo, passCli:txtRegCliPass1};
                    //console.log(data);
                    registraCliente(JSON.stringify(data));

                }else{

                    alertify.alert('Registro Clientes', 'Las contraseñas ingresadas no son identicas, vuelva a intentarlo.', function(){ alertify.success('OK'); });

                }
                
            }else{
                alertify.alert('Registro Clientes', 'El rut ingresado no es valido o no cumple con el formato.', function(){ alertify.success('OK'); });

            }
           
        }

    });

    $("#txtRegCliRegion").change(function(){
        var data = $(this).val();

        $.ajax({
            type: 'POST',
            url: 'controller/controlAcceso.php',  
            data:{
                    proceso: "cargaSelectComCli",
                    reg: data
                 }, 
            cache: false,
            success: function(e){
               console.log(e);
               $("#txtRegCliComuna").empty();
               $("#txtRegCliComuna").append(e);
              
            }
        });
    });


    var numeros = '1234567890';
    var decimal = '1234567890.';
    var letras  = 'qwertyuiopasdfghjklzxcvbnm'+
                  'QWERTYUIOPLKJHGFDSAZXCVBNM '+
                  'ÁÚÍÓÉáéúíó';

    var letras2 = 'qwertyuiopasdfghjklzxcvbnm'+
                  'QWERTYUIOPLKJHGFDSAZXCVBNM1234567890 ';

    //solo letras
    $('#txtRegCliNombre, #txtRegCliPaterno, #txtRegCliMaterno').keypress(function(e){
        var caracter = String.fromCharCode(e.which);
        if(letras.indexOf(caracter)<0)
            return false;       
    });


    //letras y numeros
    $('#txtRegCliDireccion' ).keypress(function(e){
        var letra = letras + numeros + '-';
        var caracter = String.fromCharCode(e.which);
        if(letra.indexOf(caracter)<0)
            return false;       
    });

    //solo numeros
    $('#txtRegCliMovil, #txtRegCliFijo' ).keypress(function(e){
        var letra = numeros;
        var caracter = String.fromCharCode(e.which);
        if(letra.indexOf(caracter)<0)
            return false;       
    });

    //correo electronico
    $('#txtRegCliCorreo').focusout(function(){
        var mail       = $(this).val(),
            emailRegex = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

        if (mail != '') {
            if (!emailRegex.test(mail)) {
                
                alertify.alert('Registro Clientes', 'Formato de correo electronico ingreado es incorrecto.', function(){ alertify.success('OK'); });

                $(this).val('');
                $(this).focus();
            } 
        }
    });


});


function registraCliente(data){
    //console.log(data);

     $.ajax({
        type: 'POST',
        url: 'controller/controlAcceso.php',  
        data:{
                proceso: "registraCliente",
                data: data
             }, 
        cache: false,
        success: function(e){
        
            if (!e) {

                console.log(e);
                alertify.alert('Registro Clientes', 'Hubo un problema al registrar el cliente, favor contactece con un administrador.', function(){ alertify.success('OK'); });

            }else{

                alertify.alert('Registro Clientes', 'Se registro correctamente el cliente con el ID: '+e, function(){
                    
                    alertify.success('OK');
                    window.location = "login.php?uidx=2";
                });
                
            }
          
          
        }
    });
}

function cargaSelect(){

    $.ajax({
        type: 'POST',
        url: 'controller/controlAcceso.php',  
        data:{
                proceso: "cargaSelectRegCli"
             }, 
        cache: false,
        success: function(e){
           //console.log(e);
           $("#txtRegCliRegion").append(e);
          
        }
    });

}

