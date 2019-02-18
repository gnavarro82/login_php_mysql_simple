<?php
	//iniciamos la sesion
	session_start();
	require 'database.php';
	//comprobar que el id esta dentro de la bbdd
	if(isset($_SESSION['user_id'])){
		$sql = "SELECT id,email,password FROM usuarios WHERE id=:id";
		$records = $conexion->prepare($sql);
		//vinculacion
		$records->bindParam(':id', $_SESSION['user_id']);
		$records->execute();
		//se guardam en resulst
		$results = $records->fetch(PDO::FETCH_ASSOC);
		$user = null;
		//comprobar que no este vacio
		if(count($results) > 0 ){
			$user = $results;	
		} 
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Bienvenidos a tu App</title>
	<link rel="stylesheet" href="assets/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
</head>
<body>
	<?php
		require 'partials/header.php';
	?>

	<?php if(!empty($user)): ?>
		<br>Bienvenido. <?= $user['email']; ?>
		<br>Estas satisfactoriamente Logeado
		<a href="logout.php">Salir</a> 
	<?php else: ?>
		<h1>Por favor Logese o Registrese</h1>	
		<a href="login.php">Login</a> O
		<a href="registrar.php">Registrese</a>
	<?php endif; ?>
	

</body>
</html>

