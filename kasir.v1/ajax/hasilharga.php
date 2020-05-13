<?php 

require '../functions.php';
$merek = $_POST['merek'];
$memori = $_POST['memori'];
$tipe = $_POST['tipe'];

$queryTipe = "SELECT * FROM tb_tipe WHERE merek='$merek' AND tipe='$tipe'";
$result = query($queryTipe);
$id_tipe = $result[0]['id_tipe'];

$query = "SELECT * FROM tb_memori_harga WHERE id_tipe='$id_tipe' AND memori='$memori'";
$result = query($query);

$data = [
	'hargabeli' => $result[0]['harga_beli'],
	'hargajual' => $result[0]['harga_jual']
];

echo json_encode($data);

 ?>