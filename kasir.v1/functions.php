<?php 

// Mengkoneksikan ke database
$conn = mysqli_connect("localhost", "root", "", "kasir");

function rupiah($angka){
	$hasil_rupiah = "Rp. " . number_format($angka,0,',','.');
	return $hasil_rupiah;
}

function query($query){
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}

function inputBarang($data){	
	global $conn;
	
	$merek = htmlspecialchars($data['merek']);
	$merek = trim(strtoupper($merek));
	$queryMerek = "INSERT INTO tb_merek VALUES('', '$merek')";
	
	$tipe = htmlspecialchars($data['tipe']);
	$tipe = trim(strtoupper($tipe));
	$carTipe = substr($merek, 0,3);
	$queryMaxKode = "SELECT MAX(id_tipe) as maxKode FROM tb_tipe where id_tipe LIKE '$carTipe%'";
	$hasil = mysqli_query($conn, $queryMaxKode);
	$queryMaxKodeHasil = mysqli_fetch_assoc($hasil);
	$kodeBarang = $queryMaxKodeHasil['maxKode'];
	$noUrut = (int) substr($kodeBarang, 3, 4);
	$noUrut++;
	$id_tipe = $carTipe . sprintf("%04s", $noUrut);
	$queryTipe = "INSERT INTO tb_tipe VALUES('$id_tipe', '$merek', '$tipe')";


	$banyakWarna = htmlspecialchars($data['warna']);
	$banyakWarna = strtolower($banyakWarna);
	$warna = explode(',', $banyakWarna);

	$count = count($data);
	$n = (int)(floor(($count / 3) - 1));

	// Cek Tipe dari Merek yang Sama di databae tb_tipe
	$queryCekTipe = "SELECT * FROM tb_tipe WHERE merek='$merek' AND tipe='$tipe'";
	$cekTipe = mysqli_query($conn, $queryCekTipe);
	$hasilCekTipe = mysqli_fetch_assoc($cekTipe);
	if (is_null($hasilCekTipe)) {

		// Cek Merek apakah sudah ada di database tb_merek
		$queryCekMerek = "SELECT * FROM tb_merek WHERE merek='$merek'";
		$cekMerek = mysqli_query($conn, $queryCekMerek);
		$hasilCekMerek = mysqli_fetch_assoc($cekMerek);
		if (is_null($hasilCekMerek)) {
				mysqli_query($conn, $queryMerek); // tb_merek
			}

		mysqli_query($conn, $queryTipe); // tb_tipe

		// tb_warna
		for ($i=0; $i < count($warna) ; $i++) { 
			$warna[$i] = trim($warna[$i]);
			$queryWarna = "INSERT INTO tb_warna VALUES('', '$id_tipe', '$warna[$i]')";
			mysqli_query($conn, $queryWarna);	
		}

		// tb_memoriharga
		for ($i=0; $i < $n ; $i++) { 
			$memori[$i] = htmlspecialchars(trim($data['memori' . ($i + 1)]));
			$hargaBeli[$i] = str_replace('.', '', substr(htmlspecialchars($data['hargabeli' . ($i + 1)]), 4)) ;
			$hargaJual[$i] = str_replace('.', '', substr(htmlspecialchars($data['hargajual' . ($i + 1)]), 4)) ;

			$queryMemoriHarga = "INSERT INTO tb_memori_harga VALUES('', '$id_tipe', '$memori[$i]', '$hargaBeli[$i]', '$hargaJual[$i]')";
			mysqli_query($conn, $queryMemoriHarga);
		}

		return TRUE;

	}else{
		return FALSE;
	}
}


