$(function(){

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

    $("#button").click(function(){
        
        $("#form_inicio").slideUp("fast");
        $("#dv_registro").fadeIn("slow");
    });

    $("#btn_atras").click(function(){

        $("#form_inicio").slideDown("slow");
        $("#dv_registro").fadeOut("fast");

    });

    $("#btn_login").click(function(){

        var usr = $("#txtRutLogin").val(),
            psw = $("#txtPswLogin").val();

        if(usr == "" || psw == ""){
            
            alertify.alert('Inicio de Sesión', 'Debe ingresar un usuario y contraseña validos para continuar.', function(){ alertify.success('OK'); });

        }else{

            if(Fn.validaRut(usr)){
                ingresoUsuario(usr, psw);
            }else{
                alertify.alert('Inicio de Sesión', 'El rut ingresado no es valido o no cumple con el formato.', function(){ alertify.success('OK'); });

            }
           
        }
        
    });

    $("#btn_login_cliente").click(function(){

        var usr = $("#txtRutLogin").val(),
            psw = $("#txtPswLogin").val();

        if(usr == "" || psw == ""){
            
            alertify.alert('Inicio de Sesión', 'Debe ingresar un usuario y contraseña validos para continuar.', function(){ alertify.success('OK'); });

        }else{

            if(Fn.validaRut(usr)){
                ingresoUsuarioCliente(usr, psw);
            }else{
                alertify.alert('Inicio de Sesión', 'El rut ingresado no es valido o no cumple con el formato.', function(){ alertify.success('OK'); });

            }
           
        }
        
    });

});

function ingresoUsuario(usr, psw){
    
    $.ajax({
        type: 'POST',
        url: 'controller/controlAcceso.php',  
        data:{
                proceso: "LoginUsuario",
                id: usr,
                psw:psw
             }, 
        cache: false,
        success: function(e){
           console.log(e);

           if (e == -1) {

                alertify.alert('Inicio de Sesión', 'Usuario o contraseña incorrectos, por favor vuelva a intentarlo', function(){ alertify.success('Inicio de sesión fallido'); });
           }else{
                window.location = "home.php";
           }
        }
    });

}

function ingresoUsuarioCliente(usr, psw){
    
    $.ajax({
        type: 'POST',
        url: 'controller/controlAcceso.php',  
        data:{
                proceso: "LoginUsuarioCliente",
                id: usr,
                psw:psw
             }, 
        cache: false,
        success: function(e){
           console.log(e);

           if (e == -1) {

                alertify.alert('Inicio de Sesión', 'Usuario o contraseña incorrectos, Si no tiene una cuenta, favor registrese.', function(){ alertify.success('Inicio de sesión fallido'); });
           }else{
                window.location = "carroCompra.php";
           }
        }
    });

}

