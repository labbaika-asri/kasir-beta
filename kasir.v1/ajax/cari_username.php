<?php 

require '../functions.php';
$key = $_GET['term'];

$query = "SELECT username FROM tb_user WHERE username LIKE '$key%' ORDER BY username ASC";
$result = query($query);

for ($i=0; $i < count($result) ; $i++) { 
		$data[$i] = $result[$i]['username'];
	}

	echo json_encode($data);

 ?>