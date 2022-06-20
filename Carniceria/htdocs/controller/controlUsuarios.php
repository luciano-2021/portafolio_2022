<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("conexion/conexion_sql.php");

session_start();

if (isset($_SESSION["tpo"]) && $_SESSION["tpo"] == 1) {
    
    $id     = $_SESSION["idu"];
    $nombre = $_SESSION["usr"];
    $rut    = $_SESSION["rut"];
    $tipo   = $_SESSION["tpo"];

    if(isset($_POST['proceso'])  && $_POST['proceso'] == "cargaSelectTipoUsr") {
		
		$data = cargaSelTipoUsrControl();
		echo $data;

	}

	if(isset($_POST['proceso'])  && $_POST['proceso'] == "grabaUsuario") {
		
		$data = grabaUsuarioControl($_POST['set']);
		echo $data;

	}

	if(isset($_POST['proceso'])  && $_POST['proceso'] == "listaUsuarios") {
		
		$data = listaUsuariosControl($_POST['rut'], $_POST["tipo"]);

		echo $data;

	}

	if(isset($_POST['proceso'])  && $_POST['proceso'] == "editaUsuarios") {
		
		$dataSet = editaUsuariosControl($_POST['id']);

		echo $dataSet;

	}

	if(isset($_POST['proceso'])  && $_POST['proceso'] == "actualizaCliente") {
		
		$data = actualizaUsuarioControl($_POST['set']);
		echo $data;

	}

}else{

    session_destroy();
    header("Location: http://sistema.carniceriatono.cl/login.php");
    
}

function cargaSelTipoUsrControl(){

	$pdo = connect();

	$sqlReg = "SELECT id_tipo_usr, descripcion FROM tipo_usuario";

	$opt = "<option value='0'> - SELECCIONE - </option>";

	foreach ($pdo->query($sqlReg) as $key) {
		
		$opt .= "<option value='".$key[0]."'>".$key[1]."</option>";
	}

	return $opt;

}

function grabaUsuarioControl($set){

	$pdo = connect();

	$data = json_decode($set);

	$txtIdUsuario = strtoupper($data->txtIdUsuario);
	$txtFilRutUsr = $data->txtFilRutUsr;
	$txtFilNomUsr = strtoupper($data->txtFilNomUsr);
	$txtFilPatUsr = strtoupper($data->txtFilPatUsr);
	$txtFilMayUsr = strtoupper($data->txtFilMayUsr);
	$txtFilCartUsr = $data->txtFilCartUsr;
	$txtFiTipUsr = $data->txtFiTipUsr;

	$rut = explode("-", $txtFilRutUsr);
	$pass = md5($rut[0]);

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->beginTransaction();

	try{

		$sql = "INSERT INTO usuario(nombres, apellido_paterno, apellido_materno, rut, dv, estado, contrasenia, tipo_usuario_id_tipo_usr, carniceria_id_carniceria) 
				VALUES  (:nom, :pat, :mat, :rut, :dv, :est, :pasw, :tus, :cis)";


		$sentencia = $pdo->prepare($sql);
		$sentencia->bindValue(":nom"		, $txtFilNomUsr);
		$sentencia->bindValue(":pat"		, $txtFilPatUsr);
		$sentencia->bindValue(":mat"		, $txtFilMayUsr);
		$sentencia->bindValue(":rut"		, $rut[0]);
		$sentencia->bindValue(":dv"			, $rut[1]);
		$sentencia->bindValue(":est"		, "1");
		$sentencia->bindValue(":pasw"		, $pass);
		$sentencia->bindValue(":tus"		, $txtFiTipUsr);
		$sentencia->bindValue(":cis"		, $txtFilCartUsr);

		$sentencia->execute();
		$pdo->commit();
		
		return 1;

	} catch (\Throwable $th) {

	    $pdo->rollBack() ;
	    return "Mensaje de Error: " . $th->getMessage();
	    //return 0;
	}

}

