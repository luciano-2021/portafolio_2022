<?php

function connect(){
	
	$db 	= 'ejemplo_bd1';
	$user 	= 'root';
	$pass 	= 'luciano2022';

		try{
			$conn = new PDO('mysql:host=localhost;dbname='.$db, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		}catch(PDOException $e){
			$conn = ("Error: " . $e->getMessage());

		}
	return $conn;
}


?>
