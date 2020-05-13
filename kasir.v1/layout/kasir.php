<div class="kasir">
	<form action="" method="POST">
		<h1>KASIR</h1>
		<div class="box1 ui-widget">
			<table>
				<tr>
					<td><label for="namapembelikasir">Nama Pembeli</label></td>
					<td>&emsp;:&emsp;</td>
					<td><input type="text" name="namapembelikasir" id="namapembelikasir" autocomplete="off" autofocus="on"></td>
				</tr>
				<tr>
					<td><label for="carikasir">Cari Barang</label></td>
					<td>&emsp;:&emsp;</td>
					<td><input type="text" id="carikasir" autocomplete="off"></td>
				</tr>
			</table>
		</div>
		<div class="box2">
			<table>
				<tr>
					<td><label for="keterangankasir">Keterangan</label></td>
					<td>&emsp;:&emsp;</td>
					<td><textarea name="keterangankasir" id="keterangankasir"></textarea></td>
				</tr>
			</table>
		</div>
		<div class="output-cari none">
			<table>
				<tr>
					<th>Merek</th>
					<th>Tipe</th>
					<th>Warna</th>
					<th>Memori</th>
					<th>Harga</th>
					<th><label for="jumlahpembelian">Jumlah Pembelian</label></th>
				</tr>
				<tr>
					<td><input type="text" id="merekpembelian" autocomplete="off" required="on" readonly="readonly" disabled="true"></td>
					<td><input type="text" id="tipepembelian" autocomplete="off" required="on" readonly="readonly" disabled="true"></td>
					<td>
						<select id="warnapembelian" required="on" disabled="true">
							<option value="">--Pilih Warna--</option>
						</select>
					</td>
					<td>
						<select id="memoripembelian"  required="on" disabled="true">
							<option value="">--Pilih Memori--</option>
						</select>
					</td>
					<td><input type="text" id="hargapembelian" autocomplete="off" required="on" readonly="readonly" disabled="true"></td>
					<td><input type="number" id="jumlahpembelian" autocomplete="off" required="on" disabled="true" min="1" value="1"></td>
					<td><button type="button" name="resetpembelian" id="resetpembelian">Reset</button><button name="submitpembelian1" type="button" id="submitpembelian1" disabled="true">Submit</button></td>	
				</tr>
			</table>
		</div>
		<div class="table-pembelian cf none">
			<h2>Daftar Pembelian</h2>
			<table>
				<tr>
					<th>No.</th>
					<th>Merek</th>
					<th>Tipe</th>
					<th>Warna</th>
					<th>Memori</th>
					<th>Harga</th>
					<th>Banyak Barang</th>
					<th>Total Harga</th>
				</tr>
			</table>
			<div class="submit-pembelian cf">
				<button tipe='submit' name="submitpembelian2" id="submitpembelian2"	disabled="true">Submit</button>
			</div>
		</div>
	</form>
</div>