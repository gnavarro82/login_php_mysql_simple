<?php
	$server ="localhost";
	$username = "root";
	$password = "navarro";
	$database = "pruebaphp";

	try {
		$conexion = new PDO("mysql:host=$server;dbname=$database;",$username,$password);
	} catch (PDOException $e) {
		die("Problemas con la conexion".$e->getMessage());
	}

	 
?>