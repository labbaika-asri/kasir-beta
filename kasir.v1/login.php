<?php
session_start();

if(isset($_SESSION['status'])){
	switch ($_SESSION['status']) {
		case 'labbaika':
			header("Location: index.php");
			exit;
			break;
		
		case 'asri':
			header("Location: indeks.php");
			exit;
			break;

	}
}

require 'functions.php';

if (isset($_POST['login'])) {
	$username = $_POST['username-login'];
	$password = $_POST['password-login'];

	$resultLogin = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");

	if (mysqli_num_rows($resultLogin) == 1) {
		$row = mysqli_fetch_assoc($resultLogin);
		if(password_verify($password, $row['password'])){
			$_SESSION["username"] = $row['username'];
			$_SESSION["nama"] = $row['nama'];
			$_SESSION["photo"] = $row['photo'];
			$_SESSION["no_hp"] = $row['no_hp'];
			switch ($row['status']) {
				case 'Administrator':
				$_SESSION['status'] = 'labbaika';
				header("Location: index.php");
				exit;
				break;
				
				default:
				$_SESSION['status'] = 'asri';
				header("Location: indeks.php");
				exit;
				break;
			}
		}
	}
	$error = true;
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="css/style-login1.css">
</head>
<body>
	<div class="login">
		<h2>Silahkan Login</h2>
		<form action="" method="POST">
			<div class="inputBox">
				<input type="text" name="username-login" placeholder="Username">
				<span><i class="fa fa-user" aria-hidden="true"></i></span> 				
			</div>
			<div class="inputBox">
				<input type="password" name="password-login" placeholder="Password" autocomplete="off">
				<span><i class="fa fa-lock" aria-hidden="true"></i></span>
			</div>
			<?php if(isset($error)): ?>
				<p>Username/Password Salah!</p>
			<?php endif ?>
			<input type="submit" class="tombol_login" name="login">
		</form>
	</div>
</body>
</html>