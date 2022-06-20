<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("conexion/conexion_sql.php");

session_start();

if (isset($_SESSION["tpo"]) && $_SESSION["tpo"] == 1) {


	if (isset($_POST["proceso"]) && $_POST["proceso"] == "generaReportes") {
		
		$data = generaReporteTblControl($_POST["tipo"]);
		echo $data;
	}

	if (isset($_POST["proceso"]) && $_POST["proceso"] == "generaReporteVentas") {
		
		$data = generaReporteTblVentas($_POST["desde"], $_POST["hasta"]);
		echo $data;
	}



}

function generaReporteTblControl($tipo){

	$pdo = connect();

	$sql = "SELECT id_prod, descripcion, stock_minimo, stock, stock_maximo FROM productos ";

	if ($tipo == 1) {#minimo
		
		$sql .= " WHERE stock <= stock_minimo;";

		$tbl = "<table id='tblRepStock1'>
					<thead>
						<tr>
							<th>ID</th>
							<th>DESCRIPCIÓN</th>
							<th>STOCK MÍNIMO</th>
							<th>STOCK TOTAL</th>
						</tr>
					</thead>
					<tbody>	";
		foreach ($pdo->query($sql) as $key ) {

	    	$tbl .= " <tr>
						<td>".$key[0]."</td>
						<td>".strtoupper($key[1])."</td>
						<td>".$key[2]."</td>
						<td>".$key[3]."</td>
					</tr>";

    	}

	}else{

		$tbl = "<table id='tblRepStock2'>
					<thead>
						<tr>
							<th>ID</th>
							<th>DESCRIPCIÓN</th>
							<th>STOCK TOTAL</th>
							<th>STOCK MÁXIMO</th>
						</tr>
					</thead>
					<tbody>	";

		foreach ($pdo->query($sql) as $key ) {

	    	$tbl .= " <tr>
						<td>".$key[0]."</td>
						<td>".strtoupper($key[1])."</td>
						<td>".$key[3]."</td>
						<td>".$key[4]."</td>
					</tr>";

    	}

	}

    return $tbl."</tbody></table>";

}

function generaReporteTblVentas($desde, $hasta){

	$pdo = connect();

	$sql = "SELECT v.id_venta
				 , DATE_FORMAT(v.fecha_venta, '%d-%m-%Y')
			     , DATE_FORMAT(v.fecha_despacho, '%d-%m-%Y')
			     , DATE_FORMAT(v.fecha_entrega, '%d-%m-%Y')
			     , v.monto_tota_neto
			     , v.iva
			     , UPPER(t.descripcion)
			     , UPPER(concat(c.nombre, ' ', c.apellidos_paterno))
			     , UPPER(f.descripcion)
			FROM ventas v JOIN clientes c ON ( v.clientes_id_cliente = c.id_cliente)
			JOIN tipo_venta t ON (v.tipo_venta_id_tipo = t.id_tipo)
			JOIN forma_pago f ON (v.forma_pago_id_pago = f.id_pago)";

	if ($desde != "" && $hasta != "") {
		
		$sql .= " WHERE v.fecha_venta between DATE('".$desde."') AND DATE('".$hasta."') ";

	}else if ($hasta == "" && $desde != ""){

		$sql .= " WHERE v.fecha_venta >= DATE('".$desde."') ";

	}else if ($hasta != "" && $desde == ""){

		$sql .= " WHERE v.fecha_venta <= DATE('".$hasta."') ";

	}

	$sql .= " ORDER BY v.fecha_venta DESC";


	$table = "	<table id='tblRepVentas' class='tblRepVentas display compact'>
					<thead>
						<tr>
							<th>NRO</th>
							<th>ID</th>
							<th>FECHA VENTA</th>
							<th>FECHA DESPACHO</th>
							<th>FECHA ENTREGA</th>
							<th>NETO</th>
							<th>IVA</th>
							<th>TOTAL</th>
							<th>COMPROBANTE</th>
							<th>CLIENTE</th>
							<th>FORMA DE PAGO</th>
						</tr>
					</thead>
					<tbody>";

	$i = 1;
	foreach ($pdo->query($sql) as $key) {
		
		$table .= 	"<tr>
						<td>".$i."</td>
						<td>".$key[0]."</td>
						<td>".$key[1]."</td>
						<td>".$key[2]."</td>
						<td>".$key[3]."</td>
						<td>".$key[4]."</td>
						<td>".$key[5]."</td>
						<td>".$key[5]."</td>
						<td>".$key[6]."</td>
						<td>".$key[7]."</td>
						<td>".$key[8]."</td>
					</tr>";

		$i++;

		$sql2 = "SELECT UPPER(p.descripcion)
					  , pv.cantidad
				 FROM prod_venta pv JOIN ventas v ON (pv.ventas_id_venta = v.id_venta)
				 JOIN productos p ON (pv.productos_id_prod = p.id_prod)
				 WHERE v.id_venta = ".$key[0];

		foreach ($pdo->query($sql2) as $val) {

			$table .= " <tr>
							<td>".$i."</td>
							<td></td>
							<td></td>
							<td>".$val[0]."</td>
							<td>".$val[1]."</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>";
			$i++;
			
		}

		

	}

	return $table."</tbody></table>";

}

?>

