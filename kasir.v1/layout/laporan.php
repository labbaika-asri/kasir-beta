<div class="laporan">
	<h1>Laporan</h1>
	<table class="ika">
		<tr>
			<td rowspan="2"><label for="laporan">Pilih</label></td>
			<td rowspan="2">&emsp;:&emsp;</td>
			<td colspan="3">
				<select name="laporan" id="laporan">
					<option value="1">Laporan Pemasukan</option>
					<option value="2">Laporan Penjualan</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="4">
				<button type="button" id="hari-ini">Hari ini</button>
				<button type="button" id="bulan-ini" class="select">Bulan ini</button>
				<button type="button" id="tahun-ini">Tahun ini</button>
			</td>
		</tr>
		<tr>
			<td><label for="tglawal">Sorting Tanggal</label></td>
			<td>&emsp;:&emsp;</td>
			<td>
				<input type="text" id="tglawal" placeholder="Tanggal Awal">
				<input type="text" id="tglakhir" placeholder="Tanggal Akhir">
				<button id="rst">X</button>
			</td>
		</tr>
		<tr><td colspan="4"><button type="button" id="cetakPdf">Buat PDF</button></td></tr>
	</table>
	<div class="hasil-laporan">
	</div>
</div>