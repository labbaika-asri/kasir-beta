<div class="myprofile">
	<h1>Profile Saya</h1>
	<img src="img/<?= $_SESSION['photo']; ?>" alt="">
	<h2><?= $_SESSION['nama']; ?></h2>
	<?php if ($_SESSION['status'] == 'labbaika'): ?>
		<h4>(Administrator)</h4>
	<?php else: ?>
		<h4>(Karyawan)</h4>
	<?php endif ?>
	<table>
		<tr>
			<td>Username</td>
			<td>&emsp;:&emsp;</td>
			<td><?= $_SESSION['username']; ?></td>
		</tr>
		<tr>
			<td>Nomor Handphone</td>
			<td>&emsp;:&emsp;</td>
			<td><?= $_SESSION['no_hp']; ?></td>
		</tr>
	</table>
	<a href="?menu=8">Edit</a>
</div>