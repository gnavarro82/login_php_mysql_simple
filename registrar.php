	<?php
		require 'database.php';
		$message='';

		//si los campos del metodo post no estan vacios
		if(!empty($_POST['email']) && !empty($_POST['password'])){
			$sql="INSERT INTO usuarios(email,password) VALUES(:email,:password)";

			//statemmet - prepare()ejecuta una consulta sql
			$stmt = $conexion->prepare($sql);
			//vincular datos 
			$stmt->bindParam(':email',$_POST['email']);
			//CIFRANDO DATOS
			$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
			$stmt->bindParam(':password',$password);

			if($stmt->execute()){
				$message = "Se ha creado un nuevo usuario";
			}else{
				$message = "Hubo un erro al crear el usuario";
			}

		}
	?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="assets/css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet"> 
</head>
<body>
	<?php
		require 'partials/header.php';
	?>
	<?php if(!empty($message)): ?>
	<p><?php $message ?> </p>
	<?php endif;?>
	
	<h1>Registrese</h1>
	<span>O <a href="login.php">Logeate</a></span>

	<form action="registrar.php" method="post" accept-charset="utf-8">
	<input type="text" name="email" placeholder="Ingresa tu correo">
	<input type="password" name="password" placeholder="Ingresa tu clave">
	<input type="password" name="confirm_password" placeholder="Confirma tu clave">
	<input type="submit" value="Enviar">
</body>
</html>