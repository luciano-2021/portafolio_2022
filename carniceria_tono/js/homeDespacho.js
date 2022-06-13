$(function(){

    listaPendientes();

    $("#menDespachosPen").click(function(){

        oculta();
        listaPendientes();
        $("#dvReporteDespachosPen").slideDown();


    });

    $("#menDespachosRea").click(function(){

        oculta();
        listaRealizados();
        $("#dvReporteDespachosRea").slideDown();


    });

});

function listaPendientes(){

    $.ajax({
        type: 'POST',
        url: 'controller/controlDespacho.php',  
        data:{
                proceso: "listaPendientes"
             }, 
        cache: false,
        success: function(e){

            console.log(e);

            $("#dvTblDespachosPen").empty();
            $("#dvTblDespachosPen").append(e);
            $('#tblPendientes').DataTable( {
                dom: 'Bfrtip',
                buttons: ['excel', 'pdf'],
                "order": [[ 0, "asc" ]],
                "searching": true,
                "autoWidth": true,
                colReorder: {order: [0]}
            });

        }
    });
}

function oculta(){

    $("#dvReporteDespachosPen").hide();
    $("#dvReporteDespachosRea").hide();
}

function listaRealizados(){

    $.ajax({
        type: 'POST',
        url: 'controller/controlDespacho.php',  
        data:{
                proceso: "listaRealizados"
             }, 
        cache: false,
        success: function(e){

            $("#dvTblDespachosRea").empty();
            $("#dvTblDespachosRea").append(e);
            $('#tblRealizados').DataTable( {
                dom: 'Bfrtip',
                buttons: ['excel', 'pdf'],
                "order": [[ 0, "asc" ]],
                "searching": true,
                "autoWidth": true,
                colReorder: {order: [0]}
            });

        }
    });
}

function despachaVenta(id){

    alertify.confirm('¿Seguro que desea marcar la venta como despachada?', 
        function(){ 
            //alertify.success('Ok') 
            $.ajax({
                type: 'POST',
                url: 'controller/controlDespacho.php',  
                data:{
                        proceso: "despachar",
                        id: id
                     }, 
                cache: false,
                success: function(e){
                    console.log(e);
                    if (e == 1) {
                        listaPendientes();
                    }else{
                       alertify.alert('Despachos', 'Hubo un problema al marcar como despachada la venta, contactese con un administrador.', function(){ alertify.success('OK'); }); 
                    }

                }
            });

        }, function(){ 
            alertify.error('Cambio no realizado.')
        }
    );

}   