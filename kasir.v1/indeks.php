<?php 
session_start();

if(!isset($_SESSION["username"])){
	header("Location: login.php");
	exit;
}

if ($_SESSION['status'] !== 'asri') {
	header("Location: index.php");
	exit;
}

if (is_null($_SESSION['nama']) && $_GET['menu'] !== '8') {
	header("Location: indeks.php?menu=8");
}

require "functions.php";

if (isset($_POST["submit1"])) {

	if (inputBarang($_POST)) {
		echo "
		<script>
		alert('Data Berhasil di Tambahkan!');
		</script>
		";
	}else{
		echo "
		<script>
		alert('Data Gagal di Tambahkan!, Kemungkinan merek dengan tipe yang sama telah ada.');
		</script>
		";
	}
}

if (isset($_POST["submit3"])) {

	if(inputStok($_POST, $_SESSION['username'])){
		echo "
		<script>
		alert('Stok Berhasil di Tambahkan!');
		</script>
		";
	}
}

if(isset($_POST["submitupdate"])){

	if (updatebarang($_POST)) {
		echo "
		<script>
		alert('Barang Berhasil diUpdate!');
		</script>
		";
	}
}

if (isset($_POST["deleteupdate"])) {
	
	if (deleteBarang($_POST)) {
		echo "
		<script>
		alert('Barang Berhasil diHapus!');
		</script>
		";
	}else{
		echo "
		<script>
		alert('Barang Gagall di Hapus!, Kemungkinan data masih digunakan');
		</script>
		";
	}
}

if (isset($_POST["submitpembelian2"])) {
	if (outputBarang($_POST, $_SESSION['username'])) {
		echo "
		<script>
		alert('Penjualan Berhasil :)');
		</script>
		";
	}
}

if (isset($_POST['submit_baru'])) {
	if (updatePassword($_POST, $_SESSION['username']) > 0) {
		echo "
		<script>
		alert('Password Berhasil di Update!');
		</script>
		";
	}
}

if (isset($_POST['ubah-edit'])) {

	if (ubahProfile($_POST, $_SESSION['username'], $_SESSION['photo']) > 0) {
		echo "
		<script>
		alert('Data Berhasil di Ubah!');
		document.location.href = 'indeks.php?menu=5';
		</script
		";

		$username =  $_SESSION['username'];
		$resultUpdateSessions = query("SELECT * FROM tb_user WHERE username = '$username'");
		$_SESSION['nama'] = $resultUpdateSessions[0]['nama'];
		$_SESSION['photo'] = $resultUpdateSessions[0]['photo'];
		$_SESSION["no_hp"] = $resultUpdateSessions[0]['no_hp'];

	}else{
		echo "
		<script>
		document.location.href = 'indeks.php?menu=8';
		</script>
		";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Kasir</title>
	<link rel="stylesheet" href="jquery-ui/jquery-ui.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" type="image/png" href="img/favicon-16x16.png" sizes="16x16" />
	<script src="js/jquery-3.4.1.min.js"></script>
	<script src="jquery-ui/jquery-ui.js"></script>
	<script src="js/script.js"></script>
</head>
<body>
	<div class="container">
		<div class="top-bar cf">
			<div class="menu">
				<ul>
					<li><a href="?menu=0">Kasir</a></li>
					<li><a href="?menu=1">Stok Barang</a></li>
					<li><a href="?menu=2">Input Barang</a></li>
					<li><a href="?menu=3">Update Barang</a></li>
					<li><a href="?menu=4">Laporan</a> </li>
					<li><a href="?menu=5">Profil Saya</a></li>
					<li><a href="?menu=6">Ubah Password</a></li>
					<li><a href="?menu=7">Keluar</a></li>
				</ul>
			</div>
			<div class="user cf">
				<div class="name">
					<?php if (is_null($_SESSION["nama"])): ?>
						<h4><?= $_SESSION["username"]; ?></h4>
						<?php else: ?>
							<h4><?= $_SESSION["nama"]; ?></h4>
						<?php endif ?>
						<h5>(Karyawan)</h5>
					</div>
					<img src="img/<?= $_SESSION['photo']; ?>" alt="Photo Profile">
				</div>
			</div>
			<div class="containt">
				<?php 
				if (isset($_GET['menu'])) {
					$menu = $_GET['menu'];

					switch ($menu) {
						case '0':
						include "layout/kasir.php";
						break;

						case '1':
						include "layout/stokbarang2.php";
						break;

						case '2':
						include "layout/input.php";
						break;

						case '3':
						include "layout/updatebarang.php";
						break;

						case '4':
						include "layout/laporan.php";
						break;

						case '5':
						include "layout/myprofile.php";
						break;

						case '6':
						include "layout/ubah_password.php";
						break;

						case '8':
						include "layout/edit_profile.php";
						break;

						case '7':
						include "layout/logout.php";
						break;

						default:
						echo "<center><h3>Maaf halaman tidak ditemukan!!</h3></center>";
						break;
					}


				}else{
					include "layout/stokbarang2.php";
				}

				?>
			</div>
			<div class="footer">
				<p>Copyright by: Labbaika Asri</p>
			</div>
		</div>
	</body>
	</html>