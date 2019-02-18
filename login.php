<?php
	//las variables de session hay que iniciar el metodo
	session_start();

	if(isset($_SESSION['user_id'])){
		header('location: /loginfazt');  
	}

	require('database.php');
	//validar que los campos no este vacios
	if(!empty($_POST['email']) && !empty($_POST['password'] )){
		$sql = "SELECT id,email,password FROM usuarios WHERE email=:email";
		
		//obtenermos los datos del usuario desde la bbdd
		$records=$conexion->prepare($sql);
		

		//el parametro :email se reeplaza por lo que se optiene del metodo post
		$records->bindParam(':email', $_POST['email']); 
		$records->execute();  //ejecuta la consulta.
		//antes de enviar los parametros se ejecuta la consulta------
		

		//se obtiene los datos del usuario -- en un array
		$results = $records->fetch(PDO::FETCH_ASSOC);
		$message = '';

		//validar si el resultado no esta vacio---si es mayor a 0 no es vacia
		if(count($results) > 0 && password_verify($_POST['password'], $results['password'])){
			//password se obtiene de un hash
			//Asignar los datos en un SSESION---permite guardar un dato
			$_SESSION['user_id'] = $results['id']; //de los datos solo quiero el id
			//hay que redireccionarlo
		header('location: /loginfazt/login.php');  
	
		}else{ //si no  existe el usuario y la contraseña es incorrecta
			$message = "Lo siento, tus credenciales no coinciden.";
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
	<h1>Logeo</h1>
	<span>O <a href="registrar.php">Registrarse</a></span>
	
	<?php //si el mensaje no esta vacia
	if(!empty($message)):?>
	<p><?= $message ?></p>
	
	<?php endif; ?>	

	<form action="login.php" method="post" accept-charset="utf-8">
	<input type="text" name="email" placeholder="Ingresa tu correo">
	<input type="password" name="password" placeholder="Ingresa tu clave">
	<input type="submit" value="Enviar">

	</form>
</body>
</html>