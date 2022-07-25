<?php 

// koneksi database
$conn = mysqli_connect("localhost", "root", "", "luthfikamal");

function query($query){
	global $conn; 
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function tambah($data){
	global $conn;
	$nim = htmlspecialchars($data["nim"]);
	$nama = htmlspecialchars($data["nama"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	
	// upload gambar
	$gambar = upload();
	if(!$gambar){
		return false;
	}

	$query = "INSERT INTO datamhs VALUES ('', '$nim', '$nama', '$email', '$jurusan', '$gambar')";

	// query insert data

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);

}

function upload(){
	$namaFile = $_FILES['gambar']['name'];
	$ukuranFile = $_FILES['gambar']['size'];
	$error = $_FILES['gambar']['error'];
	$tmpName = $_FILES['gambar']['tmp_name'];

	// cek
	if ($error === 4) {
		echo "<script>
			alert('Pilih gambar dulu gaiss')
		</script>


		";
		return false;
	}

	// cek gambar
	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));
	if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
		echo "<script>
			alert('yang anda upload bukan gambar');
		</script>
		";
		return false;
	}

	// cek ukuran gambar
	if($ukuranFile > 1000000){
		echo "<script>
			alert('ukuran gambar terlalu besar');
		</script>
		";
		return false;
	}

	// lolos pengecekan, gambar siap diupload
	// generate nama gambar baru
	$namaFileBaru = uniqid();
	$namaFileBaru .= '.';
	$namaFileBaru .= $ekstensiGambar;

	move_uploaded_file($tmpName, 'img/' . $namaFileBaru);
	return $namaFileBaru;
}

function hapus($id){
	global $conn;
	mysqli_query($conn, "DELETE FROM datamhs WHERE id = $id");
	return mysqli_affected_rows($conn);
}

function ubah($data){
	global $conn;
	$id = $data["id"];
	$nim = htmlspecialchars($data["nim"]);
	$nama = htmlspecialchars($data["nama"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$gambarLama = htmlspecialchars($data["gambarLama"]);

	// cek apakah upload gambar baru
	if($_FILES['gambar']['error'] === 4){
		$gambar = $gambarLama;
	} else {
		$gambar = upload();
	}


	$query = "UPDATE datamhs SET 
				nim = '$nim', nama = '$nama', email = '$email', jurusan = '$jurusan', gambar = '$gambar' WHERE id = $id;
			";

	// query insert data

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function cari($keyword){
	$query = "SELECT * FROM datamhs WHERE nama LIKE '%$keyword%' OR nim LIKE '%$keyword%' OR email LIKE '%$keyword%' OR jurusan LIKE '%$keyword%'";
	return query($query);
}

function registrasi($data){
	global $conn;
	$username = strtolower(stripslashes( $data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);


	// cek username sudah ada arau belum
	$result = mysqli_query($conn, "SELECT username FROM user WHERE username = '$username'");
	if(mysqli_fetch_assoc($result)){
		echo "<script>
				alert('username sudah terdaftar');
			</script>";
			return false;
	}

	// cek konfirmasi passwor
	if($password !== $password2){
		echo "<script>
				alert('Konfirmasi password tidak sesuai');
			</script>"; 
		return false;
	}
	// enskripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);
	mysqli_query($conn, "INSERT INTO user VALUES('', '$username', '','$password')");
	return mysqli_affected_rows($conn);


}


?>