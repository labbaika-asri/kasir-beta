<?php 

require '../functions.php';
$key = $_GET['term'];

$query = "SELECT merek FROM tb_merek WHERE merek LIKE '$key%' ORDER BY merek ASC";
$result = query($query);

for ($i=0; $i < count($result) ; $i++) { 
		$data[$i] = $result[$i]['merek'];
	}

	echo json_encode($data);

 ?>