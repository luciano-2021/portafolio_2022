<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once("conexion/conexion_sql.php");

if(isset($_POST['proceso'])  && $_POST['proceso'] == "listaProductosCarro") {
	

	$data = controlListaProdCarro();
	echo $data;

}

if(isset($_POST['proceso'])  && $_POST['proceso'] == "generaCompra") {
	
	$data = generaCompra(json_decode($_POST['detalle']));
	echo $data;

}

function controlListaProdCarro(){ 

	$pdo = connect();

	$sql = "SELECT id_prod, UPPER(descripcion), stock, foto, UPPER(detalle), precio FROM productos WHERE stock > 0;";

	$div = "";

	foreach ($pdo->query($sql) as $key ) {
		$div .= "<div class='containerCatd'>
				    <span class='nomProd' id='nomProd'>".$key[1]."</span>
				    <span><img src='".$key[3]."' class='imgCatalogo'></span>
				    <div class='spnDescirpt'>".$key[4]."</div>
				    <div class='spnValor'> $<span id='spnValNum'>".$key[5]."</span></div>
				    <span>
				        <button class='btn_catalogo_producto myButton' data-bs-toggle='modal' data-bs-target='#modalQTYCarro' id='btn_catalogo_producto' onclick='cargaCarritoFunction(".$key[0].",\"".$key[1]."\", ".$key[2].", ".$key[5].")'>AGREGAR</button>
				    </span>
				</div>";
	}

	return $div;

}

function generaCompra($dataSet){

	$pdo = connect();

	$total = 0;
	$iva   = 0;

	foreach ($dataSet as $key) {
		
		$data = explode("|", $key) ;

		$sql = "SELECT precio FROM productos WHERE id_prod =".$data[0];
		$precioProd = 0;

		foreach ($pdo->query($sql) as $jey) {
			$precioProd = $jey[0];
		}

		$total = $total + ($precioProd * $data[1]);
	}
	
	$date = date("d-m-Y");
	$despacho = strtotime($date."+ 3 days");
	$neto = ($total/119)*100;
	$iva  = $neto * 0.19;

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->beginTransaction();

	try{

		$ins = "INSERT INTO ventas(fecha_despacho, monto_tota_neto, iva, tipo_venta_id_tipo, clientes_id_cliente, forma_pago_id_pago, estado) 
				VALUES (:despacho, :total, :iva, :tipo, :cli, :fpago, :estado)";

		$sentencia = $pdo->prepare($ins);

		$sentencia->bindValue(":despacho"	, date("Y-m-d", $despacho));
		$sentencia->bindValue(":total"		, $neto);
		$sentencia->bindValue(":iva"		, $iva);
		$sentencia->bindValue(":tipo"		, "1");
		$sentencia->bindValue(":cli"		, $_SESSION["idu"]);
		$sentencia->bindValue(":fpago"		, '8');
		$sentencia->bindValue(":estado"		, NULL);

		$sentencia->execute();
		$venta = $pdo->lastInsertId();

		foreach ($dataSet as $ney) {

			$dato = explode("|", $ney) ;
			
			$insDetalle = "INSERT INTO prod_venta(cantidad, ventas_id_venta, productos_id_prod) 
					   		VALUES (:can, :venta, :prod)";

			$sentencia = $pdo->prepare($insDetalle);

			$sentencia->bindValue(":can"	, $dato[1]);
			$sentencia->bindValue(":venta"	, $venta);
			$sentencia->bindValue(":prod"	, $dato[0]);

			$sentencia->execute();

			$upd = "UPDATE productos SET stock = ( 
						SELECT data FROM (
							SELECT (stock - :vendido) as data FROM productos where id_prod = :id1) AS tabla) 
					WHERE id_prod = :id2";

			$sentencia = $pdo->prepare($upd);

			$sentencia->bindValue(":vendido", $dato[1]);
			$sentencia->bindValue(":id1"	, $dato[0]);
			$sentencia->bindValue(":id2"	, $dato[0]);

			$sentencia->execute();

		}

		$pdo->commit();
		
		return $venta;

	} catch (\Throwable $th) {

	    $pdo->rollBack() ;
	    return "Mensaje de Error: " . $th->getMessage();
	    //return 0;
	}
	
}
?>