function inputStok($data, $username){

	global $conn;

	$count = count($data);
	$n = ($count-2) / 7;
	
	$idUser = $username;
	$keterangan = $data['keterangan'];

	$carTipe = substr($idUser, 0,3);
	$queryMaxKode = "SELECT MAX(id_user_input) as maxKode FROM tb_user_input where id_user_input LIKE '$carTipe%'";
	$hasil = mysqli_query($conn, $queryMaxKode);
	$queryMaxKodeHasil = mysqli_fetch_assoc($hasil);
	$idUserInput = $queryMaxKodeHasil['maxKode'];
	$noUrut = (int) substr($idUserInput, 3, 4);
	$noUrut++;
	$id_user_input = $carTipe . sprintf("%04s", $noUrut);
	$queryUserInput = "INSERT INTO tb_user_input VALUES ('$id_user_input', '$idUser', NOW(), '$keterangan')";
	mysqli_query($conn, $queryUserInput);

	for ($i=0; $i < $n ; $i++) { 
		
		$merekHasil[$i] = htmlspecialchars(trim($data['merekhasil' . ($i + 1)]));
		$tipeHasil[$i] = htmlspecialchars(trim($data['tipehasil' . ($i + 1)]));
		$queryIdTipe = "SELECT * FROM tb_tipe WHERE merek='$merekHasil[$i]' AND tipe='$tipeHasil[$i]'";
		$result = query($queryIdTipe);	
		if ($result) {

			$id_tipe = $result[0]['id_tipe'];

			$seriHasil[$i] = htmlspecialchars(trim($data['serihasil' . ($i + 1)]));
			$warnaHasil[$i] = htmlspecialchars(trim($data['warnahasil' . ($i + 1)]));
			$memoriHasil[$i] = htmlspecialchars(trim($data['memorihasil' . ($i + 1)]));
			$hargaBeliHasil[$i] = str_replace('.', '', substr(htmlspecialchars($data['hargabelihasil' . ($i + 1)]), 4)) ;
			$hargaJualHasil[$i] = str_replace('.', '', substr(htmlspecialchars($data['hargajualhasil' . ($i + 1)]), 4)) ;
			$queryStokBarang = "INSERT INTO tb_stok_barang VALUES ('$seriHasil[$i]', '$id_tipe', '$warnaHasil[$i]', '$memoriHasil[$i]', '$hargaBeliHasil[$i]', '$hargaJualHasil[$i]')";

			$queryInput = "INSERT INTO tb_input VALUES ('', '$id_user_input', '$seriHasil[$i]', '$id_tipe', '$warnaHasil[$i]', '$memoriHasil[$i]', '$hargaBeliHasil[$i]', '$hargaJualHasil[$i]')";
			mysqli_query($conn, $queryInput);
			mysqli_query($conn, $queryStokBarang);
			echo mysqli_error($conn);
		}
	}

	return TRUE;
}

function deleteBarang($data){
	global $conn;

	$id_tipe = $data['idtipeupdate'];
	$queryDelete = "DELETE FROM `tb_tipe` WHERE id_tipe = '$id_tipe'";
	$resultDelete = mysqli_query($conn, $queryDelete);

	// Cek apakah ada merek yang tidak memiliki child
	$queryCekNull = "SELECT tb_merek.merek, tb_tipe.merek as 'status' FROM tb_merek LEFT JOIN tb_tipe USING(merek) WHERE tb_tipe.merek IS NULL GROUP BY tb_merek.merek";
	$resultCekNull = query($queryCekNull);

	if ($resultCekNull) {
		for ($i=0; $i < count($resultCekNull); $i++) { 
			$merek = $resultCekNull[$i]['merek'];

			$queryDeleteMerek = "DELETE FROM tb_merek WHERE merek = '$merek'";
			mysqli_query($conn, $queryDeleteMerek);
		}
	}

	if ($resultDelete) {
		return TRUE;
	}else{
		return FALSE;
	}
}

function updateBarang($data){
	global $conn;

	$count = count($data);
	$n = ($count/3)-2;

	$id_tipe = trim(htmlspecialchars($data['idtipeupdate']));
	$merek = trim(htmlspecialchars($data['merekupdate']));
	$tipe = trim(htmlspecialchars($data['tipeupdate']));
	$tipehasil = trim(htmlspecialchars($data['tipeupdate']));
	$banyakWarna = htmlspecialchars($data['warnaupdate']);

	$queryCekMerek = "SELECT * FROM tb_merek WHERE merek='$merek'";
	$cekMerek = mysqli_query($conn, $queryCekMerek);
	$hasilCekMerek = mysqli_fetch_assoc($cekMerek);
	
	if (is_null($hasilCekMerek)) {
		$queryMerek = "INSERT INTO tb_merek VALUES('', '$merek')";
		mysqli_query($conn, $queryMerek);
	}

	$queryMerek = "UPDATE `tb_tipe` SET `merek` = '$merek' WHERE `tb_tipe`.`id_tipe` = '$id_tipe'";
	mysqli_query($conn, $queryMerek);

	$queryTipe = "UPDATE `tb_tipe` SET `tipe` = '$tipe' WHERE `tb_tipe`.`id_tipe` = '$id_tipe'";
	mysqli_query($conn, $queryTipe);

	$queryDeleteWarna = "DELETE FROM tb_warna WHERE id_tipe = '$id_tipe'";
	mysqli_query($conn, $queryDeleteWarna);

	$queryDeleteMemoriHarga = "DELETE FROM tb_memori_harga WHERE id_tipe = '$id_tipe'";
	mysqli_query($conn, $queryDeleteMemoriHarga);

	$banyakWarna = strtolower($banyakWarna);
	$warna = explode(',', $banyakWarna);

	for ($i=0; $i < count($warna) ; $i++) { 
		$warna[$i] = trim($warna[$i]);
		$queryWarna = "INSERT INTO tb_warna VALUES('', '$id_tipe', '$warna[$i]')";
		mysqli_query($conn, $queryWarna);	
	}

	for ($i=0; $i < $n ; $i++) { 
		$memori[$i] = htmlspecialchars(trim($data['memoriupdate' . ($i + 1)]));
		$hargaBeli[$i] = str_replace('.', '', substr(htmlspecialchars($data['hargabeliupdate' . ($i + 1)]), 4)) ;
		$hargaJual[$i] = str_replace('.', '', substr(htmlspecialchars($data['hargajualupdate' . ($i + 1)]), 4)) ;

		$queryMemoriHarga = "INSERT INTO tb_memori_harga VALUES('', '$id_tipe', '$memori[$i]', '$hargaBeli[$i]', '$hargaJual[$i]')";
		mysqli_query($conn, $queryMemoriHarga);
	}

	// Cek apakah ada merek yang tidak memiliki child
	$queryCekNull = "SELECT tb_merek.merek, tb_tipe.merek as 'status' FROM tb_merek LEFT JOIN tb_tipe USING(merek) WHERE tb_tipe.merek IS NULL GROUP BY tb_merek.merek";
	$resultCekNull = query($queryCekNull);

	if ($resultCekNull) {
		for ($i=0; $i < count($resultCekNull); $i++) { 
			$merek = $resultCekNull[$i]['merek'];

			$queryDeleteMerek = "DELETE FROM tb_merek WHERE merek = '$merek'";
			mysqli_query($conn, $queryDeleteMerek);
		}
	}
	return TRUE;
}

