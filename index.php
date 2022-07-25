<?php 
session_start();
if(!isset($_SESSION["login"])){
	header("Location: login.php");
}

require 'functions.php';

// pagination
// konfigurasi

// if(isset($_POST["tampildata"])){
// 	$nTampil = $_POST["tampil"];
// }

$nDataPerPage = (isset($_POST["tampildata"])) ? $_POST['tampil']: 3;
$nData = count(query("SELECT * FROM datamhs"));
$nPage = ceil($nData / $nDataPerPage);
$pageAktif = (isset($_GET["page"])) ? $_GET["page"] : 1;
// halaman 2, awaldata = 2
$awalData = ($nDataPerPage * $pageAktif) - $nDataPerPage;


$mahasiswa = query("SELECT * FROM datamhs LIMIT $awalData, $nDataPerPage");

// tombol cari ditekan
if(isset($_POST["cari"])){
	$mahasiswa = cari($_POST["keyword"]);
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Halaman Admin</title>
	<style type="text/css">
		body{
			font-family: poppins;
		}
		.a{
			text-decoration: none;
			background-color: black;
			color: white;
			padding: 5px;
			padding-left: 10px;
			padding-right: 10px;
			border-radius: 5px;
		}
		.a:hover{
			color: black;
			background-color: white;
			border: 10;
			border-color: black;
		}
		table{
			border-color: black;
		}
		input{
			padding: 10px;
			border-radius: 30px;
			border-color: black;
			font-family: poppins;
		}
		button{
			background-color: black;
			color: white;
			padding: 10px;
			border-radius: 30px;
			border-color: black;
			font-family: poppins;
		}
		button:hover{
			background-color: white;
			color: black;
		}
		img{
			width: 60px;
			height: 60px;
			border-radius: 50%;
			padding: 10px;
			border-style: ;
			border-color: black;
		}
		.nav{
			background-color: black;
			color: white;
			padding: 10px;
			padding-bottom: 5px;
			padding-top: 5px;
			margin: 5px;
			text-decoration: none;
			border-radius: 5px;
		}
		.navnon{
			background-color: white;
			color: black;
			padding: 10px;
			padding-bottom: 5px;
			padding-top: 5px;
			margin: 5px;
			text-decoration: none;
			border-radius: 5px;
		}
		.navnon:hover{
			background-color: black;
			color: white;
		}
		select{
			padding: 10px;
			border-color: black;
			border-radius: 30px;
			font-family: poppins;
			margin: 10px;
		}
		.tampilkandata{
			margin: 20px;
		}
	</style>
</head>
<body>
<div class="head">
	<h1>Daftar Mahasiswa</h1>
	<h2>Selamat datang, Admin!</h2>
</div>

<a class="a" href="tambah.php" id="tambah">Tambah data mahasiswa</a><br><br>


<form action="" method="post">
	<input type="text" name="keyword" size="40" placeholder="Masukkan keyword pencarian..." autocomplete="off">
	<button type="submit" name="cari">Cari</button>
</form>
<br>
<!-- navigasi -->
<table>
	
<?php if($pageAktif > 1): ?>
	<a class="navnon" href="?page=<?= $pageAktif - 1 ;?>">&laquo;</a>
<?php endif; ?>
<?php for($i = 1; $i <= $nPage; $i++) :?>
	<?php if($i == $pageAktif): ?>
		<a class="nav" href="?page=<?= $i ;?>"><?= $i ;?></a>
	<?php else: ?>
		<a class="navnon" href="?page=<?= $i ;?>"><?= $i ;?></a>
	<?php endif; ?>
<?php endfor; ?>
<?php if($pageAktif < $nPage): ?>
	<a class="navnon" href="?page=<?= $pageAktif + 1 ;?>">&raquo;</a>
<?php endif; ?>
	<form class="tampilkandata"  action="" method="post">
	<select name="tampil">
		<option value="2">2</option>
		<option value="3">3</option>
		<option value="4">4</option>
	</select>
	<button type="submit" name="tampildata">Tampilkan</button>
</form>
</table>

<br>
<br>
<table border="1" cellpadding="10" cellspacing="0">
	<tr style="background-color: black; color: white;">
		<th>No.</th>
		<th>Aksi</th>
		<th>Foto</th>
		<th>NIM</th>
		<th>Nama</th>
		<th>Email</th>
		<th>Jurusan</th>
	</tr>
	<?php $i = 1; ?>
	<?php foreach($mahasiswa as $row) :?>
	<tr>
		<td><?php echo $i; ?></td>
		<td>
			<a class="a" href="ubah.php?id=<?php echo $row["id"];?>">Ubah</a> | 
			<a class="a" href="hapus.php?id=<?php echo $row["id"];?>" onclick="return confirm('yakin?');">Hapus</a>
		</td>
		<td><img src="img/<?php echo $row["gambar"]; ?>"></td>
		<td><?php echo $row["nim"]; ?></td>
		<td><?php echo $row["nama"]; ?></td>
		<td><?php echo $row["email"]; ?></td>
		<td><?php echo $row["jurusan"]; ?></td>
	</tr>
	<?php $i++; ?>
	<?php endforeach; ?>
</table>
<br>
<a class="a" href="logout.php">Logout</a>

</body>
</html>