<?php 

require '../functions.php';

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

	$queryLaporanPemasukan = "SELECT id_user_input, username, DATE_FORMAT(date, '%d-%m-%Y') as date, DATE_FORMAT(date, '%H:%i:%S') as pukul, keterangan FROM `tb_user_input` WHERE date BETWEEN '$firstDay' AND '$lastDay'";
	$resultLaporanPemasukan = query($queryLaporanPemasukan);
	?>

	<fieldset>
		<legend><h2>Laporan Pemasukan</h2></legend>
		<?php foreach ($resultLaporanPemasukan as $result) :   
			$idUserInput = $result['id_user_input'];
			$queryData = "SELECT id_user_input, serial_number, merek, tipe, warna, memori, harga_beli, harga_jual FROM tb_input INNER JOIN tb_tipe USING(id_tipe) WHERE id_user_input = '$idUserInput'";
			$data = query($queryData);
			?>
			<div class="box1">
				<div class="box2">
					<table>
						<tr>
							<td>Tanggal</td>
							<td>&emsp;:&emsp;</td>
							<td><?= $result['date']; ?></td>
						</tr>
						<tr>
							<td>Pukul</td>
							<td>&emsp;:&emsp;</td>
							<td><?= $result['pukul']; ?></td>
						</tr>
						<tr>
							<td>Username</td>
							<td>&emsp;:&emsp;</td>
							<td><?= $result['username']; ?></td>
						</tr>
					</table>
				</div>
				<div class="box3">
					<table>
						<tr>
							<td>Keterangan</td>
							<td>&emsp;:&emsp;</td>
							<td><?= $result["keterangan"]; ?></td>
						</tr>
					</table>
				</div>
				<table class="data">
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
					foreach ($data as $key) : ?>
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
	</fieldset>

	<?php	break;

	case '2': 
	$queryLaporanPengeluaran = "SELECT id_user_output, username, DATE_FORMAT(date, '%d-%m-%Y') as date, DATE_FORMAT(date, '%H:%i:%S') as pukul, pembeli, keterangan FROM `tb_user_output` WHERE date BETWEEN '$firstDay' AND '$lastDay'";
	$resultLaporanPengeluaran = query($queryLaporanPengeluaran);
	?>
	<fieldset>
		<legend><h2>Laporan Pengeluaran</h2></legend>
		<?php foreach ($resultLaporanPengeluaran as $result) :   
			$idUserOutput = $result['id_user_output'];

			$queryData = "SELECT id_user_output, serial_number, merek, tipe, warna, memori, harga_jual FROM tb_output INNER JOIN tb_tipe USING(id_tipe) WHERE id_user_output = '$idUserOutput'";
			$data = query($queryData);
			?>
			<div class="box1">
				<div class="box2">
					<table>
						<tr>
							<td>Tanggal</td>
							<td>&emsp;:&emsp;</td>
							<td><?= $result['date']; ?></td>
						</tr>
						<tr>
							<td>Pukul</td>
							<td>&emsp;:&emsp;</td>
							<td><?= $result['pukul']; ?></td>
						</tr>
						<tr>
							<td>Username</td>
							<td>&emsp;:&emsp;</td>
							<td><?= $result['username']; ?></td>
						</tr>
					</table>
				</div>
				<div class="box3">
					<table>
						<tr>
							<td>Pembeli</td>
							<td>&emsp;:&emsp;</td>
							<td><?= $result['pembeli']; ?></td>
						</tr>
						<tr>
							<td>Keterangan</td>
							<td>&emsp;:&emsp;</td>
							<td><?= $result['keterangan']; ?></td>
						</tr>
					</table>
				</div>
				<table class="data">
					<tr>
						<th>No</th>
						<th>Serial Number</th>
						<th>Merek</th>
						<th>Tipe</th>
						<th>Warna</th>
						<th>Memori</th>
						<th>Harga</th>
					</tr>
					<?php $i = 1;
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
	</fieldset>
	<?php break;
}?>