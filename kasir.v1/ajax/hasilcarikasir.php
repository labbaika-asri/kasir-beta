<?php 

require '../functions.php';

$key = $_GET['input'];
$key = str_replace('\\', ' ', $key);

$cek = stripos($key, ' ');

if ($cek) {

	$key = explode(' ', $key);

	$str = "";
	for ($i=1; $i < count($key) ; $i++) { 
		if ($i == (count($key) - 1)) {
			$str .= $key[$i];
		}else{
			$str .= $key[$i].' ';
		}
	}

	$query = "SELECT DISTINCT merek, tipe, warna FROM `tb_stok_barang` INNER JOIN tb_tipe USING(id_tipe) WHERE merek = '$key[0]' AND tipe = '$str'";
	$result = query($query);


	for ($i=0; $i < count($result); $i++) { 
		$warna[$i] = $result[$i]['warna'];
	}

	if($result){
		$data = [
			'merek' => $key[0],
			'tipe' => $str,
			'warna' => $warna
		];

		echo json_encode($data);
	}

}
?>