function outputBarang($data, $username){
	
	global $conn;

	$count = count($data);
	$n = ($count - 3)/6;

	$idUser = "$username";
	$pembeli = $data['namapembelikasir'];
	$keterangan = $data['keterangankasir'];

	$carTipe = substr($idUser, 0,3);
	$queryMaxKode = "SELECT MAX(id_user_output) as maxKode FROM tb_user_output where id_user_output LIKE '$carTipe%'";
	$hasil = mysqli_query($conn, $queryMaxKode);
	$queryMaxKodeHasil = mysqli_fetch_assoc($hasil);
	$idUserOutput = $queryMaxKodeHasil['maxKode'];
	$noUrut = (int) substr($idUserOutput, 3, 4);
	$noUrut++;
	$id_user_output = $carTipe . sprintf("%04s", $noUrut);

	$queryUserOutput = "INSERT INTO tb_user_output VALUES ('$id_user_output', '$idUser', NOW(), '$pembeli', '$keterangan')";
	mysqli_query($conn, $queryUserOutput);

	for ($i=0; $i < $n ; $i++) { 
		
		$merekPembelian[$i] = htmlspecialchars(trim($data['merekpembelian' . ($i + 1)]));
		$tipePembelian[$i] = htmlspecialchars(trim($data['tipepembelian' . ($i + 1)]));
		$banyakPembelian[$i] = htmlspecialchars(trim($data['banyakpembelian' . ($i + 1)]));
		$queryIdTipe = "SELECT * FROM tb_tipe WHERE merek='$merekPembelian[$i]' AND tipe='$tipePembelian[$i]'";
		$result = query($queryIdTipe);	
		if ($result) {

			$id_tipe = $result[0]['id_tipe'];

			$queryStok = "SELECT * FROM tb_stok_barang WHERE id_tipe = '$id_tipe' LIMIT $banyakPembelian[$i]";

			$resultStok = query($queryStok);

			for ($j=0; $j < count($resultStok) ; $j++) { 
				$serialNumber = $resultStok[$j]["serial_number"];
				$warna = $resultStok[$j]["warna"];
				$memori = $resultStok[$j]["memori"];
				$hargaJual = $resultStok[$j]["harga_jual"];

				$queryOutput = "INSERT INTO tb_output VALUES('', '$id_user_output', '$serialNumber', '$id_tipe', '$warna', '$memori', '$hargaJual')";
				mysqli_query($conn, $queryOutput);

				$queryDeleteStok = "DELETE FROM `tb_stok_barang` WHERE serial_number = '$serialNumber'";
				mysqli_query($conn, $queryDeleteStok);
			}
			// echo mysqli_error($conn);
		}
	}
	return TRUE;
}

