<div class="update">
	<div class="update-barang">
		<form action="" method="POST" class="ui-widget">
			<fieldset>
				<legend><h1>Update Barang</h1></legend>

				<label for="cariupdate">Cari data&emsp;&nbsp;</label>
				<input type="text" name="cariupdate" id="cariupdate">
				<div class="hasil-update none">
					<table>
						<tr>
							<td><label for="idtipeupdate">Id Tipe</label></td>
							<td>&emsp;:&emsp;</td>
							<td><input type="text" name="idtipeupdate" id="idtipeupdate" required="on" autocomplete="off" readonly="readonly"></td>
						</tr>
						<tr>
							<td><label for="merekupdate">Merek</label></td>
							<td>&emsp;:&emsp;</td>
							<td><input type="text" name="merekupdate" id="merekupdate" required="on" autocomplete="off" placeholder="OPPO"></td>
						</tr>
						<tr>
							<td><label for="tipeupdate">Tipe</label></td>
							<td>&emsp;:&emsp;</td>
							<td><input type="text" name="tipeupdate" id="tipeupdate" required="on" autocomplete="off" placeholder="AS1"></td>
						</tr>
						<tr>
							<td><label for="warnaupdate">Warna</label></td>
							<td>&emsp;:&emsp;</td>
							<td><input type="text" name="warnaupdate" id="warnaupdate" required="on" autocomplete="off" placeholder="merah, biru, kuning"></td>
						</tr>
						<tr id="trmemori">
							<td>
								<label for="memoriupdate">Memori (RAM/ROM)</label>
							</td>
							<td>&emsp;:&emsp;</td>
							<td>
								<input type="text" size="10" name="memoriupdate1" required="on" id="memoriupdate" autocomplete="off" placeholder="4/64"><button name="buttontambahupdate" type="button" id="buttontambahupdate">+</button>
							</td>
						</tr>
						<tr id="trhargabeli">
							<td><label for="hargabeliupdate">Harga Beli</label></td>
							<td>&emsp;:&emsp;</td>
							<td><input type="text" size="10" name="hargabeliupdate1" required="on" id="hargabeliupdate" autocomplete="off" placeholder="Rp. 1.000.000"></td>
						</tr>
						<tr id="trhargajual">
							<td><label for="hargajualupdate">Harga Jual</label></td>
							<td>&emsp;:&emsp;</td>
							<td><input type="text" size="10" name="hargajualupdate1" required="on" id="hargajualupdate" autocomplete="off" placeholder="Rp. 1.000.000"><button type="button" name="buttonkurangupdate" id="buttonkurangupdate" class="hidden">-</button></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><button type="reset" name="resetupdate" id="resetupdate">Reset</button><button type="submit" name="deleteupdate" id="deleteupdate" disabled="true">Delete</button><button name="submitupdate" type="submit" id="submitupdate" disabled="true">Update</button></td>
						</tr></div>
					</table>
				</div>
			</fieldset>
		</form>
	</div>