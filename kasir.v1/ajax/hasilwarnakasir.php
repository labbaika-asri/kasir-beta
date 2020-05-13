<?php 
	
	require '../functions.php';

	$merek = $_POST['merek'];
	$tipe = $_POST['tipe'];
	$warna = $_POST['warna'];

	$query = "SELECT DISTINCT merek, tipe, warna, memori FROM `tb_stok_barang` INNER JOIN tb_tipe USING(id_tipe) WHERE merek = '$merek' AND tipe = '$tipe' AND warna = '$warna'";

	$result = query($query);

	for ($i=0; $i < count($result); $i++) { 
		$memori[$i] = $result[$i]['memori'];
	}

	echo json_encode($memori);
 ?>