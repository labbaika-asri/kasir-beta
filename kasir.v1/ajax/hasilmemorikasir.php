<?php 

require '../functions.php';

$merek = $_POST['merek'];
$tipe = $_POST['tipe'];
$warna = $_POST['warna'];
$memori = $_POST['memori'];

$query = "SELECT merek, tipe, warna, memori, harga_jual, COUNT(*) as stok FROM `tb_stok_barang` INNER JOIN tb_tipe USING(id_tipe) WHERE merek = '$merek' AND tipe = '$tipe' AND warna = '$warna' AND memori= '$memori'";

$result = query($query);

$data = [

	'harga' => $result[0]['harga_jual'],
	'stok' => $result[0]['stok']

];

echo json_encode($data);

?>