<?php 
$resultTipe = query("SELECT tb_stok_barang.id_tipe, merek, tipe, warna, memori, harga_beli, harga_jual, count(*) as stok FROM `tb_stok_barang` INNER JOIN tb_tipe using(id_tipe) GROUP BY id_tipe, warna, memori ORDER by merek, tipe, warna, memori ASC");

$tipeUnik = array_unique(array_column($resultTipe, "id_tipe"));
$i = 0;
foreach ($tipeUnik as $tipe[$i]) {
	$i++;
}

$rowTipe = array_count_values(array_column($resultTipe, "id_tipe"));

$id_tipeWarna = [];
for ($i=0; $i < count($resultTipe); $i++) { 
	$tipeWarna = $resultTipe[$i]['id_tipe'].','.$resultTipe[$i]['warna'];
	$id_tipeWarna[$i] = $tipeWarna;
}

$idWarna = array_unique($id_tipeWarna);
$i = 0;
foreach ($idWarna as $idTipeWarna[$i]) {
	$i++;
}

$indexIdWarna = [];
for ($i=0; $i < count($tipe); $i++) { 
	$warna = [];
	for ($j=0; $j < count($idTipeWarna); $j++) {
		$id_tipe = explode(',', $idTipeWarna[$j]);
		if ($id_tipe[0] == $tipe[$i]) {
			array_push($warna, $id_tipe[1]);
		}
	}
	$indexIdWarna[$tipe[$i]] = $warna;
}

$rowWarna = array_count_values($id_tipeWarna);

$id_tipeWarnaMemori = [];
for ($i=0; $i < count($resultTipe); $i++) { 
	$tipeWarnaMemori = $resultTipe[$i]['id_tipe'].','.$resultTipe[$i]['warna'].','.$resultTipe[$i]['memori'].','.$resultTipe[$i]['harga_beli'].','.$resultTipe[$i]['harga_jual'].','.$resultTipe[$i]['stok'];
	$id_tipeWarnaMemori[$i] = $tipeWarnaMemori;
}

$idWarnaMemori = array_unique($id_tipeWarnaMemori);
$i = 0;
foreach ($idWarnaMemori as $id_tipeWarnaMemori[$i]) {
	$i++;
}

$indexIdMemoriHargaStok = [];
for ($i=0; $i < count($tipe) ; $i++) { 
	for ($k=0; $k < count($indexIdWarna[$tipe[$i]]); $k++) { 
		$warna = $indexIdWarna[$tipe[$i]][$k];
		$memori = []; 

		for ($j=0; $j < count($id_tipeWarnaMemori); $j++) {
			$data = explode(',', $idWarnaMemori[$j]);
			$dataWarna = $data[1];
			$dataMemori = $data[2];
			$dataHargaBeli = $data[3];
			$dataHargaJual = $data[4];
			$dataStok = $data[5];

			if($tipe[$i] == $data[0] AND $warna == $dataWarna){
				array_push($memori, $dataMemori.','.$dataHargaBeli.','.$dataHargaJual.','.$dataStok);
			}		
		}


		$index = $tipe[$i].','.$warna;

		$indexIdMemoriHargaStok[$index] = $memori;

	}
}
// var_dump($rowTipe);
// var_dump($tipe);
// var_dump($rowWarna);
// var_dump($indexIdWarna);
// var_dump($indexIdMemoriHargaStok);
?>

