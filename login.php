<?php 

require 'functions.php';
session_start();

// cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
	$id = $_COOKIE['id'];
	$key = $_COOKIE['key'];

	$result = mysqli_query($conn. "SELECT username FROM user WHERE id = $id ");
	$row = mysqli_fetch_assoc($result);

	if($key === hash('sha256', $row['username'])){
		$_SESSION['login'] = true;
	}
}
 

if(isset($_SESSION["login"])){
	header("Location: index.php");
}

if(isset($_POST["login"])){

	$username = $_POST["username"];
	$password = $_POST["password"];

	$result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

	// cek username
	if(mysqli_num_rows($result) === 1){

		// cek password
		$row = mysqli_fetch_assoc($result);
		if (password_verify($password, $row["password"])){

			// set session
			$_SESSION["login"] = true;

			// cek remember me
			if(isset($_POST['remember'])){
				// buat cookie
				// 
				setcookie('id', $row['id'], time()+30);
				setcookie('key', hash('sha256', $row['username']), time()+30);
			}


			header("Location: index.php");
			exit;
		}
	}
	$error = true;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Halaman Login</title>
	<style type="text/css">
		body{
			font-family: poppins;
			background-color: #161616;
		}
		label{
			display: block;
		}
		h1{
			color: white;
			padding: 20px;
		}
		input{
			padding: 10px;
			border-radius: 20px;
			border-color: black;
			width: 150px;
			font-family: poppins;
		}
		button{
			padding: 10px;
			width: 100px;
			border-radius: 30px;
			font-family: poppins;
			font-size: 18px;
			background-color: #C84B31;
			border: 0;
			color: white;
			text-align: center;
		}
		button:hover{
			background-color: #346751;
		}
		li{
			list-style: none;
			padding: 10px;
			color: white;
		}
		label{
			padding: 10px;
		}
		form{ 
			width: 400px;
			color: white;
			text-align: center;
			margin: auto;
			border: 1;
			border-color: white;

		}
		
	</style>
</head>
<body>
	

	<?php if(isset($error)) :?>
		<p style="color: red; font-style: italic;">username / password salah</p>
	<?php endif; ?>
	<div class="form">
	<form action="" method="post">
		<h1>Halaman Login</h1>
				<label for="username">Username</label>
				<input type="text" name="username" id="username" placeholder="Enter Username">

				<label for="password">Password</label>
				<input type="password" name="password" id="password" placeholder="Enter Password">
				<br><br>
				<input type="checkbox" name="remember" id="remember">
				<label for="remember">Remember me</label>

				<button type="submit" name="login">Login</button>

	</form>
	</div>
</body>
</html>