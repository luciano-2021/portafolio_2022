$(function(){

	listaProductosCarro();

	$("#dvCarroMenu").hide(); 


	$("#tblCarroResumen").DataTable( {
        dom: 'Bfrtip',
        buttons: ['pdf'],
        "order": [[ 0, "asc" ]],
        "searching": true,
        "autoWidth": true,
        colReorder: {order: [0]}
    });

	$(".dt-buttons").remove(); 

	$(".dataTables_empty").remove();

	$("#menCatalogo").click(function(){
		ocultar();
		$("#dvCatalogoMenu").fadeIn();

	});

	$("#menCarro").click(function(){
		ocultar();
		$("#dvCarroMenu").fadeIn();

	});

	$("#btnAgragaCarro").click(function(){
		var stock  = $("#spnStock").text();
			id     = $("#txtIdProductoCArro").val(),
			compra = $("#txtQTYProducto").val(),
			nombre = $("#txtNomProductoModal").val(),
			precio = $("#txtpreProductoModal").val();

		if(parseInt(compra) > parseInt(stock)){
			alertify.alert('Carro de compra', 'La compra no puede superar el stock disponible.', function(){ alertify.success('OK'); });

		}else{
			cargaCarroCompra(id, compra, nombre, precio);
		}
	});

 });

function ocultar(){

	$("#dvCatalogoMenu").hide();
	$("#dvCarroMenu").hide();

}

function  cargaCarritoFunction(id, descripcion, stock, precio){

	$("#lblModalCarro").html(descripcion);
	$("#txtIdProductoCArro").val(id);
	$("#txtNomProductoModal").val(descripcion);
	$("#txtpreProductoModal").val(precio);
	$("#txtQTYProducto").val("");
	$("#spnStock").html(stock);

}

function listaProductosCarro(){

	$.ajax({
        type: 'POST',
        url: 'controller/controlCarroCompras.php',  
        data:{
                proceso: "listaProductosCarro"
             }, 
        cache: false,
        success: function(e){

            $("#containerCat").append(e);

        }
    });
}

var dataSet = Array();
var total = 0;

function cargaCarroCompra(id, compra, nombre, precio){

	var tr = "<tr id='tr"+id+"'>"+
                "<td><button class='btn btn-danger' onclick='eliminaTr("+id+", "+parseInt(compra)*parseInt(precio)+")'>X</button></td>"+
                "<td>"+nombre+"</td>"+
                "<td>"+compra+"</td>"+
                "<td>"+precio+"</td>"+
                "<td>"+parseInt(compra)*parseInt(precio)+"</td>"+
            "</tr>";

    $("#tblCarroResumenBody").append(tr);

    dataSet[id] = id+"|"+compra;
    var subtotal = parseInt($("#totalCompra").text()) + (parseInt(compra)*parseInt(precio));
    $("#totalCompra").text(subtotal);

    console.log(dataSet);
    alertify.alert('Carro de compra', 'Producto agregado con éxito.', function(){ 
    	alertify.success('OK'); 
    	$("#btnCierreModal").click();
    });

}

function eliminaTr(id, compra){

	$("#tr"+id).remove();
	dataSet.splice(id, 1);


	var subtotal = parseInt($("#totalCompra").text()) - parseInt(compra);
    $("#totalCompra").text(subtotal);
	
}

function terminaCompra(){
	
	var total = $("#totalCompra").text();
	
	if (parseInt(total) == 0) {
		
		alertify.alert('Carro de compra', 'No puede finalizar una compra en 0', function(){ 
	    	alertify.success('OK'); 
	    });

	}else{ 


	    alertify.confirm("¿Seguro que desea finalizar la compra?.",
		  function(){

		    $.ajax({
			        type: 'POST',
			        url: 'controller/controlCarroCompras.php',  
			        data:{
			                proceso: "generaCompra",
			                detalle: JSON.stringify(dataSet.filter(Boolean))
			             }, 
			        cache: false,
			        success: function(e){

			                if (e != 0 ) {

				            	alertify.alert('Carro de compra', 'Venta generada con éxtio, su Folio es:'+e+'. Continue para generar el comprobante.', function(){ 
							    	alertify.success('OK'); 
							    	var urls = "comprobante.php?comprobanteVentas="+e;
									window.open(urls, "", "menubar=yes, scrollbars=yes, statusbar=yes, tittlebar=yes, width=1000, height=700");          

							    });

				            }else{
				            	
				            	alertify.alert('Carro de compra', 'Hubo un error en la compra, favor contacte con un administrador', function(){ 
							    	alertify.success('OK'); 
							    });
				            }

			        }
			    });
		  },
		  function(){
		    alertify.error('Cancelado');
		  });
	}
}