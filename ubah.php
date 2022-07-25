<?php 
session_start();
if(!isset($_SESSION["login"])){
	header("Location: login.php");
}
require 'functions.php';

// ambil data di url
$id = $_GET["id"];

// query data mahasiswa berdasarkan id
$mhs = query("SELECT * FROM datamhs WHERE id = $id")[0];



if (isset($_POST["submit"])) {
	// ambil data setiap elemen

	
	// cek apakah data sudah ditambahkan
	if(ubah($_POST) > 0){
		echo "
			<script>
				alert('Data telah diubah');
				document.location.href = 'index.php';
			</script>
		";
	} else {
		echo "
			<script>
				alert('Data gagal diubah');
				document.location.href = 'index.php';
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
	<style>
		body{
			font-family: poppins;
		}
		input{
			font-family: poppins;
			padding: 5px;
			border-radius: 10px;
			border-color: black;
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
			padding:5px;
		}
	</style>
</head>
<body>
	<h1>Tambah data mahasiswa</h1>
	<form action="" method="post" enctype="multipart/form-data">
		<input type="hidden" name="id" value="<?php echo $mhs["id"]; ?>">
		<input type="hidden" name="gambarLama" value="<?php echo $mhs["gambar"]; ?>">
		<ul>
			<li>
				<label for="nim">NIM</label>
				<input type="text" name="nim" id="nim" required value="<?= $mhs["nim"];?>">
			</li>
			<li>
				<label for="nama">Nama</label>
				<input type="text" name="nama" id="nama" required value="<?= $mhs["nama"]; ?>">
			</li>
			<li>
				<label for="email">Email</label>
				<input type="text" name="email" id="email" required value="<?= $mhs["email"]; ?>">
			</li>
			<li>
				<label for="jurusan">Jurusan</label>
				<input type="text" name="jurusan" id="jurusan" required value="<?= $mhs["jurusan"]; ?>">
			</li>
			<li>
				<label for="gambar">Gambar</label>
				<img src="img/<?php echo $mhs['gambar']; ?>" style="width: 100px;">
				<input type="file" name="gambar" id="gambar">
			</li>
			<li>
				<button type="submit" name="submit">Ubah Data</button>
			</li>
		</ul>
	</form>
</body>
</html>