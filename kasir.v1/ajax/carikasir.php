<?php 

require '../functions.php';
$key = $_GET['term'];
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

	$query = "SELECT merek, tipe FROM `tb_stok_barang` INNER JOIN tb_tipe USING(id_tipe) WHERE merek = '$key[0]' AND tipe LIKE '$str%' GROUP BY tipe";
	$result = query($query);

	for ($i=0; $i < count($result) ; $i++) { 
		$data[$i] = strtoupper($key[0]).' '.$result[$i]['tipe'];
	}

	if($result){
		echo json_encode($data);
	}
	
}else{
	$query = "SELECT tb_tipe.merek FROM `tb_stok_barang` INNER JOIN tb_tipe USING(id_tipe) WHERE merek LIKE '$key%' GROUP BY merek";
	$result = query($query);

	if ($result) {
		echo json_encode($result[0]);
	}
}

?>