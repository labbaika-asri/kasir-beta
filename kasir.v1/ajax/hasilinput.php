<?php 
require '../functions.php';
$input = $_GET['input'];
$input = str_replace('\\', ' ', $input);

$cek = stripos($input, ' ');

$input = explode(' ', $input);
$str = '';
for ($i=1; $i < count($input) ; $i++) { 
	if ($i == count($input)-1) {
		$str .= $input[$i];
	}else{
		$str .= $input[$i].' ';
	}
}

$queryTipe = "SELECT * FROM `tb_tipe` WHERE merek='$input[0]' AND tipe = '$str'";
$resultTipe = query($queryTipe);

if($resultTipe){
	$id_tipe = $resultTipe[0]['id_tipe'];

	$queryWarna = "SELECT warna FROM `tb_warna` WHERE id_tipe='$id_tipe'";
	$resultWarna = query($queryWarna);
	$warna = [];
	for ($i=0; $i < count($resultWarna) ; $i++) { 
		$warna[$i] = $resultWarna[$i]['warna'];
	}

	$queryMemoriHarga = "SELECT memori, harga_jual, harga_beli FROM `tb_memori_harga` WHERE id_tipe='$id_tipe'";
	$resultMemoriHarga = query($queryMemoriHarga);
	$memori = [];
	$hargaJual = [];
	$hargaBeli = [];
	for ($i=0; $i < count($resultMemoriHarga) ; $i++) { 
		$memori[$i] = $resultMemoriHarga[$i]['memori'];
		$hargaJual[$i] =  $resultMemoriHarga[$i]['harga_jual'];
		$hargaBeli[$i] = $resultMemoriHarga[$i]['harga_beli'];
	}
}

if ($resultTipe) {
	$data = [
		'idTipe' => $id_tipe,
		'merek' => $resultTipe[0]['merek'],
		'tipe' => $resultTipe[0]['tipe'],
		'warna' => $warna,
		'memori' => $memori,
		'hargaBeli' => $hargaBeli,
		'hargaJual' => $hargaJual
	];

	echo json_encode($data);	
}

?>