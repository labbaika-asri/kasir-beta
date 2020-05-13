<?php
session_start();
require_once __DIR__.'/mpdf/vendor/autoload.php';
require 'functions.php';
$mpdf = new \Mpdf\Mpdf();
$mpdf->SetTitle('Labbaika Asri');
$mpdf->SetCreator('Labbaika Asri');
$mpdf->SetAuthor('Labbaika Asri');
$mpdf->SetWatermarkText('Copyright by Ika');
$mpdf->showWatermarkText = true;
$date = date('Y-m-d');
$cek = $_GET['cek'];
if (isset($_GET['button'])) {
	$button = $_GET['button']; 

	switch ($button) {
		case 'hari-ini':
		$firstDay = $date;
		$lastDay = date('Y-m-d', strtotime('+1 day', strtotime($firstDay)));
		break;

		case 'bulan-ini':
		$firstDay = date('Y-m-d', strtotime("first day of $date"));
		$lastDay = date('Y-m-d', strtotime("last day of $date"));
		break;

		case 'tahun-ini':
		$year = explode('-', $date);
		$firstDay = "$year[0]-01-01";
		$lastDay = "$year[0]-12-31";
		break;
	}
}elseif (isset($_GET['awal']) && isset($_GET['akhir'])) {
	$firstDay = $_GET['awal'];
	$lastDay = date('Y-m-d', strtotime('+1 day', strtotime($_GET['akhir'])));
}else if(isset($_GET['awal'])){
	$firstDay = $_GET['awal'];
	$lastDay = date('Y-m-d', strtotime('+1 day', strtotime($firstDay)));
}