function registrasi($data){
	global $conn;

	$username = trim(strtolower(stripcslashes($data['username'])));
	$password = mysqli_real_escape_string($conn, $data['password']);
	$password2 = mysqli_real_escape_string($conn, $data['repassword']);

	$resultCekUsername = mysqli_query($conn, "SELECT username FROM tb_user WHERE username = '$username'");

	if (mysqli_fetch_assoc($resultCekUsername)) {
		echo "
		<script>
		alert('Username telah terdaftar!');
		</script>
		";
		return FALSE;
	}

	if ($password !== $password2) {
		echo "
		<script>
		alert('Konfirmasi Password tidak sesuai!');
		</script>
		";
		return FALSE;
	}

	$password = password_hash($password, PASSWORD_DEFAULT);
	
	$query = "INSERT INTO tb_user (username, password) VALUES('$username', '$password')";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}

function ubahPassword($data){
	global $conn;

	$username = trim(strtolower(stripcslashes($data['username_ubah'])));
	$password = mysqli_real_escape_string($conn, $data['password_ubah']);
	$password2 = mysqli_real_escape_string($conn, $data['repassword_ubah']);

	$resultCekUsername = mysqli_query($conn, "SELECT username FROM tb_user WHERE username = '$username'");

	if (!mysqli_fetch_assoc($resultCekUsername)) {
		echo "
		<script>
		alert('Username tidak terdaftar!');
		</script>
		";
		return FALSE;
	}

	if ($password !== $password2) {
		echo "
		<script>
		alert('Konfirmasi Password tidak sesuai!');
		</script>
		";
		return FALSE;
	}

	$password = password_hash($password, PASSWORD_DEFAULT);
	$queryUpdatePassword = "UPDATE `tb_user` SET `password` = '$password' WHERE username = '$username';";

	mysqli_query($conn, $queryUpdatePassword);
	return mysqli_affected_rows($conn);
}

function updatePassword($data, $username){
	global $conn;

	$passwordLama = mysqli_real_escape_string($conn, $data['password_lama']);
	$passwordBaru = mysqli_real_escape_string($conn, $data['password_baru']);
	$rePasswordBaru = mysqli_real_escape_string($conn, $data['repassword_baru']);

	$queryCari = "SELECT password FROM tb_user WHERE username='$username'";
	$resultCari = query($queryCari);

	if (count($resultCari) == 1) {
		if (password_verify($passwordLama, $resultCari[0]['password'])) {
			if ($passwordBaru === $rePasswordBaru) {
				$passwordBaru = password_hash($passwordBaru, PASSWORD_DEFAULT);
				$cekBerhasil = mysqli_query($conn ,"UPDATE `tb_user` SET password = '$passwordBaru' WHERE username = '$username'");
			}else{
				echo "
				<script>
				alert('Konfirmasi Password tidak sesuai!');
				</script>
				";
				return FALSE;
			}
		}else{
			echo "
			<script>
			alert('Password Lama Tidak Sesuai!');
			</script>
			";
			return FALSE;
		}
	}
	return mysqli_affected_rows($conn);
}

function ubahProfile($data, $username, $photo){

	global $conn;

	$nama = trim(htmlspecialchars($data['nama-edit']));
	$noHp =	trim(htmlspecialchars($data['no-hp-edit']));
	$gambarBaru = upload();

	if (is_string($gambarBaru)) {
		$queryUbah = "UPDATE tb_user SET nama = '$nama', no_hp = '$noHp', photo = '$gambarBaru' WHERE username = '$username'";
		if ($photo !== "ika.jpg") {
			$target = "img/".$photo;
			unlink($target);
		}
	}else if($gambarBaru === 4){
		$queryUbah = "UPDATE tb_user SET nama = '$nama', no_hp = '$noHp' WHERE username = '$username'";
	}else{
		return false;
	}

	mysqli_query($conn, $queryUbah);
	return TRUE;
}

function upload(){
	$namaFile = $_FILES['gambar-edit']['name'];
	$ukuranFile = $_FILES['gambar-edit']['size'];
	$error = $_FILES['gambar-edit']['error'];
	$tmpName = $_FILES['gambar-edit']['tmp_name'];

	if ($error === 4) {
		return $error;
	}

	$ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
	$ekstensiGambar = explode('.', $namaFile);
	$ekstensiGambar = strtolower(end($ekstensiGambar));

	if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
		echo "
			<script>
				alert('Yang di upload bukan gambar!');
			</script>
		";
		return false;
	}

	if ($ukuranFile > 1048576) {
		echo "
			<script>
				alert('Ukuran Gambar Terlalu Besar Max 1MB!');
			</script>
		";
		return false;
	}

	$namaFileBaru = uniqid().'.'.$ekstensiGambar;

	$cek = move_uploaded_file($tmpName, 'img/'.$namaFileBaru);
	if ($cek) {
		return $namaFileBaru;
	}else{
		echo "
			<script>
				alert('Coba Gunakan Gambar Lain!');
			</script>
		";
		return false;
	}
}

?>