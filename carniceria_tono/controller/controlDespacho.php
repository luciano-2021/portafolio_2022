<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("conexion/conexion_sql.php");

session_start();

if (isset($_SESSION["tpo"]) && $_SESSION["tpo"] == 2) {

    $id     = $_SESSION["idu"];
    $nombre = $_SESSION["usr"];
    $rut    = $_SESSION["rut"];
    $tipo   = $_SESSION["tpo"];

	if(isset($_POST['proceso'])  && $_POST['proceso'] == "listaPendientes") {
		
		$data = listaPendientesControl();
		echo $data;
	}

	if(isset($_POST['proceso'])  && $_POST['proceso'] == "listaRealizados") {
		
		$data = listaRealizadosControl($id );
		echo $data;
	}

	if(isset($_POST['proceso'])  && $_POST['proceso'] == "despachar") {
		
		$data = grabaDespachoControl($_POST["id"], $id);
		echo $data;
	}



}

function listaPendientesControl(){

	$pdo = connect();

	$sql =" SELECT v.id_venta
				 , DATE_FORMAT(v.fecha_venta, '%d-%m-%Y')
			     , DATE_FORMAT(v.fecha_despacho, '%d-%m-%Y')
			     , UPPER(concat(c.nombre, ' ', c.apellidos_paterno))
			FROM ventas v JOIN clientes c ON (v.clientes_id_cliente = c.id_cliente)
			WHERE v.estado IS NULL
			ORDER BY v.id_venta ASC;";

	$tbl = "<table id='tblPendientes'>
				<thead>
					<tr>
						<th>ID</th>
						<th>FECHA VENTA</th>
						<th>FECHA DESPACHO</th>
						<th>CLIENTE</th>
						<th>ACCIÓN</th>
					</tr>
				</thead>
				<tbody>	";

	foreach ($pdo->query($sql) as $key ) {

    	$tbl .= " <tr>
					<td>".$key[0]."</td>
					<td>".$key[1]."</td>
					<td>".$key[2]."</td>
					<td>".$key[3]."</td>
					<td>
							<button type='button' class='btn btn-danger btn-sm mr-2' onclick='despachaVenta(".$key[0].")'> Despachar</button>&nbsp;
					</td>
				</tr>";

	}

	return $tbl."</tbody></table>";

}

function listaRealizadosControl($id ){

	$pdo = connect();

	$sql =" SELECT d.id_comprobante
				 , DATE_FORMAT(d.fecha, '%d-%m-%Y')
			     , d.ventas_id_venta
			     , concat(u.nombres, ' ', u.apellido_paterno)
			FROM despachos d JOIN usuario u ON(d.usuario_id_usuario = u.id_usuario)
			WHERE u.id_usuario =".$id ;



	$tbl = "<table id='tblRealizados'>
				<thead>
					<tr>
						<th>FOLIO</th>
						<th>FECHA VENTA</th>
						<th>ID VENTA</th>
						<th>DESPACHADOR</th>
					</tr>
				</thead>
				<tbody>	";

	foreach ($pdo->query($sql) as $key ) {

    	$tbl .= " <tr>
					<td>".$key[0]."</td>
					<td>".$key[1]."</td>
					<td>".$key[2]."</td>
					<td>".$key[3]."</td>
				</tr>";

	}

	return $tbl."</tbody></table>";


}

function grabaDespachoControl($id, $usr){

	$pdo = connect();

	$upd = "UPDATE ventas SET estado ='1' WHERE id_venta = :id";

	$ins = "INSERT INTO despachos(fecha, ventas_id_venta, usuario_id_usuario) VALUES (:fecha, :vid, :uid)";

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->beginTransaction();

	try{

		$sentencia = $pdo->prepare($upd);
		$sentencia->bindValue(":id"		, $id);
		$sentencia->execute();

		$sentencia = $pdo->prepare($ins);
		$sentencia->bindValue(":fecha"		, date('Y-m-d'));
		$sentencia->bindValue(":vid"		, $id);
		$sentencia->bindValue(":uid"		, $usr);
		$sentencia->execute();

		$pdo->commit();
		
		return 1;

	} catch (\Throwable $th) {

	    $pdo->rollBack() ;
	    return "Mensaje de Error: " . $th->getMessage();
	    //return 0;
	}





}
