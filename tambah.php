<?php 
session_start();
if(!isset($_SESSION["login"])){
	header("Location: login.php");
}
require 'functions.php';
$conn = mysqli_connect("localhost", "root", "", "phpdasar");
if (isset($_POST["submit"])) {
	// ambil data setiap elemen
	
	// cek apakah data sudah ditambahkan
	if(tambah($_POST) > 0){
		echo "
			<script>
				alert('Data telah ditambahkan');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data gagal ditambahkan');
				document.location.href = 'tambah.php';
			</script>
		";
	}
	
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Tambah data mahasiswa</title>
	<style type="text/css">
		body{
			font-family: poppins;
		}
		input[type="file"]{
			font-family: poppins;
		}
		input{
			font-family: poppins;
			padding: 5px;
			border-radius: 10px;
			border-color: black;
			margin: 10px;
		}
		button{
			font-family: poppins;
			padding: 5px;
			padding-left: 10px;
			padding-right: 10px;
			border-color: black;
			background-color: white;
			border-radius: 30px;
		}
		button:hover{
			background-color: black;
			color: white;
		}
		li{
			list-style: none;
		}
	</style>
</head>
<body>
	<h1>Tambah data mahasiswa</h1>
	<form action="" method="post" enctype="multipart/form-data">
		<ul>
			<li>
				<label for="nim">NIM</label>
				<input type="text" name="nim" id="nim" autocomplete="off" required>
			</li>
			<li>
				<label for="nama">Nama</label>
				<input type="text" name="nama" id="nama" autocomplete="off" required>
			</li>
			<li>
				<label for="email">Email</label>
				<input type="text" name="email" id="email" autocomplete="off" required>
			</li>
			<li>
				<label for="jurusan">Jurusan</label>
				<input type="text" name="jurusan" id="jurusan" autocomplete="off" required>
			</li>
			<li>
				<label for="gambar">Gambar</label>
				<input type="file" name="gambar" id="gambar">
			</li>
			<li>
				<button type="submit" name="submit">Tambah Data</button>
			</li>
		</ul>
	</form>
</body>
</html>