<div class="stok">	
	<h1>Stok Barang</h1>
	<label for="cari2">Cari Data&emsp;:&nbsp;</label>
	<input type="text" name="cari2" id="cari2">

	<div class="stok-output">
		<table>	
			<tr>
				<th>No.</th>
				<th>Merek & Tipe</th>
				<th>Warna</th>
				<th>RAM/ROM</th>
				<th>Harga Beli</th>
				<th>Harga Jual</th>
				<th>Qty</th>
			</tr>
			<?php for( $i = 0 ; $i < count($tipe) ; $i++):

				$id_tipe1 = $tipe[$i];

				$queryMerekTipe1 = "SELECT * FROM tb_tipe WHERE id_tipe='$id_tipe1'";
				$resultMerekTipe1 = query($queryMerekTipe1);

				$merek1 = $resultMerekTipe1[0]['merek'];
				$tipe1 = $resultMerekTipe1[0]['tipe'];

				$warna1 = $indexIdWarna[$id_tipe1][0];

				$explodeData1 = explode(',', $indexIdMemoriHargaStok[$id_tipe1.','.$warna1][0]);

				$memori1 = $explodeData1[0];
				$hargaBeli1 = $explodeData1[1];
				$hargaJual1 = $explodeData1[2];
				$stok1 = $explodeData1[3];
				$merekTipe1 = $merek1.' '.$tipe1;

				$rowspanTipe1 = $rowTipe[$id_tipe1];
				$rowspanWarna1 = $rowWarna[$id_tipe1.','.$warna1];

				?>
				<tr>
					<td rowspan="<?= $rowspanTipe1; ?>"><?= $i+1; ?></td>
					<td rowspan="<?= $rowspanTipe1; ?>"><?= $merekTipe1; ?></td>
					<td rowspan="<?= $rowspanWarna1; ?>"><?= $warna1; ?></td>
					<td><?= $memori1; ?></td>
					<td><?= rupiah($hargaBeli1); ?></td>
					<td><?= rupiah($hargaJual1); ?></td>
					<td><?= $stok1; ?></td>
				</tr>

				<?php if ($rowspanWarna1 > 1): ?>
					
					<?php for($j = 1; $j < $rowspanWarna1; $j++) :

						$explodeData2 = explode(',', $indexIdMemoriHargaStok[$id_tipe1.','.$warna1][$j]);

						$memori2 = $explodeData2[0];
						$hargaBeli2 = $explodeData2[1];
						$hargaJual2 = $explodeData2[2];
						$stok2 = $explodeData2[3];

						?>
						<tr>
							<td><?= $memori2; ?></td>
							<td><?= rupiah($hargaBeli2); ?></td>
							<td><?= rupiah($hargaJual2); ?></td>
							<td><?= $stok2; ?></td>
						</tr>

					<?php endfor ?>		

				<?php endif ?>

				<?php for($k = 1; $k < count($indexIdWarna[$id_tipe1]); $k++) : 

					$warna2 = $indexIdWarna[$id_tipe1][$k];
					$rowspanWarna2 = $rowWarna[$id_tipe1.','.$warna2];
					$explodeData3 = explode(',', $indexIdMemoriHargaStok[$id_tipe1.','.$warna2][0]);
					$memori3 = $explodeData3[0];
					$hargaBeli3 = $explodeData3[1];
					$hargaJual3 = $explodeData3[2];
					$stok3 = $explodeData3[3];
					?>

					<tr>
						<td rowspan="<?= $rowspanWarna2; ?>"><?= $warna2; ?></td>
						<td><?= $memori3; ?></td>
						<td><?= rupiah($hargaBeli3); ?></td>
						<td><?= rupiah($hargaJual3); ?></td>
						<td><?= $stok3; ?></td>
					</tr>
					
					<?php if ($rowspanWarna2 > 1): ?>
						
						<?php for($l = 1; $l < $rowspanWarna2; $l++) :

							$explodeData4 = explode(',', $indexIdMemoriHargaStok[$id_tipe1.','.$warna2][$l]);

							$memori4 = $explodeData4[0];
							$hargaBeli4 = $explodeData4[1];
							$hargaJual4 = $explodeData4[2];
							$stok4 = $explodeData4[3];

							?> 

							<tr>
								<td><?= $memori4; ?></td>
								<td><?= rupiah($hargaBeli4); ?></td>
								<td><?= rupiah($hargaJual4); ?></td>
								<td><?= $stok4; ?></td>
							</tr>
						<?php endfor ?>		
					<?php endif ?>
				<?php endfor ?>	
			<?php endfor ?>
		</table>
	</div>	
</div>	