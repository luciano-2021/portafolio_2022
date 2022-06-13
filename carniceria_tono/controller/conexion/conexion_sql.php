<?php

function connect(){
	
	$db 	= 'ejemplo_bd1';
	$user 	= 'ejemplo_bd1';
	$pass 	= 'obl1[io_FsDGyf@o';

		try{
			$conn = new PDO('mysql:host=localhost;dbname='.$db, $user, $pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		}catch(PDOException $e){
			$conn = ("Error: " . $e->getMessage());

		}
	return $conn;
}


?>
