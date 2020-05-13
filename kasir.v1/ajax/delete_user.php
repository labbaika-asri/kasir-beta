<?php 
require '../functions.php';

$username = $_POST['username'];
$queryUserDelete = "SELECT photo FROM tb_user WHERE username = '$username'";
$resultUserDelete = query($queryUserDelete);


$resultDeleteUser = mysqli_query($conn, "DELETE FROM tb_user WHERE username = '$username'");

if (mysqli_affected_rows($conn) == 1) {
	$photo = $resultUserDelete[0]['photo'];
	if ($photo !== 'ika.jpg') {
		$target = "../img/".$photo;
		unlink($target);
	}
	echo json_encode(TRUE);
}else{
	echo json_encode(FALSE);
}

 ?>