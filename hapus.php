<?php 
session_start();
if(!isset($_SESSION["login"])){
	header("Location: login.php");
}
require 'functions.php';
$id = $_GET["id"];

if(hapus($id) > 0){
	echo "
			<script>
				alert('Data telah dihapus');
				document.location.href = 'index.php';
			</script>
		";
} else {
	echo "
			<script>
				alert('Data gagal dihapus');
				document.location.href = 'index.php';
			</script>
		";
}

?>