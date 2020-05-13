<?php
$query = "SELECT * FROM `tb_user` ORDER BY status DESC";
$resultKaryawan = query($query);
?>

<div class="data-kariawan">
	<h1>Data Kariawan</h1>
	<div class="hasil-data cf">
		<?php 
		$i = 0;
		foreach ($resultKaryawan as $karyawan): ?>
			<div class="box1" index=<?= $i; ?>>
				<span class="delete" id=<?= $karyawan['username']; ?>>X</span>
				<img src="img/<?= $karyawan['photo'] ?>" alt="Photo Profile">
				<?php if ($karyawan['nama']): ?>
					<h3><?= $karyawan['nama']; ?></h3>
				<?php else: ?>
					<h3><?= $karyawan['username']; ?></h3>	
				<?php endif ?>
				<?php if ($karyawan['status'] == 'Administrator'): ?>
					<h5>(<span>Administrator</span>)</h5>		
				<?php else: ?>
					<h5>(<span>Karyawan</span>)</h5>
				<?php endif ?>
				<h6>Username : <?= $karyawan['username']; ?></h6>
				<h6>Nomor HP : <?= $karyawan['no_hp']; ?></h6>
			</div>
		<?php 
		$i++;
		endforeach;?>
	</div>
</div>