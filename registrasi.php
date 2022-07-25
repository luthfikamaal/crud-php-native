<?php 
require 'functions.php';
if(isset($_POST["register"])){

	if( registrasi($_POST) > 0){
		echo "<script>
				alert('User baru telah ditambahkan');
			</script>";
	} else {
		echo mysqli_error($conn);
	}
}



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Halaman Registrasi</title>
	<style type="text/css">
		body{
			font-family: poppins;
		}
		label{
			display: block;
		}
		button{
			padding: 15px;
			border: 1;
			border-color: black;
			border-radius: 30px;
			font-size: 18px;
			background-color: white;

		}
		button:hover{
			border-radius: 30px;
			background-color: black;
			color: white;
		}
		li{
			list-style: none;
			padding: 10px;
		}
		input{
			padding: 5px;
			border-radius: 15px;
			border-color: white;
			background-color: black;
			color: white;
			border: none;
		}
	</style>
</head>
<body>
	<h1>Halaman Registrasi</h1>

	<form action="" method="post">
		<ul>
			<li>
				<label for="username">Username :</label>
				<input type="text" name="username" id="username">
			</li>
			<li>
				<label for="password">Password : </label>
				<input type="password" name="password" id="password">
			</li>
			<li>
				<label for="password2">Konfirmasi password : </label>
				<input type="password" name="password2" id="password2">
			</li>
			<li>
				<button type="submit" name="register">Daftar</button>
			</li>
		</ul>
	</form>

</body>
</html>