function listaUsuariosControl($rut, $tipo){

	$pdo = connect();

	$sql = "SELECT u.id_usuario, concat(nombres, ' ', apellido_paterno, ' ', apellido_materno), concat(rut, '-', dv), estado, t.descripcion 
			FROM usuario u JOIN tipo_usuario t ON (u.tipo_usuario_id_tipo_usr = t.id_tipo_usr) ";

	$rt = explode("-", $rut);

	if ($rut != "" || $tipo != 0) {

		$sql .= " wHERE ";

		$sw = 0;

		if ($rut != "") {

			$sw = 1;
			$sql .= " u.rut =".$rt[0];

		}

		if ($tipo != 0) {

			if ($sw == 1) {
				$sql .= " AND ";
			}

			$sql .= " t.id_tipo_usr =".$tipo;

		}

	}

	$table = "<table id='usuarioDataTable' class='display compact' >
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOMBRE</th>
                            <th>RUT</th>
                            <th>ESTADO</th>
                            <th>TIPO</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                    <tbody>";

	$tableBody = "";

	foreach ($pdo->query($sql) as $key ) {

    	$tableBody .= " <tr>
	    					<td>".$key[0]."</td>
	    					<td>".$key[1]."</td>
	    					<td>".$key[2]."</td>
	    					<td>".$key[3]."</td>
	    					<td>".$key[4]."</td>
	    					<td>
	    						<button type='button' class='btn btn-danger btn-sm mr-2' data-bs-toggle='modal' data-bs-target='#btnnuevousuario' onclick='editarUsuario(".$key[0].")'>Editar</button>
	    					</td>
	    				</tr>";

    }

    if ($tableBody == "") {

    	$tableBody = "<tr><td colspan='6'>Búsqueda sin resultados</td></th></tbody></table>";
    	return $table.$tableBody;

    }else{

    	return $table.$tableBody."</tbody></table>";

    }

}

function editaUsuariosControl($id){

	$pdo = connect();

	$sql = "SELECT concat(rut, '-', dv), nombres, apellido_paterno, apellido_materno, tipo_usuario_id_tipo_usr, carniceria_id_carniceria 
			FROM usuario 
			WHERE id_usuario = ".$id;

	$pila = array();

	foreach ($pdo->query($sql) as $key) {
		
		array_push($pila, $key[0], $key[1], $key[2], $key[3], $key[4], $key[5]);

	}

	return json_encode($pila);


}

function actualizaUsuarioControl($set){

	$pdo = connect();

	$data = json_decode($set);

	$txtIdUsuario = $data->txtIdUsuario;
	$txtFilRutUsr = $data->txtFilRutUsr;
	$txtFilNomUsr = strtoupper($data->txtFilNomUsr);
	$txtFilPatUsr = strtoupper($data->txtFilPatUsr);
	$txtFilMayUsr = strtoupper($data->txtFilMayUsr);
	$txtFilCartUsr = $data->txtFilCartUsr;
	$txtFiTipUsr = $data->txtFiTipUsr;

	$rut = explode("-", $txtFilRutUsr);

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->beginTransaction();

	try{

		$sql = "UPDATE usuario SET 
						  nombres = :nom
						, apellido_paterno = :pat
						, apellido_materno = :mat
						, rut = :rut
						, dv = :dv
						, tipo_usuario_id_tipo_usr = :tus
						, carniceria_id_carniceria = :cid 
				WHERE id_usuario = :idu ;";

		$sentencia = $pdo->prepare($sql);

		$sentencia->bindValue(":nom"		, $txtFilNomUsr);
		$sentencia->bindValue(":pat"		, $txtFilPatUsr);
		$sentencia->bindValue(":mat"		, $txtFilMayUsr);
		$sentencia->bindValue(":rut"		, $rut[0]);
		$sentencia->bindValue(":dv"			, $rut[1]);
		$sentencia->bindValue(":tus"		, $txtFiTipUsr);
		$sentencia->bindValue(":cid"		, $txtFilCartUsr);
		$sentencia->bindValue(":idu"		, $txtIdUsuario);

		$sentencia->execute();
		$pdo->commit();
		
		return 1;

	} catch (\Throwable $th) {

	    $pdo->rollBack() ;
	    return "Mensaje de Error: " . $th->getMessage();
	    //return 0;
	}



}

?>