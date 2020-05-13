// Menghubungkan ke jQuery
$(document).ready(function(){

	/* Fungsi formatRupiah */
	function formatRupiah(angka, prefix){
		var number_string = angka.replace(/[^,\d]/g, '').toString(),
		split   		= number_string.split(','),
		sisa     		= split[0].length % 3,
		rupiah     		= split[0].substr(0, sisa),
		ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

		// tambahkan titik jika yang di input sudah menjadi angka ribuan
		if(ribuan){
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
		return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
	}

	function removeRupiah(rupiah){
		let hasil = rupiah.replace('Rp. ', '');

		for (var i = 0; i < hasil.length; i++) {
			if (hasil.indexOf('.')) {
				hasil = hasil.replace('.', '');
			}
		}

		return parseInt(hasil);
	}	

	$('.input').ready(function(){

		// Membuat input memori dan harga dinamis

		const tdMemori = document.querySelectorAll('div.inputBaru tr#trmemori td')[2];
		const tdHargaBeli = document.querySelectorAll('div.inputBaru tr#trhargabeli td')[2];
		const tdHargaJual = document.querySelectorAll('div.inputBaru tr#trhargajual td')[2];

		$('div.input div.inputBaru tr#trhargabeli td input').on('keyup', function (){
			$(this).val(formatRupiah(this.value, 'Rp. '));
		});

		$('div.input div.inputBaru tr#trhargajual td input').on('keyup', function (){
			$(this).val(formatRupiah(this.value, 'Rp. '));
		});

		let x = 1;
		$('div.input div.inputBaru button#buttonTambah').on('click', function() {
			x++;

			const inputMemori = document.createElement('input');
			inputMemori.setAttribute('type', 'text');
			inputMemori.setAttribute('size', '10');
			inputMemori.setAttribute('name', 'memori' + x );
			inputMemori.setAttribute('required', 'on');
			inputMemori.setAttribute('autocomplete', 'off');
			inputMemori.setAttribute('placeholder', '4/64');


			const inputHargaBeli = document.createElement('input');
			inputHargaBeli.setAttribute('type', 'text');
			inputHargaBeli.setAttribute('size', '10');
			inputHargaBeli.setAttribute('name', 'hargabeli' + x );
			inputHargaBeli.setAttribute('required', 'on');
			inputHargaBeli.setAttribute('autocomplete', 'off');
			inputHargaBeli.setAttribute('placeholder', 'Rp. 1.000.000');
			inputHargaBeli.addEventListener('keyup', function(e){ 
				inputHargaBeli.value = formatRupiah(this.value, 'Rp. ');
			});

			const inputHargaJual = document.createElement('input');
			inputHargaJual.setAttribute('type', 'text');
			inputHargaJual.setAttribute('size', '10');
			inputHargaJual.setAttribute('name', 'hargajual' + x );
			inputHargaJual.setAttribute('required', 'on');
			inputHargaJual.setAttribute('autocomplete', 'off');
			inputHargaJual.setAttribute('placeholder', 'Rp. 1.000.000');
			inputHargaJual.addEventListener('keyup', function(e){ 
				inputHargaJual.value = formatRupiah(this.value, 'Rp. ');
			});

			tdMemori.insertBefore(inputMemori, buttonTambah);
			tdHargaBeli.appendChild(inputHargaBeli);
			tdHargaJual.insertBefore(inputHargaJual, buttonKurang);

			if (x >= 4) buttonTambah.classList.toggle('hidden');

			if (x == 2) buttonKurang.classList.toggle('hidden');
		});

		$('div.input div.inputBaru button#buttonKurang').on('click', function(){

			x--;

			const delMemori = document.querySelectorAll('div.inputBaru tr#trmemori input')[x];
			tdMemori.removeChild(delMemori);

			const delHargaBeli = document.querySelectorAll('div.inputBaru tr#trhargabeli input')[x];
			tdHargaBeli.removeChild(delHargaBeli);

			const delHargaJual = document.querySelectorAll('div.inputBaru tr#trhargajual input')[x];
			tdHargaJual.removeChild(delHargaJual);

			if(x == 1) buttonKurang.classList.toggle('hidden');

			if(x == 3) buttonTambah.classList.toggle('hidden');
		});

		// Membuat autocomplete merek dan search menggunakan jQuery
		let merek = "ajax/datamerek.php";
		$('#merek').autocomplete({
			source : merek
		});

		let data = "ajax/datacari.php";
		$('#cari').autocomplete({
			source : data
		});


		// Membuat autofill search
		const tableOutput = document.querySelector('div.input div.inputStok div.tableOutput');
		$('#cari').on('keyup', function(){
			const input = $('#cari').val();
			$.ajax({
				url: 'ajax/hasilinput.php',
				data: 'input='+input
			}).done(function(data){

				$('#stok').val('');
				$('#stok').prop('disabled', true);
				$(`#merekstok`).prop('disabled', true);
				$(`#tipestok`).prop('disabled', true);
				$(`#warnastok`).prop('disabled', true);
				$(`#memoristok`).prop('disabled', true);
				$(`#hargabelistok`).prop('disabled', true);
				$(`#hargajualstok`).prop('disabled', true);
				$(`#submit2`).prop('disabled', true);

				let json = data;

				if (json) {
					$(`#merekstok`).prop('disabled', false);
					$(`#tipestok`).prop('disabled', false);
					$(`#warnastok`).prop('disabled', false);
					$(`#memoristok`).prop('disabled', false);
					
					let obj = JSON.parse(json);
					$('#merekstok').val(obj.merek);
					$('#tipestok').val(obj.tipe);
					$('#hargajualstok').val('');
					$('#hargabelistok').val('');

					const selectWarna = document.querySelector('div.input div.inputStok div.tableOutput select#warnastok');
					const selectMemori = document.querySelector('div.input div.inputStok div.tableOutput select#memoristok');

					const optionWarna = document.querySelectorAll('div.input div.inputStok div.tableOutput select#warnastok option');
					for (let i = 1; i < optionWarna.length; i++) {
						selectWarna.removeChild(optionWarna[i]);
					}

					const optionMemori = document.querySelectorAll('div.input div.inputStok div.tableOutput select#memoristok option');
					for (let i = 1; i < optionMemori.length; i++) {
						selectMemori.removeChild(optionMemori[i]);
					}

					for (let i = 0; i < obj.warna.length; i++) {
						const newOption = document.createElement('option');
						newOption.setAttribute('value', obj.warna[i]);
						const text = document.createTextNode(obj.warna[i]);
						newOption.appendChild(text);
						selectWarna.appendChild(newOption);
					}

					for (let i = 0; i < obj.memori.length; i++) {
						const newOption = document.createElement('option');
						newOption.setAttribute('value', obj.memori[i]);
						const text = document.createTextNode(obj.memori[i]);
						newOption.appendChild(text);
						selectMemori.appendChild(newOption);
					}

					tableOutput.classList.remove('none');
				}else{
					tableOutput.classList.add('none');
				}
			});
		});


		$('#memoristok').on('input', function() {
			const valueMerek = $('#merekstok').val();
			const valueTipe = $('#tipestok').val();
			const valueMemori = $('#memoristok').val();

			if (valueMemori !== '') {
				$(`#submit2`).prop('disabled', false);
				$.ajax({
					url: 'ajax/hasilharga.php',
					type: 'POST',
					data: {'merek':valueMerek, 'tipe':valueTipe, 'memori':valueMemori},
					typeData: 'json'
				}).done(function(data){
					let json = data;
					let obj = JSON.parse(json);
					$('#hargabelistok').val(formatRupiah(obj.hargabeli, 'Rp. '));
					$('#hargajualstok').val(formatRupiah(obj.hargajual, 'Rp. '));
					$(`#hargabelistok`).prop('disabled', false);
					$(`#hargajualstok`).prop('disabled', false);
					$('#stok').prop('disabled', false);
				});
			}else{
				$('#hargabelistok').val('');
				$('#hargajualstok').val('');
				$(`#hargabelistok`).prop('disabled', true);
				$(`#hargajualstok`).prop('disabled', true);
				$('#stok').prop('disabled', true);
			}

		});

		$('#warnastok').on('change', function() {
			if ($('#warnastok') !== '') {
				$('#warnastok').removeClass('red');
			}
		});

		$('#stok').on('keyup', function(){
			if ($('#stok') !== '') {
				$('#stok').removeClass('red');
			}
		});

		let allData = [];

		const tableHasil = document.querySelector('div.input div.inputStok div.tableHasil');
		$('#submit2').on('click', function(e) {
			if ($('#stok').val() === '') {
				$('#stok').addClass('red');
			}

			if ($('#warnastok').val() === '') {
				$('#warnastok').addClass('red');
			}


			if($('#merekstok').val() && $('#tipestok').val() && $('#warnastok').val() && $('#memoristok').val() && $('#hargabelistok').val() && $('#hargajualstok').val() && $('#stok').val()){
				tableHasil.classList.remove('none');

				$('#submit3').prop('disabled', false);

				let stok = $('#stok').val();

				let data = [];
				for (let i = 0; i < stok; i++) {

					const now = new Date();
					
					let millsec = String(now.getTime());

					let x = String(i);
					if(x.length == 2){
						x = '0' + x;
					}else if(x.length == 1){
						x = '00' + x; 
					}

					let serialNumber = millsec + x; 

					data[i] = [
					serialNumber,
					$('#merekstok').val(),
					$('#tipestok').val(),
					$('#warnastok').val(),
					$('#memoristok').val(),
					$('#hargabelistok').val(),
					$('#hargajualstok').val()
					]
				}

				allData = allData.concat(data);
				showData();
				$('#stok').val('');
			}

		});

		$('#resetstok').on('click', function(){
			tableOutput.classList.add('none');
			$('#stok').prop('disabled', true);
			$(`#merekstok`).prop('disabled', true);
			$(`#tipestok`).prop('disabled', true);
			$(`#warnastok`).prop('disabled', true);
			$(`#memoristok`).prop('disabled', true);
			$(`#merekstok`).prop('disabled', true);
			$(`#hargabelistok`).prop('disabled', true);
			$(`#hargajualstok`).prop('disabled', true);
			$('#stok').removeClass('red');
			$('#warnastok').removeClass('red');
			$('#cari').focus();

		});

		function removeData(){
			const hasilOutput = document.querySelector('div.input div.inputStok div.tableHasil table');
			const trHasilOutput = document.querySelectorAll('div.input div.inputStok div.tableHasil table tr');
			for (var i = 1; i < trHasilOutput.length; i++) {
				hasilOutput.removeChild(trHasilOutput[i]);
			}
		}

		function showData(){
			const hasilOutput = document.querySelector('div.input div.inputStok div.tableHasil table');
			removeData();

			for (let i = 0; i < allData.length; i++) {

				const tr = document.createElement('tr');
				const td = [];
				const hasil = [];
				for (let i = 0; i < 10; i++) {
					td[i] = document.createElement('td');
				}
				
				hasil[0] = document.createTextNode(`${i+1}`);

				hasil[1] = document.createElement('input');
				hasil[1].setAttribute('id', `serihasil${i+1}`);
				hasil[1].setAttribute('name', `serihasil${i+1}`);
				hasil[1].setAttribute('readonly', `readonly`);
				hasil[1].setAttribute('value', `${allData[i][0]}`);

				hasil[2] = document.createElement('input');
				hasil[2].setAttribute('id', `merekhasil${i+1}`);
				hasil[2].setAttribute('name', `merekhasil${i+1}`);
				hasil[2].setAttribute('readonly', `readonly`);
				hasil[2].setAttribute('value', `${allData[i][1]}`);

				hasil[3] = document.createElement('input');
				hasil[3].setAttribute('id', `tipehasil${i+1}`);
				hasil[3].setAttribute('name', `tipehasil${i+1}`);
				hasil[3].setAttribute('readonly', `readonly`);
				hasil[3].setAttribute('value', `${allData[i][2]}`);

				hasil[4] = document.createElement('input');
				hasil[4].setAttribute('id', `warnahasil${i+1}`);
				hasil[4].setAttribute('name', `warnahasil${i+1}`);
				hasil[4].setAttribute('readonly', `readonly`);
				hasil[4].setAttribute('value', `${allData[i][3]}`);

				hasil[5] = document.createElement('input');
				hasil[5].setAttribute('id', `memorihasil${i+1}`);
				hasil[5].setAttribute('name', `memorihasil${i+1}`);
				hasil[5].setAttribute('readonly', `readonly`);
				hasil[5].setAttribute('value', `${allData[i][4]}`);

				hasil[6] = document.createElement('input');
				hasil[6].setAttribute('id', `hargabelihasil${i+1}`);
				hasil[6].setAttribute('name', `hargabelihasil${i+1}`);
				hasil[6].setAttribute('readonly', `readonly`);
				hasil[6].setAttribute('value', `${allData[i][5]}`);

				hasil[7] = document.createElement('input');
				hasil[7].setAttribute('id', `hargajualhasil${i+1}`);
				hasil[7].setAttribute('name', `hargajualhasil${i+1}`);
				hasil[7].setAttribute('readonly', `readonly`);
				hasil[7].setAttribute('value', `${allData[i][6]}`);
				
				hasil[8] = document.createElement('span');
				hasil[8].classList.add('dell-allData')
				textHasil8 = document.createTextNode('X');
				hasil[8].appendChild(textHasil8);

				for (let j = 0; j < hasil.length; j++) {
					td[j].appendChild(hasil[j]);
					tr.appendChild(td[j]);
				}
				hasilOutput.appendChild(tr);
			}
		}

		$('div.input div.inputStok div.tableHasil').on('click', function(e){
			if (e.target.className == 'dell-allData') {
				const index = parseInt(e.target.parentElement.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.innerText);

				allData.splice(index-1, 1);
				showData();

				if(allData.length == 0){
					tableHasil.classList.add('none');
					$('#submit3').prop('disabled', true);
				};
				e.preventDefault();
			}
		});

		$('#submit3').on('click', function(){
			$('#stok').prop('disabled', true);
			$(`#merekstok`).prop('disabled', true);
			$(`#tipestok`).prop('disabled', true);
			$(`#warnastok`).prop('disabled', true);
			$(`#memoristok`).prop('disabled', true);
			$(`#merekstok`).prop('disabled', true);
			$(`#hargabelistok`).prop('disabled', true);
			$(`#hargajualstok`).prop('disabled', true);
		});
	});


	$(".stok").ready(function() {
		$('#cari2').on('keyup', function(){
			$.get('ajax/outputstok.php?keyword=' + $('#cari2').val(), function(data){
				$('div.stok div.stok-output').html(data);
			});	
		});
	});

	$(".update").ready(function(){

		let data = "ajax/datacari.php";
		$('#cariupdate').autocomplete({
			source : data
		});

		const tdMemoriUpdate = document.querySelectorAll('div.update tr#trmemori td')[2];
		const tdHargaBeliUpdate = document.querySelectorAll('div.update tr#trhargabeli td')[2];
		const tdHargaJualUpdate = document.querySelectorAll('div.update tr#trhargajual td')[2];

		var y = 1;
		$("#cariupdate").on('keyup', function(){

			const input = $('#cariupdate').val();

			$.ajax({
				url: 'ajax/hasilinput.php',
				data: 'input='+input,
				type: 'GET',
				typeData: 'json'

			}).done(function(data){
				let json = data;

				$('div.hasil-update')[0].classList.add('none');
				$('#idtipeupdate').val('');
				$('#deleteupdate').prop('disabled', true);
				$('#submitupdate').prop('disabled', true);

				if (json) {

				$('#deleteupdate').prop('disabled', false);
				$('#submitupdate').prop('disabled', false);

					for (let i = 1; i < y; i++) {
						const delMemoriUpdate = document.querySelectorAll('div.update tr#trmemori input')[1];
						tdMemoriUpdate.removeChild(delMemoriUpdate);

						const delHargaBeliUpdate = document.querySelectorAll('div.update tr#trhargabeli input')[1];
						tdHargaBeliUpdate.removeChild(delHargaBeliUpdate);

						const delHargaJualUpdate = document.querySelectorAll('div.update tr#trhargajual input')[1];
						tdHargaJualUpdate.removeChild(delHargaJualUpdate);
					}
					y = 1;

					$('div.hasil-update')[0].classList.remove('none');

					let obj = JSON.parse(json);
					$('#idtipeupdate').val(obj.idTipe);
					$('#merekupdate').val(obj.merek);
					$('#tipeupdate').val(obj.tipe);

					const warna = obj.warna;
					str = '';
					for (let i = 0; i < warna.length; i++) {
						if (i == (warna.length-1)) {
							str += warna[i];
						}else{
							str += warna[i]+', ';
						}
					}

					$('#warnaupdate').val(str);

					const memori = obj.memori;
					const hargaBeli = obj.hargaBeli;
					const hargaJual = obj.hargaJual;

					$('#memoriupdate').val(memori[0]);
					$('#hargabeliupdate').val(formatRupiah(hargaBeli[0], 'Rp. '));
					$('#hargajualupdate').val(formatRupiah(hargaJual[0], 'Rp. '));

					if (memori.length > 1) {
						for (let i = 1; i < memori.length; i++) {

							const inputMemoriUpdate = document.createElement('input');
							inputMemoriUpdate.setAttribute('type', 'text');
							inputMemoriUpdate.setAttribute('size', '10');
							inputMemoriUpdate.setAttribute('name', 'memoriupdate' + (i+1));
							inputMemoriUpdate.setAttribute('required', 'on');
							inputMemoriUpdate.setAttribute('autocomplete', 'off');
							inputMemoriUpdate.setAttribute('placeholder', '4/64');

							const inputHargaBeliUpdate = document.createElement('input');
							inputHargaBeliUpdate.setAttribute('type', 'text');
							inputHargaBeliUpdate.setAttribute('size', '10');
							inputHargaBeliUpdate.setAttribute('name', 'hargabeliupdate' + (i+1));
							inputHargaBeliUpdate.setAttribute('required', 'on');
							inputHargaBeliUpdate.setAttribute('autocomplete', 'off');
							inputHargaBeliUpdate.setAttribute('placeholder', 'Rp. 1.000.000');
							inputHargaBeliUpdate.addEventListener('keyup', function(e){ 
								inputHargaBeliUpdate.value = formatRupiah(this.value, 'Rp. ');
							});

							const inputHargaJualUpdate = document.createElement('input');
							inputHargaJualUpdate.setAttribute('type', 'text');
							inputHargaJualUpdate.setAttribute('size', '10');
							inputHargaJualUpdate.setAttribute('name', 'hargajualupdate' + (i+1));
							inputHargaJualUpdate.setAttribute('required', 'on');
							inputHargaJualUpdate.setAttribute('autocomplete', 'off');
							inputHargaJualUpdate.setAttribute('placeholder', 'Rp. 1.000.000');
							inputHargaJualUpdate.addEventListener('keyup', function(e){ 
								inputHargaJualUpdate.value = formatRupiah(this.value, 'Rp. ');
							});

							tdMemoriUpdate.insertBefore(inputMemoriUpdate, $('#buttontambahupdate')[0]);
							tdHargaBeliUpdate.appendChild(inputHargaBeliUpdate);
							tdHargaJualUpdate.insertBefore(inputHargaJualUpdate, $('#buttonkurangupdate')[0]);

							let namaMemori = 'memoriupdate'+(i+1);
							let namaHargaBeli = 'hargabeliupdate'+(i+1);
							let namaHargaJual = 'hargajualupdate'+(i+1);
							
							$(`input[name = '${namaMemori}']`).val(`${memori[i]}`);
							$(`input[name = '${namaHargaBeli}']`).val(formatRupiah(hargaBeli[i], 'Rp. '));
							$(`input[name = '${namaHargaJual}']`).val(formatRupiah(hargaJual[i], 'Rp. '));
							y++;
						}
					}

					if(y == 4){
						$('#buttontambahupdate')[0].classList.add('hidden');
						$('#buttonkurangupdate')[0].classList.remove('hidden');
					}else if( y > 1 && y < 4 ){
						$('#buttontambahupdate')[0].classList.remove('hidden');
						$('#buttonkurangupdate')[0].classList.remove('hidden');
					}else{
						$('#buttontambahupdate')[0].classList.remove('hidden');
						$('#buttonkurangupdate')[0].classList.add('hidden');
					}
				}
			});
		});

		$('#buttontambahupdate').on('click', function(){
			y++;

			const inputMemoriUpdate = document.createElement('input');
			inputMemoriUpdate.setAttribute('type', 'text');
			inputMemoriUpdate.setAttribute('size', '10');
			inputMemoriUpdate.setAttribute('name', 'memoriupdate' + y );
			inputMemoriUpdate.setAttribute('required', 'on');
			inputMemoriUpdate.setAttribute('autocomplete', 'off');
			inputMemoriUpdate.setAttribute('placeholder', '4/64');


			const inputHargaBeliUpdate = document.createElement('input');
			inputHargaBeliUpdate.setAttribute('type', 'text');
			inputHargaBeliUpdate.setAttribute('size', '10');
			inputHargaBeliUpdate.setAttribute('name', 'hargabeliupdate' + y );
			inputHargaBeliUpdate.setAttribute('required', 'on');
			inputHargaBeliUpdate.setAttribute('autocomplete', 'off');
			inputHargaBeliUpdate.setAttribute('placeholder', 'Rp. 1.000.000');
			inputHargaBeliUpdate.addEventListener('keyup', function(e){ 
				inputHargaBeliUpdate.value = formatRupiah(this.value, 'Rp. ');
			});

			const inputHargaJualUpdate = document.createElement('input');
			inputHargaJualUpdate.setAttribute('type', 'text');
			inputHargaJualUpdate.setAttribute('size', '10');
			inputHargaJualUpdate.setAttribute('name', 'hargajualupdate' + y );
			inputHargaJualUpdate.setAttribute('required', 'on');
			inputHargaJualUpdate.setAttribute('autocomplete', 'off');
			inputHargaJualUpdate.setAttribute('placeholder', 'Rp. 1.000.000');
			inputHargaJualUpdate.addEventListener('keyup', function(e){ 
				inputHargaJualUpdate.value = formatRupiah(this.value, 'Rp. ');
			});

			tdMemoriUpdate.insertBefore(inputMemoriUpdate, $('#buttontambahupdate')[0]);
			tdHargaBeliUpdate.appendChild(inputHargaBeliUpdate);
			tdHargaJualUpdate.insertBefore(inputHargaJualUpdate, $('#buttonkurangupdate')[0]);

			if (y >= 4) $('#buttontambahupdate')[0].classList.toggle('hidden');

			if (y == 2) $('#buttonkurangupdate')[0].classList.toggle('hidden');
		});

		$('#buttonkurangupdate').on('click', function(){
			y--;

			const delMemoriUpdate = document.querySelectorAll('div.update tr#trmemori input')[y];
			tdMemoriUpdate.removeChild(delMemoriUpdate);

			const delHargaBeliUpdate = document.querySelectorAll('div.update tr#trhargabeli input')[y];
			tdHargaBeliUpdate.removeChild(delHargaBeliUpdate);

			const delHargaJualUpdate = document.querySelectorAll('div.update tr#trhargajual input')[y];
			tdHargaJualUpdate.removeChild(delHargaJualUpdate);

			if(y == 1) $('#buttonkurangupdate')[0].classList.toggle('hidden');

			if(y == 3) $('#buttontambahupdate')[0].classList.toggle('hidden');
		});	


		$('#resetupdate').on('click', function(){
			$('div.hasil-update')[0].classList.add('none');
			$('#deleteupdate').prop('disabled', true);
			$('#submitupdate').prop('disabled', true);
		});

		$('#deleteupdate').on('click', function(){
			if ($('#idtipeupdate').val()){
				return confirm('Pastikan data tidak sedang digunakan, Yakin ingin menghapusnya?');
			}
		});
	});

	$('.kasir').ready(function(){

		function deleteWarnaPembelian(){
			const selectWarnaPembelian = document.querySelector('div.kasir div.output-cari select#warnapembelian');
			const optionWarnaPembelian = document.querySelectorAll('div.kasir div.output-cari select#warnapembelian option');
			for (let i = 1; i < optionWarnaPembelian.length; i++) {
				selectWarnaPembelian.removeChild(optionWarnaPembelian[i]);
			}
		}
		
		let data = "ajax/carikasir.php";
		$('#carikasir').autocomplete({
			source : data
		});

		$('#carikasir').on('keyup', function(){
			let hasil = $(this).val();

			$.ajax({
				url: 'ajax/hasilcarikasir.php',
				data: 'input='+ hasil,
				type: 'GET',
				typeData: 'json'
			}).done(function(data){
				let json= data;
				
				$('#merekpembelian').prop('disabled', true);
				$('#merekpembelian').val('');
				$('#tipepembelian').prop('disabled', true);
				$('#tipepembelian').val('');
				$('#warnapembelian').prop('disabled', true);
				deleteWarnaPembelian();
				$('#memoripembelian').prop('disabled', true);
				deleteMemoriPembelian();
				$('#hargapembelian').prop('disabled', true);
				$('#hargapembelian').val('');
				$('#jumlahpembelian').prop('disabled', true);
				$('#jumlahpembelian').val('1');
				$('#jumlahpembelian').prop('max', '0');
				$('#jumlahpembelian').prop('value', '1');
				$('#jumlahpembelian').prop('placeholder', '');
				$('#submitpembelian1').prop('disabled', true);
				$('.output-cari')[0].classList.add('none');

				
				if (json) {
					let obj = JSON.parse(json);

					$('#merekpembelian').prop('disabled', false);
					$('#tipepembelian').prop('disabled', false);
					$('#warnapembelian').prop('disabled', false);

					$('#merekpembelian').val(obj.merek.toUpperCase());
					$('#tipepembelian').val(obj.tipe.toUpperCase());
						
					deleteWarnaPembelian();

					const selectWarnaPembelian = document.querySelector('div.kasir div.output-cari select#warnapembelian');
					for (let i = 0; i < obj.warna.length; i++) {
						const newOption = document.createElement('option');
						newOption.setAttribute('value', obj.warna[i]);
						const text = document.createTextNode(obj.warna[i]);
						newOption.appendChild(text);
						selectWarnaPembelian.appendChild(newOption);
					}

					$('.output-cari')[0].classList.remove('none');		
				}
			});
		});

		function deleteMemoriPembelian() {
			const selectMemoriPembelian = document.querySelector('div.kasir div.output-cari select#memoripembelian');
			const optionMemoriPembelian = document.querySelectorAll('div.kasir div.output-cari select#memoripembelian option');

			for (let i = 1; i < optionMemoriPembelian.length; i++) {
				selectMemoriPembelian.removeChild(optionMemoriPembelian[i]);
			}
		}

		$('#warnapembelian').on('input', function() {
			$('#hargapembelian').val('');
			$('#jumlahpembelian').val('1');

			if (this.value !== '') {
				const valueMerek = $('#merekpembelian').val();
				const valueTipe = $('#tipepembelian').val();
				const valueWarna = $('#warnapembelian').val();

				$.ajax({
					url: 'ajax/hasilwarnakasir.php',
					type: 'POST',
					data: {'merek':valueMerek, 'tipe':valueTipe, 'warna':valueWarna},
					typeData: 'json'
				}).done(function(data){
					$('#memoripembelian').prop('disabled', false);
					let json = data;
					let obj = JSON.parse(json);

					const selectMemoriPembelian = document.querySelector('div.kasir div.output-cari select#memoripembelian');
					
					deleteMemoriPembelian();

					for (let i = 0; i < obj.length; i++) {
						const newOption = document.createElement('option');
						newOption.setAttribute('value', obj[i]);
						const text = document.createTextNode(obj[i]);
						newOption.appendChild(text);
						selectMemoriPembelian.appendChild(newOption);
					}	
				});
			}else{
				deleteMemoriPembelian();
				$('#hargapembelian').val('');
				$('#hargapembelian').prop('disabled', true);
				$('#jumlahpembelian').prop('max', '0');
				$('#jumlahpembelian').val('')
				$('#jumlahpembelian').prop('disabled', true);
				$('#jumlahpembelian').prop('placeholder', '');
				$('#submitpembelian1').prop('disabled', true);
			}
		});

		$('#memoripembelian').on('input', function() {
			const valueMerek = $('#merekpembelian').val();
			const valueTipe = $('#tipepembelian').val();
			const valueWarna = $('#warnapembelian').val();
			const valueMemori = $('#memoripembelian').val();

			if (valueMemori !== '') {
				$.ajax({
					url: 'ajax/hasilmemorikasir.php',
					type: 'POST',
					data: {'merek':valueMerek, 'tipe':valueTipe, 'warna':valueWarna, 'memori':valueMemori},
					typeData: 'json'
				}).done(function(data){
					$('#hargapembelian').prop('disabled', false);
					$('#jumlahpembelian').prop('disabled', false);
					let json = data;
					let obj = JSON.parse(json);

					$('#hargapembelian').val(formatRupiah(obj.harga, 'Rp. '));
					$('#jumlahpembelian').prop('max', obj.stok);
					$('#jumlahpembelian').prop('value', '1');
					$('#jumlahpembelian').prop('placeholder', 'Max '+obj.stok);
					$('#submitpembelian1').prop('disabled', false);
				});
			}else{
				$('#hargapembelian').val('');
				$('#hargapembelian').prop('disabled', true);
				$('#jumlahpembelian').prop('max', '0');
				$('#jumlahpembelian').val('')
				$('#jumlahpembelian').prop('disabled', true);
				$('#jumlahpembelian').prop('placeholder', '');
				$('#submitpembelian1').prop('disabled', true);
			}
		});

		function maxLength(val, mx){
			if (val) {
				let value = parseInt(val);
				let max = parseInt(mx);
				if (value > max) {
					return max;
				}else if(value < 1){
					return 1;
				}else{
					return value;
				}
			}
		}

		$('#jumlahpembelian').on('keyup', function(){
			let max = $(this).attr('max');
			$(this).val(maxLength(this.value, max));
		});

		let dataPembelian = [];

		function removePembelian(){
			const tablePembelian = document.querySelector('div.table-pembelian table');
			const tablePembelianTr = document.querySelectorAll('div.table-pembelian table tr');
			for (var i = 1; i < tablePembelianTr.length; i++) {
				tablePembelian.removeChild(tablePembelianTr[i]);
			}
		}

		function showPembelian(){

			removePembelian();

			const tablePembelian = document.querySelector('div.table-pembelian table');
			for (let i = 0; i < dataPembelian.length; i++) {

				const tr = document.createElement('tr');
				const td = [];
				const hasil = [];
				for (let i = 0; i < 9; i++) {
					td[i] = document.createElement('td');
				}

				hasil[0] = document.createTextNode(`${i+1}`);
			
				hasil[1] = document.createElement('input');
				hasil[1].setAttribute('name', `merekpembelian${i+1}`);
				hasil[1].setAttribute('readonly', `readonly`);
				hasil[1].setAttribute('value', `${dataPembelian[i][0]}`);

				hasil[2] = document.createElement('input');
				hasil[2].setAttribute('name', `tipepembelian${i+1}`);
				hasil[2].setAttribute('readonly', `readonly`);
				hasil[2].setAttribute('value', `${dataPembelian[i][1]}`);

				hasil[3] = document.createElement('input');
				hasil[3].setAttribute('name', `warnapembelian${i+1}`);
				hasil[3].setAttribute('readonly', `readonly`);
				hasil[3].setAttribute('value', `${dataPembelian[i][2]}`);

				hasil[4] = document.createElement('input');
				hasil[4].setAttribute('name', `memoripembelian${i+1}`);
				hasil[4].setAttribute('readonly', `readonly`);
				hasil[4].setAttribute('value', `${dataPembelian[i][3]}`);

				hasil[5] = document.createElement('input');
				hasil[5].setAttribute('name', `hargapembelian${i+1}`);
				hasil[5].setAttribute('readonly', `readonly`);
				hasil[5].setAttribute('value', `${dataPembelian[i][4]}`);

				hasil[6] = document.createElement('input');
				hasil[6].setAttribute('type', 'number');
				hasil[6].setAttribute('name', `banyakpembelian${i+1}`);
				hasil[6].setAttribute('nama', 'labbaika');
				hasil[6].setAttribute('min', `1`);
				hasil[6].setAttribute('max', `${dataPembelian[i][6]}`)

				hasil[7] = document.createElement('input');
				hasil[7].setAttribute('id', `totalHargaPembelian${i+1}`);
				hasil[7].setAttribute('readonly', `readonly`);

				hasil[8] = document.createElement('span');
				hasil[8].classList.add('dell-allData')
				textHasil8 = document.createTextNode('X');
				hasil[8].appendChild(textHasil8);

				for (let j = 0; j < hasil.length; j++) {
					td[j].appendChild(hasil[j]);
					tr.appendChild(td[j]);
				}

				tablePembelian.appendChild(tr);
				let nama1 = `banyakpembelian${i+1}`;
				$(`input[name = "${nama1}"]`).val(`${dataPembelian[i][5]}`);
				$(`input[name = "${nama1}"]`).on('change', function(){
					$(this).val(maxLength(this.value, $(this).attr('max')));
					let index = parseInt(this.parentElement.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.previousElementSibling.innerText);
					dataPembelian[index-1][5] = this.value;

					let harga = this.parentElement.previousSibling.firstChild.value;
					this.parentElement.nextSibling.firstChild.value = formatRupiah( String(removeRupiah(harga) * $(this).val()), 'Rp. ');

					const inputTotalBayar = $('input#totalBayar');
			
					totalBayar = 0;
					for (var i = 0; i < dataPembelian.length; i++) {
						let ika = `totalHargaPembelian${i+1}`;
						totalBayar += removeRupiah($(`#${ika}`).val());
					}

					inputTotalBayar.val(formatRupiah(String(totalBayar), 'Rp. '));
				});


				let jumlah = parseInt(dataPembelian[i][5]);

				let harga = removeRupiah(dataPembelian[i][4]);

				let totalHarga = String(jumlah * harga);
				let nama3 = `totalHargaPembelian${i+1}`;
				let total = $(`#${nama3}`).val(formatRupiah(totalHarga, 'Rp. '));
			}

			const trTotal = document.createElement('tr');
			
			const tdTotal = document.createElement('td');
			tdTotal.setAttribute('colspan', '7');
			const tdTotalText = document.createTextNode('Total Bayar');
			tdTotal.appendChild(tdTotalText);
			
			const tdTotalHarga = document.createElement('td');
			const tdInput = document.createElement('input');
			tdInput.setAttribute('readonly', 'readonly');
			tdInput.setAttribute('id', 'totalBayar');
			tdTotalHarga.appendChild(tdInput);
			
			trTotal.appendChild(tdTotal);
			trTotal.appendChild(tdTotalHarga);
			tablePembelian.appendChild(trTotal);

			const inputTotalBayar = $('input#totalBayar');
			
			totalBayar = 0;
			for (var i = 0; i < dataPembelian.length; i++) {
				let ika = `totalHargaPembelian${i+1}`;
				totalBayar += removeRupiah($(`#${ika}`).val());
			}

			inputTotalBayar.val(formatRupiah(String(totalBayar), 'Rp. '));
		}

		$('#resetpembelian').on('click', function(){
			$('#carikasir').val('');
			$('#merekpembelian').prop('disabled', true);
			$('#merekpembelian').val('');
			$('#tipepembelian').prop('disabled', true);
			$('#tipepembelian').val('');
			$('#warnapembelian').prop('disabled', true);
			deleteWarnaPembelian();
			$('#memoripembelian').prop('disabled', true);
			deleteMemoriPembelian();
			$('#hargapembelian').prop('disabled', true);
			$('#hargapembelian').val('');
			$('#jumlahpembelian').prop('disabled', true);
			$('#jumlahpembelian').prop('max', '0');
			$('#jumlahpembelian').prop('value', '1');
			$('#jumlahpembelian').prop('placeholder', '');
			$('.output-cari')[0].classList.add('none');
			$('#carikasir').focus();
			$('#submitpembelian1').prop('disabled', true);

		});

		$('#jumlahpembelian').on('keyup', function(){
			if (this.value !== '') {
				$('#jumlahpembelian').removeClass('red');
			}
		});

		$('#submitpembelian1').on('click', function(){
			const valueMerek = $('#merekpembelian').val();
			const valueTipe = $('#tipepembelian').val();
			const valueWarna = $('#warnapembelian').val();
			const valueMemori = $('#memoripembelian').val();
			const valueHarga = $('#hargapembelian').val()
			const valueJumlah = $('#jumlahpembelian').val();
			const valueMax = $('#jumlahpembelian').attr('max');

			if (valueJumlah === '' ) {
				$('#jumlahpembelian').addClass('red');
			}

			if (valueMerek && valueTipe && valueWarna && valueMemori && valueHarga && valueJumlah && valueMax) {
				let data = [valueMerek, valueTipe, valueWarna, valueMemori, valueHarga, valueJumlah, valueMax]; 

				if (dataPembelian.length > 0) {

					let cek = false;

					for (let i = 0; i < dataPembelian.length; i++) {

						if (dataPembelian[i][0] == valueMerek && dataPembelian[i][1] == valueTipe && dataPembelian[i][2] == valueWarna && dataPembelian[i][3] == valueMemori && dataPembelian[i][4] == valueHarga) {
							dataPembelian[i][5] = valueJumlah;
							cek = true;
						}
					}

					if (!cek) {
						dataPembelian.push(data);
					}

				}else{
					dataPembelian.push(data);
				}

				showPembelian();

				$('#submitpembelian2').prop('disabled', false);
				$('.table-pembelian')[0].classList.remove('none');
			}
		});

		$('.table-pembelian').on('click', function(e){
			if (e.target.className == 'dell-allData') {
				const index = parseInt(e.target.parentElement.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.previousSibling.innerText);

				dataPembelian.splice(index-1, 1);
				showPembelian();

				if(dataPembelian.length == 0){
					$('.table-pembelian')[0].classList.add('none');
					$('#submitpembelian2').prop('disabled', true);
				};
				e.preventDefault();
			}
		})
	});

	$('.laporan').ready(function(){
		
		$('#tglawal').datepicker({
			dateFormat: "dd-mm-yy"
		});

		$('#tglakhir').datepicker({
			dateFormat: "dd-mm-yy"
		});

		if ($('#bulan-ini').hasClass('select')) {
			$.get('ajax/laporanbutton.php?cek='+$('#laporan').val()+'&button=bulan-ini', function(data){
				$('div.laporan div.hasil-laporan').html(data);
			})
		}

		$('#laporan').on('change', function(){
			if ($('#hari-ini').hasClass('select')) {
				$.get('ajax/laporanbutton.php?cek='+$('#laporan').val()+'&button=hari-ini', function(data){
					$('div.laporan div.hasil-laporan').html(data);
				})
			}else if($('#bulan-ini').hasClass('select')){
				$.get('ajax/laporanbutton.php?cek='+$('#laporan').val()+'&button=bulan-ini', function(data){
					$('div.laporan div.hasil-laporan').html(data);
				})
			}else if($('#tahun-ini').hasClass('select')){
				$.get('ajax/laporanbutton.php?cek='+$('#laporan').val()+'&button=tahun-ini', function(data){
					$('div.laporan div.hasil-laporan').html(data);
				})
			}else if($('#tglawal').val()){
				let tanggalAwal = $('#tglawal').val();
				tanggalAwal = tanggalAwal.split('-');
				tanggalAwal = tanggalAwal[2]+'-'+tanggalAwal[1]+'-'+tanggalAwal[0];
				let tanggalAkhir = $('#tglakhir').val();

				if (tanggalAwal.length == 10 && tanggalAkhir == '') {
					$.get('ajax/laporanbutton.php?cek='+$('#laporan').val()+'&awal='+tanggalAwal, function(data){
						$('div.laporan div.hasil-laporan').html(data);
						$('#hari-ini').removeClass('select');
						$('#bulan-ini').removeClass('select');
						$('#tahun-ini').removeClass('select');
					})
				}else if(tanggalAwal.length == 10 && tanggalAkhir.length == 10){
					$.get('ajax/laporanbutton.php?cek='+$('#laporan').val()+'&awal='+tanggalAwal+'&akhir='+tanggalAkhir, function(data){
						$('div.laporan div.hasil-laporan').html(data);
						$('#hari-ini').removeClass('select');
						$('#bulan-ini').removeClass('select');
						$('#tahun-ini').removeClass('select');
					})
				}
			}
		});

		$('#hari-ini').on('click', function(){	
			$.get('ajax/laporanbutton.php?cek='+$('#laporan').val()+'&button='+$(this).attr('id'), function(data){
				$('div.laporan div.hasil-laporan').html(data);
				$('#hari-ini').addClass('select');
				$('#bulan-ini').removeClass('select');
				$('#tahun-ini').removeClass('select');
				$('#tglawal').val('');
				$('#tglakhir').val('');
			})
		});

		$('#bulan-ini').on('click', function(){
			$.get('ajax/laporanbutton.php?cek='+$('#laporan').val()+'&button='+$(this).attr('id'), function(data){
				$('div.laporan div.hasil-laporan').html(data);
				$('#hari-ini').removeClass('select');
				$('#bulan-ini').addClass('select');
				$('#tahun-ini').removeClass('select');
				$('#tglawal').val('');
				$('#tglakhir').val('');
			})
		});

		$('#tahun-ini').on('click', function(){
			$.get('ajax/laporanbutton.php?cek='+$('#laporan').val()+'&button='+$(this).attr('id'), function(data){
				$('div.laporan div.hasil-laporan').html(data);
				$('#hari-ini').removeClass('select');
				$('#bulan-ini').removeClass('select');
				$('#tahun-ini').addClass('select');
				$('#tglawal').val('');
				$('#tglakhir').val('');
			})
		});

		$('#tglawal').on('change', function(){

			let tanggalAwal = $(this).val();
			tanggalAwal = tanggalAwal.split('-');
			tanggalAwal = tanggalAwal[2]+'-'+tanggalAwal[1]+'-'+tanggalAwal[0];
			let tanggalAkhir = $('#tglakhir').val();

			if (tanggalAwal.length == 10 && tanggalAkhir == '') {
				$.get('ajax/laporanbutton.php?cek='+$('#laporan').val()+'&awal='+tanggalAwal, function(data){
					$('div.laporan div.hasil-laporan').html(data);
					$('#hari-ini').removeClass('select');
					$('#bulan-ini').removeClass('select');
					$('#tahun-ini').removeClass('select');
				})
			}else if(tanggalAwal.length == 10 && tanggalAkhir.length == 10){
				$.get('ajax/laporanbutton.php?cek='+$('#laporan').val()+'&awal='+tanggalAwal+'&akhir='+tanggalAkhir, function(data){
					$('div.laporan div.hasil-laporan').html(data);
					$('#hari-ini').removeClass('select');
					$('#bulan-ini').removeClass('select');
					$('#tahun-ini').removeClass('select');
				})
			}
		});

		$('#tglakhir').on('change', function(){

			let tanggalAwal = $('#tglawal').val();
			tanggalAwal = tanggalAwal.split('-');
			tanggalAwal = tanggalAwal[2]+'-'+tanggalAwal[1]+'-'+tanggalAwal[0];
			let tanggalAkhir = $(this).val();
			tanggalAkhir = tanggalAkhir.split('-');
			tanggalAkhir = tanggalAkhir[2]+'-'+tanggalAkhir[1]+'-'+tanggalAkhir[0];

			if (tanggalAwal.length == 10 && tanggalAkhir.length == 10 && tanggalAwal < tanggalAkhir) {
				$.get('ajax/laporanbutton.php?cek='+$('#laporan').val()+'&awal='+tanggalAwal+'&akhir='+tanggalAkhir, function(data){
					$('div.laporan div.hasil-laporan').html(data);
					$('#hari-ini').removeClass('select');
					$('#bulan-ini').removeClass('select');
					$('#tahun-ini').removeClass('select');
				})
			}
		});

		$('#rst').on('click', function(){
			$('#tglawal').val('');
			$('#tglakhir').val('');
			$.get('ajax/laporanbutton.php?cek='+$('#laporan').val()+'&button=bulan-ini', function(data){
				$('div.laporan div.hasil-laporan').html(data);
				$('#hari-ini').removeClass('select');
				$('#bulan-ini').addClass('select');
				$('#tahun-ini').removeClass('select');
			})
		});

		$('#cetakPdf').on('click', function(){
			let tab;
			if ($('#hari-ini').hasClass('select')) {
				tab = window.open('print.php?cek='+$('#laporan').val()+'&button=hari-ini', '_blank');
			}else if($('#bulan-ini').hasClass('select')){
				tab = window.open('print.php?cek='+$('#laporan').val()+'&button=bulan-ini', '_blank');
			}else if($('#tahun-ini').hasClass('select')){
				tab = window.open('print.php?cek='+$('#laporan').val()+'&button=tahun-ini', '_blank');
			}else if($('#tglawal').val()){
				let tanggalAwal = $('#tglawal').val();
				tanggalAwal = tanggalAwal.split('-');
				tanggalAwal = tanggalAwal[2]+'-'+tanggalAwal[1]+'-'+tanggalAwal[0];
				let tanggalAkhir = $('#tglakhir').val();
				if (tanggalAwal.length == 10 && tanggalAkhir == '') {
					tab = window.open('print.php?cek='+$('#laporan').val()+'&awal='+tanggalAwal, '_blank');
				}else if(tanggalAwal.length == 10 && tanggalAkhir.length == 10){
					tab = window.open('print.php?cek='+$('#laporan').val()+'&awal='+tanggalAwal+'&akhir='+tanggalAkhir, '_blank');
				}
			}
			tab.focus();
			// tab.close();
		});
	});

	$('.registrasi-karyawan').ready(function(){
		
		$('#username').on('keyup', function(){
			if (this.value.length > 4) {
				this.classList.add('green');
				this.classList.remove('red');
			}else{
				this.classList.add('red');
				this.classList.remove('green');
			}
		});

		$('#password').on('keyup', function(){
			if (this.value.length > 7) {
				this.classList.add('green');
				this.classList.remove('red');
				if ($('#repassword').val() != '' && $('#repassword').val() == this.value) {
					this.classList.add('green');
					this.classList.remove('red');
					$('#repassword').addClass('green');	
					$('#repassword').removeClass('red');	
				}else if($('#repassword').val() == ''){
					$(this).addClass('green');	
					$(this).removeClass('red');
				}else{
					$('#repassword').addClass('red');	
					$('#repassword').removeClass('green');
				}
			}else{
				this.classList.add('red');
				this.classList.remove('green');
			}
		});


		$('#repassword').on('keyup', function(){
			if (this.value.length > 7) {
				if ($('#password').val() != '' && $('#password').val() == this.value) {
					this.classList.add('green');
					this.classList.remove('red');
					$('#password').addClass('green');	
					$('#password').removeClass('red');	
				}else if($('#password').val() == ''){
					$(this).addClass('green');	
					$(this).removeClass('red');
				}else{
					this.classList.add('red');
					this.classList.remove('green');
				}				
			}else{
				this.classList.add('red');
				this.classList.remove('green');
			}
		});

		let data = "ajax/cari_username.php";
		$('#username_ubah').autocomplete({
			source : data
		});


		$('#password_ubah').on('keyup', function(){
			if (this.value.length > 7) {
				this.classList.add('green');
				this.classList.remove('red');
				if ($('#repassword_ubah').val() != '' && $('#repassword_ubah').val() == this.value) {
					this.classList.add('green');
					this.classList.remove('red');
					$('#repassword_ubah').addClass('green');	
					$('#repassword_ubah').removeClass('red');	
				}else if($('#repassword_ubah').val() == ''){
					$(this).addClass('green');	
					$(this).removeClass('red');
				}else{
					$('#repassword_ubah').addClass('red');	
					$('#repassword_ubah').removeClass('green');
				}
			}else{
				this.classList.add('red');
				this.classList.remove('green');
			}
		});

		$('#repassword_ubah').on('keyup', function(){
			if (this.value.length > 7) {
				if ($('#password_ubah').val() != '' && $('#password_ubah').val() == this.value) {
					this.classList.add('green');
					this.classList.remove('red');
					$('#password_ubah').addClass('green');	
					$('#password_ubah').removeClass('red');	
				}else if($('#password_ubah').val() == ''){
					$(this).addClass('green');	
					$(this).removeClass('red');
				}else{
					this.classList.add('red');
					this.classList.remove('green');
				}				
			}else{
				this.classList.add('red');
				this.classList.remove('green');
			}
		});
	});

	$('.data-kariawan').ready(function(){
		$('.hasil-data').on('click', function(e){
			if (e.target.className == 'delete') {
				let index = $(e.target.parentElement).attr('index');
				let username = $(e.target).attr('id');
				let status = $(`div[index = ${index}]`).find('span')[1].innerText;
				if (status == 'Administrator' && username == 'labbaika') {
					alert('Anda tidak bisa menghapus Administrator!');
				}else{
					let cek = confirm('Yakin ingin menghapus?')
					if (cek) {
						$.ajax({
							url: 'ajax/delete_user.php',
							type: 'POST',
							data: {'username': username},
							typeData: 'json'
						}).done(function(data){
							let json = data;
							if (json === 'true') {
								alert('User berhasil diHapus!');
								$(`div[index = '${index}']`).remove();
							}else{
								alert('Data gagal di hapus!, mungkin masih dalam penggunaan')
							}
						});
					}
				}
			}
		});
	});

	$('.update-password').ready(function(){
		$('#password_baru').on('keyup', function(){
			if (this.value.length > 7) {
				this.classList.add('green');
				this.classList.remove('red');
				if ($('#repassword_baru').val() != '' && $('#repassword_baru').val() == this.value) {
					this.classList.add('green');
					this.classList.remove('red');
					$('#repassword_baru').addClass('green');	
					$('#repassword_baru').removeClass('red');	
				}else if($('#repassword_baru').val() == ''){
					$(this).addClass('green');	
					$(this).removeClass('red');
				}else{
					$('#repassword_baru').addClass('red');	
					$('#repassword_baru').removeClass('green');
				}
			}else{
				this.classList.add('red');
				this.classList.remove('green');
			}
		});

		$('#repassword_baru').on('keyup', function(){
			if (this.value.length > 7) {
				if ($('#password_baru').val() != '' && $('#password_baru').val() == this.value) {
					this.classList.add('green');
					this.classList.remove('red');
					$('#password_baru').addClass('green');	
					$('#password_baru').removeClass('red');	
				}else if($('#password_baru').val() == ''){
					$(this).addClass('green');	
					$(this).removeClass('red');
				}else{
					this.classList.add('red');
					this.classList.remove('green');
				}				
			}else{
				this.classList.add('red');
				this.classList.remove('green');
			}
		});
	});
});