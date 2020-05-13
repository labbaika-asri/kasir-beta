<div class="registrasi-karyawan">
	<h1>Registrasi Karyawan</h1>
	<div  class="daftar-baru">
		<fieldset>
			<legend><h2>Daftar Baru</h2></legend>
			<form action="" method="POST" class="ui-widget">
				<div class="box1">
					<table>
						<tr>
							<td><label for="username">Username</label></td>
							<td>&emsp;:&emsp;</td>
							<td><input type="text" name="username" id="username" minlength="5" autocomplete="off" required="on" autofocus></td>
						</tr>
						<tr>
							<td><label for="password">Password</label></td>
							<td>&emsp;:&emsp;</td>
							<td><input type="password" name="password" id="password" minlength="8" autocomplete="off" required="on"></td>
						</tr>
						<tr>
							<td><label for="repassword">Masukan kembali Password</label></td>
							<td>&emsp;:&emsp;</td>
							<td><input type="password" name="repassword" id="repassword" autocomplete="off" required="on"></td>
						</tr>
						<tr><td colspan="3"><button type="submit" name="submitregister">Register</button></td></tr>
					</table>
				</div>	
			</form>
		</fieldset>
	</div>
	<div class="ubah-password">
		<fieldset>
			<legend><h2>Ubah Password</h2></legend>
			<form action="" method="POST" class="ui-widget">
				<div class="box1">
					<table>
						<tr>
							<td><label for="username_ubah">Username</label></td>
							<td>&emsp;:&emsp;</td>
							<td><input type="text" name="username_ubah" id="username_ubah" minlength="5" autocomplete="off" required="on" autofocus></td>
						</tr>
						<tr>
							<td><label for="password_ubah">Password Baru</label></td>
							<td>&emsp;:&emsp;</td>
							<td><input type="password" name="password_ubah" id="password_ubah" minlength="8" autocomplete="off" required="on"></td>
						</tr>
						<tr>
							<td><label for="repassword_ubah">Masukan kembali Password</label></td>
							<td>&emsp;:&emsp;</td>
							<td><input type="password" name="repassword_ubah" id="repassword_ubah" autocomplete="off" required="on"></td>
						</tr>
						<tr><td colspan="3"><button type="submit" name="submit_ubah">Ubah</button></td></tr>
					</table>
				</div>	
			</form>
		</fieldset>
	</div>
</div>