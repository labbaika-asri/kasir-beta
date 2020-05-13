<div class="edit-profile">
	<h1>Perbaharui Profile</h1>
	<form action="" method="POST" enctype="multipart/form-data">
		<div class="box1">
			<img src="img/<?= $_SESSION['photo']; ?>" alt="Photo Profile">
			<input type="file" id="gambar-edit" name="gambar-edit">
		</div>
		<div class="box2">
			<table>
				<tr>
					<td><label for="nama-edit">Nama</label></td>
					<td>&nbsp;:&nbsp;</td>
					<td><input type="text" name="nama-edit" id="nama-edit" maxlength="25" required="on" value="<?= $_SESSION['nama']; ?>"></td>
				</tr>
				<tr>
					<td><label for="no-hp-edit">Nomor Hanphone</label></td>
					<td>&nbsp;:&nbsp;</td>
					<td><input type="text" name="no-hp-edit" id="no-hp-edit" maxlength="20" required="on" value="<?= $_SESSION['no_hp']; ?>"></td>
				</tr>
			</table>
			<button type="submit" name="ubah-edit">Ubah</button>
		</div>
	</form>
</div>