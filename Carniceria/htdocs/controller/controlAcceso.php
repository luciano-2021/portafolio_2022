<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//session_destroy();
require_once("conexion/conexion_sql.php");

if(isset($_POST['proceso'])  && $_POST['proceso'] == "LoginUsuario") {
	
	$id = $_POST["id"];
	$psw = $_POST["psw"];

	$rut = explode("-", $id);

	$data = controlInicioSesion($rut[0], $psw);
	echo $data;

}

if(isset($_POST['proceso'])  && $_POST['proceso'] == "LoginUsuarioCliente") {
	
	$id = $_POST["id"];
	$psw = $_POST["psw"];

	$rut = explode("-", $id);

	$data = controlInicioSesionCliente($rut[0], $psw);
	echo $data;

}

if(isset($_POST['proceso'])  && $_POST['proceso'] == "cargaSelectRegCli") {
	
	$data = cargaSelcRegClienteNuevo();
	echo $data;

}

if(isset($_POST['proceso'])  && $_POST['proceso'] == "cargaSelectComCli") {
	
	$data = cargaSelcComClienteNuevo($_POST["reg"]);
	echo $data;

}

if (isset($_POST['proceso']) && $_POST["proceso"] == "registraCliente") {
	
	$data = registraClienteControl($_POST["data"]);
	echo $data;

}

function controlInicioSesion($user, $Pass){
    $pdo = connect();

    $pass = md5(trim($Pass));
    $user = trim($user);

    $sql = "SELECT id_usuario, concat(nombres, ' ', apellido_paterno), concat(rut,'-',dv), tipo_usuario_id_tipo_usr FROM usuario 
    		WHERE estado = '1' AND rut = :rut AND contrasenia = :pass";
    		
   	$sentencia = $pdo->prepare($sql);
	$sentencia->bindValue(":rut", $user);
	$sentencia->bindValue(":pass", $pass);
	$sentencia->execute();
	$data = $sentencia->fetch(PDO::FETCH_BOTH);
	
	if(!$data){
		return -1;
	}else{

		session_start();
		
		$_SESSION["idu"] = $data[0];
		$_SESSION["usr"] = $data[1];
		$_SESSION["rut"] = $data[2];
		$_SESSION["tpo"] = $data[3];

	}
  
}

function cargaSelcRegClienteNuevo(){

	$pdo = connect();

	$sqlReg = "SELECT id_region, nombre FROM region";

	$opt = "<option value='0'> - SELECCIONE - </option>";

	foreach ($pdo->query($sqlReg) as $key) {
		
		$opt .= "<option value='".$key[0]."'>".$key[1]."</option>";
	}

	return $opt;

}

function cargaSelcComClienteNuevo($idReg){

	$pdo = connect();

	$sqlCom = "SELECT id_comuna, descripcion FROM comuna WHERE region_id_region = ".$idReg;

	$opt = "<option value='0'> - SELECCIONE - </option>";

	foreach ($pdo->query($sqlCom) as $key) {
		
		$opt .= "<option value='".$key[0]."'>".$key[1]."</option>";
	}

	return $opt;

}

function registraClienteControl($data){

	$pdo = connect();

	$datos = json_decode($data);

	$cliNombre		= $datos->nomCli;
	$cliRut			= $datos->rutCli;
	$cliPaterno		= $datos->patCli;
	$cliMaterno		= $datos->matCli;
	$cliComuna		= $datos->comCli;
	$cliDireccion	= $datos->dirCli;
	$cliCorreo		= $datos->mailCli;
	$cliMovil		= $datos->movCli;
	$cliFijo		= $datos->fijCli;
	$cliPass1		= md5($datos->passCli);

	$rut = explode("-", $cliRut);

	$rutCli = $rut[0];
	$divCli = $rut[1];

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->beginTransaction();

	try{
		$sql = "INSERT INTO clientes(nombre, apellidos_paterno, apellido_materno, rut, dv, fono_fijo, direccion, fono_movil, contrasenia, estado, correo, fk_comuna) 
			VALUES (:nombre, :paterno, :materno, :rut, :dv, :fijo, :direccion, :movil, :pswd, :estado, :correo, :comuna)";

		$sentencia = $pdo->prepare($sql);

		$sentencia->bindValue(":nombre"		, $cliNombre);
		$sentencia->bindValue(":paterno"	, $cliPaterno);
		$sentencia->bindValue(":materno"	, $cliMaterno);
		$sentencia->bindValue(":rut"		, $rutCli);
		$sentencia->bindValue(":dv"			, $divCli);
		$sentencia->bindValue(":fijo"		, $cliFijo);
		$sentencia->bindValue(":direccion"	, $cliDireccion);
		$sentencia->bindValue(":movil"		, $cliMovil);
		$sentencia->bindValue(":pswd"		, $cliPass1);
		$sentencia->bindValue(":estado"		, "1");
		$sentencia->bindValue(":correo"		, $cliCorreo);
		$sentencia->bindValue(":comuna"		, $cliComuna);

		$sentencia->execute();
		$data = $pdo->lastInsertId();

		$pdo->commit();
		
		return $data;

	} catch (\Throwable $th) {

	    $pdo->rollBack() ;
	    //return "Mensaje de Error: " . $th->getMessage();
	    return 0;
	}

}

function controlInicioSesionCliente($user, $Pass){
    $pdo = connect();

    $pass = md5(trim($Pass));
    $user = trim($user);

    $sql = "SELECT id_cliente, concat(nombre, ' ', apellidos_paterno), concat(rut,'-',dv) FROM clientes  
    		WHERE estado = '1' AND rut = :rut AND contrasenia = :pass";
    		
   	$sentencia = $pdo->prepare($sql);
	$sentencia->bindValue(":rut", $user);
	$sentencia->bindValue(":pass", $pass);
	$sentencia->execute();
	$data = $sentencia->fetch(PDO::FETCH_BOTH);
	
	if(!$data){
		return -1;
	}else{

		session_start();
		
		$_SESSION["idu"] = $data[0];
		$_SESSION["usr"] = $data[1];
		$_SESSION["rut"] = $data[2];
		$_SESSION["tpo"] = "3";

	}
  
}
?>