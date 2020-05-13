<div class="input">
	<div class="inputBaru">
		<form action="" method="POST" class="ui-widget">
			<fieldset>
				<legend><h1>Input Barang Baru</h1></legend>
				<table>
					<tr>
						<td><label for="merek">Merek</label></td>
						<td>&emsp;:&emsp;</td>
						<td><input type="text" name="merek" id="merek" required="on" autocomplete="off" placeholder="OPPO"></td>
					</tr>
					<tr>
						<td><label for="tipe">Tipe</label></td>
						<td>&emsp;:&emsp;</td>
						<td><input type="text" name="tipe" id="tipe" required="on" autocomplete="off" placeholder="AS1"></td>
					</tr>
					<tr>
						<td><label for="warna">Warna</label></td>
						<td>&emsp;:&emsp;</td>
						<td><input type="text" name="warna" id="warna" required="on" autocomplete="off" placeholder="merah, biru, kuning"></td>
					</tr>
					<tr id="trmemori">
						<td>
							<label for="memori">Memori (RAM/ROM)</label>
						</td>
						<td>&emsp;:&emsp;</td>
						<td>
							<input type="text" size="10" name="memori1" required="on" id="memori" autocomplete="off" placeholder="4/64"><button name="tambah1" type="button" id="buttonTambah">+</button>
						</td>
					</tr>
					<tr id="trhargabeli">
						<td><label for="hargabeli">Harga Beli</label></td>
						<td>&emsp;:&emsp;</td>
						<td><input type="text" size="10" name="hargabeli1" required="on" id="hargabeli" autocomplete="off" placeholder="Rp. 1.000.000"></td>
					</tr>
					<tr id="trhargajual">
						<td><label for="hargajual">Harga Jual</label></td>
						<td>&emsp;:&emsp;</td>
						<td><input type="text" size="10" name="hargajual1" required="on" id="hargajual" autocomplete="off" placeholder="Rp. 1.000.000"><button type="button" name="buttonKurang" id="buttonKurang" class="hidden">-</button></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td><button type="reset" name="reset">Reset</button><button name="submit1" type="submit" id="submit1">Submit</button></td>
					</tr>
				</table>
			</fieldset>
		</form>
	</div>

	<div class="inputStok">
		<fieldset>
			<legend><h1>Input Stok</h1></legend>
			<form action="" method="POST">
				<div class="box1">
					<table id="table-cari">
						<tr>
							<td><label for="cari">Cari Barang</label></td>
							<td>&emsp;:&emsp;</td>
							<td>
								<div class="ui-widget">
									<input type="text" id="cari" size="40" autocomplete="off">
								</div>
							</td>
						</tr>
					</table>
				</div>
				<div class="box2">
					<table>
						<tr>
							<td><label for="keterangan">Keterangan</label></td>
							<td>&emsp;:&emsp;</td>
							<td>
								<div>
									<textarea id="keterangan" name="keterangan" autocomplete="off"></textarea>
								</div>
							</td>
						</tr>
					</table>
				</div>
				<div class="tableOutput none"> 
					<table>
						<tr>
							<th>Merek</th>
							<th>Tipe</th>
							<th>Warna</th>
							<th>Memori</th>
							<th>Harga Beli</th>
							<th>Harga Jual</th>
							<th><label for="stok">Stok</label></th>
						</tr>
						<tr>
							<td><input type="text" id="merekstok" autocomplete="off" required="on" readonly="readonly" disabled="true"></td>
							<td><input type="text" id="tipestok" autocomplete="off" required="on" readonly="readonly" disabled="true"></td>
							<td>
								<select id="warnastok" required="on" disabled="true">
									<option value="">--Pilih Warna--</option>
								</select>
							</td>
							<td>
								<select id="memoristok"  required="on" disabled="true">
									<option value="">--Pilih Memori--</option>
								</select>
							</td>
							<td><input type="text" id="hargabelistok" autocomplete="off" required="on" readonly="readonly" disabled="true"></td>
							<td><input type="text" id="hargajualstok" autocomplete="off" required="on" readonly="readonly" disabled="true"></td>
							<td><input type="number" id="stok" autocomplete="off" required="on" disabled="true"></td>
							<td><button type="reset" name="resetstok" id="resetstok">Reset</button><button name="submit2" type="button" id="submit2" disabled="true">Submit</button></td>	
						</tr>
					</table>
				</div>
				<div class="tableHasil none">
					<table>
						<tr>
							<th>No.</th>
							<th>Serial Number</th>
							<th>Merek</th>
							<th>Tipe</th>
							<th>Warna</th>
							<th>Memori</th>
							<th>Harga Beli</th>
							<th>Harga Jual</th>
						</tr>
					</table>
					<div class="submit3 cf">
						<button tipe='submit' name="submit3" id="submit3" disabled="true">Submit</button>
					</div>
				</div>
			</form>
		</fieldset>		
	</div>
</div>
