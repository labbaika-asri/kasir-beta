<?php 

require '../functions.php';
$key = $_GET['term'];

$key = str_replace('\\', ' ', $key);

$cek = stripos($key, ' ');
if ($cek > 0) {
	$key = explode(' ', $key);
	$query = "SELECT tipe FROM `tb_tipe` WHERE merek='$key[0]' AND tipe LIKE '$key[1]%' ORDER BY tipe ASC";
	$result = query($query);

	for ($i=0; $i < count($result) ; $i++) { 
		$data[$i] = strtoupper($key[0]).' '.$result[$i]['tipe'];
	}

	if ($result) {
		echo json_encode($data);
	}

	
}else{
	// Tidak ada spasi
	$query = "SELECT merek FROM tb_merek WHERE merek LIKE '$key%' ORDER BY merek ASC";
	$result = query($query);
	if ($result) {
		echo json_encode($result[0]);
	}
}

?>