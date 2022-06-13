<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once("conexion/conexion_sql.php");

session_start();

if (isset($_SESSION["tpo"]) && $_SESSION["tpo"] == 1) {

    $id     =  $_SESSION["idu"];
    $nombre = $_SESSION["usr"];
    $rut    = $_SESSION["rut"];
    $tipo   = $_SESSION["tpo"];

	if(isset($_POST['proceso'])  && $_POST['proceso'] == "cargaSelectCarniceria") {
		
		$data = cargaSelCarniceria();
		echo $data;

	}

	if(isset($_POST['txtIdProducto'])  && $_POST['txtIdProducto'] == "0") {
		
		$txtStockMin = $_POST["txtStockMin"];
		$txtStockMax = $_POST["txtStockMax"];
		$txtStockIni = $_POST["txtStockIni"];
		$txtProdCarn = $_POST["txtProdCarn"];
		$file        = $_FILES['filImgProd']['name'];
		$txtDescProd = $_POST["txtDescProd"];
		$txtPreProd  = $_POST["txtPreProd"];

		$data = creaProductoControl($txtStockMin, $txtStockMax, $txtStockIni, $txtProdCarn, $txtDescProd, $txtPreProd);

		if($data != 0){

	        $directorio = "../img/catalogo/";
	        $dir2 		= "img/catalogo/";
	        $nameFile   = $data.".jpg";
	       
	        if ($nameFile && move_uploaded_file($_FILES['filImgProd']['tmp_name'], $directorio.$nameFile)){ 

	        	$data = actualizaFoto($dir2.$nameFile, $data);
	            echo $data;

	        }else{
	            echo 0;
	        }

		}else{
			echo 0;
		}
		
	}

	if(isset($_POST['proceso'])  && $_POST['proceso'] == "listaProductos") {

		$produc = $_POST["produc"];
		$dataSet = listaProductosControl($produc);
		echo $dataSet;

	}

	if(isset($_POST['proceso'])  && $_POST['proceso'] == "editaProductos") {

		$id = $_POST["id"];
		$dataSet = editaProductosControl($id);
		echo $dataSet;

	}

	if(isset($_POST['proceso'])  && $_POST['proceso'] == "actualizaProductos") {

		$dataSet = $_POST["dataSet"];
		$result = actualizaProductoControl($dataSet);
		echo $result;

	}

}else{
    session_destroy();
    header("Location: http://sistema.carniceriatono.cl/login.php");
    
}

function cargaSelCarniceria(){

	$pdo = connect();

	$sqlReg = "SELECT id_carniceria, nombre FROM carniceria";

	$opt = "<option value='0'> - SELECCIONE - </option>";

	foreach ($pdo->query($sqlReg) as $key) {
		
		$opt .= "<option value='".$key[0]."'>".$key[1]."</option>";
	}

	return $opt;

}

function creaProductoControl($txtStockMin, $txtStockMax, $txtStockIni, $txtProdCarn, $txtDescProd, $txtPreProd){

	$pdo = connect();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->beginTransaction();

	try{

		$sql = "INSERT INTO productos(descripcion, stock_minimo, stock_maximo, stock, precio, carniceria_id_carniceria) 
				VALUES (:des, :smin, :smax, :stk, :pre, :cid)";

		$sentencia = $pdo->prepare($sql);

		$sentencia->bindValue(":des"		, $txtDescProd);
		$sentencia->bindValue(":smin"		, $txtStockMin);
		$sentencia->bindValue(":smax"		, $txtStockMax);
		$sentencia->bindValue(":stk"		, $txtStockIni);
		$sentencia->bindValue(":cid"		, $txtProdCarn);
		$sentencia->bindValue(":pre"		, $txtPreProd);

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

function actualizaFoto($nameFile, $id){

	$pdo = connect();

	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->beginTransaction();

	try{

		$sql = "UPDATE productos SET foto='".$nameFile."' WHERE id_prod = ".$id;

		$pdo->exec($sql);
		$pdo->commit();
		
		return $id;

	} catch (\Throwable $th) {

	    $pdo->rollBack() ;
	    //return "Mensaje de Error: " . $th->getMessage();
	    return 0;
	}
}

function listaProductosControl($produc){

	$pdo = connect();

	$sql = "SELECT id_prod, descripcion, stock, stock_minimo, stock_maximo, precio FROM productos ";

	if ($produc != "") {
		$sql .= " WHERE descripcion like '%".$produc."%';";
	}

	$table = "<table id='tblProductos'>
				<thead>
					<tr>
						<th>ID</th>
						<th>DESCRIPCIÓN</th>
						<th>STOCK ACTUAL</th>
						<th>STOCK MÍNIMO</th>
						<th>STOCK MÁXIMO</th>
						<th>PRECIO</th>
						<th>ACCIÓN</th>
					</tr>
				</thead>
				<tbody>	";

	$tableBody = "";

	foreach ($pdo->query($sql) as $key ) {

    	$tableBody .= " <tr>
	    					<td>".$key[0]."</td>
	    					<td>".strtoupper($key[1])."</td>
	    					<td>".$key[2]."</td>
	    					<td>".$key[3]."</td>
	    					<td>".$key[4]."</td>
	    					<td>".$key[5]."</td>
	    					<td>
	    						<button type='button' class='btn btn-danger btn-sm mr-2' data-bs-toggle='modal' data-bs-target='#btnNuevoProducto' onclick='editarProducto(".$key[0].")'>Editar</button>&nbsp;
	    					</td>
	    				</tr>";

    }

    if ($tableBody == "") {

    	$tableBody = "<tr><td colspan='5'>Búsqueda sin resultados</td></th></tbody></table>";
    	return $table.$tableBody;

    }else{

    	return $table.$tableBody."</tbody></table>";

    }

}

function editaProductosControl($id){

	$pdo = connect();

	$sql = "SELECT descripcion, stock_minimo, stock_maximo, stock, precio, carniceria_id_carniceria
			FROM productos WHERE id_prod =".$id;

	$pila = array();

	foreach ($pdo->query($sql) as $key) {
		
		array_push($pila, $key[0], $key[1], $key[2], $key[3], $key[4], $key[5]);

	}

	return json_encode($pila);

}

function actualizaProductoControl($dataSet){

	$pdo = connect();

	$data = json_decode($dataSet);

	$txtDescProd = strtoupper($data->txtDescProd);
	$txtStockMin = $data->txtStockMin;
	$txtStockMax = $data->txtStockMax;
	$txtStockIni = $data->txtStockIni;
	$txtProdCarn = $data->txtProdCarn;
	$txtPreProd  = $data->txtPreProd;
	$txtIdProducto = $data->txtIdProducto;


	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$pdo->beginTransaction();

	try{

		$sql = "UPDATE productos 
				SET descripcion=:des
				, stock_minimo= :smin
				, stock_maximo= :smax
				, stock= :stock
				, precio= :prec
				, carniceria_id_carniceria= :carid 
				WHERE id_prod= :id";


		$sentencia = $pdo->prepare($sql);
		$sentencia->bindValue(":des"		, $txtDescProd);
		$sentencia->bindValue(":smin"		, $txtStockMin);
		$sentencia->bindValue(":smax"		, $txtStockMax);
		$sentencia->bindValue(":stock"		, $txtStockIni);
		$sentencia->bindValue(":prec"		, $txtPreProd);
		$sentencia->bindValue(":carid"		, $txtProdCarn);
		$sentencia->bindValue(":id"			, $txtIdProducto);
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