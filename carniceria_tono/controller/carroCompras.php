<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//session_destroy();
require_once("conexion/conexion_sql.php");

if(isset($_POST['proceso'])  && $_POST['proceso'] == "listaProductosCarro") {
	

	$data = controlListaProdCarro();
	echo $data;

}














function controlListaProdCarro(){ 

	$sql = "SELECT id_prod, descripcion, stock FROM productos WHERE stock > 0;";



}


?>