switch ($cek) {
	case '1':
	$nama = "Laporan Pemasukan";
	$queryLaporanPemasukan = "SELECT id_user_input, username, DATE_FORMAT(date, '%d-%m-%Y') as date, DATE_FORMAT(date, '%H:%i:%S') as pukul, keterangan FROM `tb_user_input` WHERE date BETWEEN '$firstDay' AND '$lastDay'";
	$resultLaporanPemasukan = query($queryLaporanPemasukan);
	ob_start();?>

	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Laporan Pemasukan</title>
		<style>
			p.date, p.user{
				text-align: right;
				margin: 0px;
			}

			h1, h4{
				text-align: center;
				margin: 0px;
			}

			h4{
				margin-bottom: 15px;
			}

			.hasil{
				width: 150px;
			}

			.keterangan{
				width: 300px;
			}

			div.tamplate{
				border: 2px solid cornflowerblue;
				border-radius: 20px;
				background-color: aliceblue;
				padding: 10px;
			}

			table.box0, table.box4{
				width: 100%;
			}

			table.box0{
				margin-bottom: 20px;
			}

			table.box0 td{
				vertical-align: top;
			}

			table.box2{
				margin-left: 15px;
			}

			table.box4 td{
				text-align: center;
			}

		</style>
	</head>
	<body>
		<p class="date"><?= date('d, F Y'); ?></p>
		<p class="user"><?= $_SESSION['username']; ?></p>
		<h1>Laporan Pemasukan</h1>
		<h4>(<?= $firstDay; ?> sampai <?= $lastDay; ?>)</h4>
		<?php foreach ($resultLaporanPemasukan as $result) :   
			$idUserInput = $result['id_user_input'];
			$queryData = "SELECT id_user_input, serial_number, merek, tipe, warna, memori, harga_beli, harga_jual FROM tb_input INNER JOIN tb_tipe USING(id_tipe) WHERE id_user_input = '$idUserInput'";
			$data = query($queryData); ?>
		<hr>
		<div class="tamplate">
			<table class="box0">
				<tr>
					<td>
						<table class="box1">
							<tr>
								<td>Tanggal</td>
								<td>&nbsp;:&nbsp;</td>
								<td class="hasil"><?= $result['date']; ?></td>
							</tr>
							<tr>
								<td>Pukul</td>
								<td>&nbsp;:&nbsp;</td>
								<td class="hasil"><?= $result['pukul']; ?></td>
							</tr>
							<tr>
								<td>Username</td>
								<td>&nbsp;:&nbsp;</td>
								<td class="hasil"><?= $result['username']; ?></td>
							</tr>
						</table>
					</td>
					<td>
						<table class="box2">
							<tr>
								<td>Keterangan</td>
								<td>&nbsp;:&nbsp;</td>
								<td class="keterangan"><?= $result['keterangan']; ?></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<table class="box4" border="1" cellspacing="0px">
				<tr>
					<th>No</th>
					<th>Serial Number</th>
					<th>Merek</th>
					<th>Tipe</th>
					<th>Warna</th>
					<th>Memori</th>
					<th>Harga Beli</th>
					<th>Harga Jual</th>
				</tr>
				<?php 
				$i = 1;
				foreach ($data as $key): ?>
				<tr>
					<td><?= $i; ?></td>
					<td><?= $key['serial_number']; ?></td>
					<td><?= $key['merek']; ?></td>
					<td><?= $key['tipe']; ?></td>
					<td><?= $key['warna']; ?></td>
					<td><?= $key['memori']; ?></td>
					<td><?= rupiah($key['harga_beli']); ?></td>
					<td><?= rupiah($key['harga_jual']); ?></td>
				</tr>
				<?php $i++; ?>
				<?php endforeach ?>
			</table>
		</div>
		<?php endforeach ?>
	</body>
	</html>
	
	<?php 
	$mpdf->setFooter('{PAGENO}');
	$html = ob_get_contents();
	ob_end_clean();
	break;
	
	case '2':
	$nama = "Laporan Pengeluaran";
	$queryLaporanPengeluaran = "SELECT id_user_output, username, DATE_FORMAT(date, '%d-%m-%Y') as date, DATE_FORMAT(date, '%H:%i:%S') as pukul, pembeli, keterangan FROM `tb_user_output` WHERE date BETWEEN '$firstDay' AND '$lastDay'";
	$resultLaporanPengeluaran = query($queryLaporanPengeluaran);
	ob_start();?>
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Laporan Pemasukan</title>
		<style>
			p.date, p.user{
				text-align: right;
				margin: 0px;
			}

			h1, h4{
				text-align: center;
				margin: 0px;
			}

			h4{
				margin-bottom: 15px;
			}

			.hasil{
				width: 150px;
			}

			.keterangan{
				width: 300px;
			}

			div.tamplate{
				border: 2px solid cornflowerblue;
				border-radius: 20px;
				background-color: aliceblue;
				padding: 10px;
			}

			table.box0, table.box4{
				width: 100%;
			}

			table.box0{
				margin-bottom: 20px;
			}

			table.box0 td{
				vertical-align: top;
			}

			table.box2{
				margin-left: 15px;
			}

			table.box4 td{
				text-align: center;
			}

		</style>
	</head>
	<body>
		<p class="date"><?= date('d, F Y'); ?></p>
		<p class="user"><?= $_SESSION['username']; ?></p>
		<h1>Laporan Pengeluaran</h1>
		<h4>(<?= $firstDay; ?> sampai <?= $lastDay; ?>)</h4>
		<?php foreach ($resultLaporanPengeluaran as $result) :   
			$idUserOutput = $result['id_user_output'];
			$queryData = "SELECT id_user_output, serial_number, merek, tipe, warna, memori, harga_jual FROM tb_output INNER JOIN tb_tipe USING(id_tipe) WHERE id_user_output = '$idUserOutput'";
			$data = query($queryData);?>
		<hr>
		<div class="tamplate">
			<table class="box0">
				<tr>
					<td>
						<table class="box1">
							<tr>
								<td>Tanggal</td>
								<td>&nbsp;:&nbsp;</td>
								<td class="hasil"><?= $result['date']; ?></td>
							</tr>
							<tr>
								<td>Pukul</td>
								<td>&nbsp;:&nbsp;</td>
								<td class="hasil"><?= $result['pukul']; ?></td>
							</tr>
							<tr>
								<td>Username</td>
								<td>&nbsp;:&nbsp;</td>
								<td class="hasil"><?= $result['username']; ?></td>
							</tr>
						</table>
					</td>
					<td>
						<table class="box2">
							<tr>
								<td>Pembeli</td>
								<td>&nbsp;:&nbsp;</td>
								<td class="keterangan"><?= $result['pembeli']; ?></td>
							</tr>
							<tr>
								<td>Keterangan</td>
								<td>&nbsp;:&nbsp;</td>
								<td class="keterangan"><?= $result['keterangan']; ?></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<table class="box4" border="1" cellspacing="0px">
				<tr>
					<th>No</th>
					<th>Serial Number</th>
					<th>Merek</th>
					<th>Tipe</th>
					<th>Warna</th>
					<th>Memori</th>
					<th>Harga</th>
				</tr>
				<?php 
				$i = 1;
				foreach ($data as $key): ?>
				<tr>
					<td><?= $i; ?></td>
					<td><?= $key['serial_number']; ?></td>
					<td><?= $key['merek']; ?></td>
					<td><?= $key['tipe']; ?></td>
					<td><?= $key['warna']; ?></td>
					<td><?= $key['memori']; ?></td>
					<td><?= rupiah($key['harga_jual']); ?></td>
				</tr>
				<?php $i++; ?>
				<?php endforeach ?>
			</table>
		</div>
		<?php endforeach ?>
	</body>
	</html>
	<?php 
	$mpdf->setFooter('{PAGENO}');
	$html = ob_get_contents();
	ob_end_clean();
	break;
}
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama.date('dmyHis').'.pdf','D');
exit;
?>

