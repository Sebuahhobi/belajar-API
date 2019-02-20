
<?php
date_default_timezone_set('Asia/jakarta');
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, "https://api.banghasan.com/sholat/format/json/kota");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);

$response = curl_exec($ch);
curl_close($ch);

//var_dump($response);
?>
<!DOCTYPE html>
<html>
<head>
	<title>jadwal Shalat API</title>
	<script type="text/javascript" src="jquery.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script type="text/javascript">
		var request = new XMLHttpRequest();

		request.open('GET', 'https://api.banghasan.com/sholat/format/json/kota');

		request.onreadystatechange = function () {
			 if (this.readyState === 4) {
			  	var hasil=JSON.parse(this.responseText);

			    //console.log('Tes:',hasil.kota[0].id,hasil.kota[1].nama );
			    //console.log('Status:', this.status);
			    //console.log('Headers:', this.getAllResponseHeaders());
			    //console.log('Body:', this.responseText);
			    $(document).ready(function(){
			    	//jumlah array in object 510
			    	hasil.kota.forEach(function(obj) {
						$('#kuto').append('<option value="' + obj.id + '">' + obj.nama + '</option>');
					})
			    });
			 }
		};

		request.send();
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
			var mintak = new XMLHttpRequest();
	                var tgl='<?php echo date("Y-m-d");?>';
	                var value=512; //aceh barat => urutan 1
					mintak.open('GET', 'https://api.banghasan.com/sholat/format/json/jadwal/kota/'+value+'/tanggal/'+tgl);

					mintak.onreadystatechange = function () {
						if (this.readyState === 4) {
							var jws1=JSON.parse(this.responseText);
							$('#tanggal').html(jws1.jadwal.data.tanggal);
							$('#terbit').html(jws1.jadwal.data.terbit);
							$('#dhuha').html(jws1.jadwal.data.dhuha);
							$('#imsak').html(jws1.jadwal.data.imsak);
							$('#maghrib').html(jws1.jadwal.data.maghrib);
							$('#isya').html(jws1.jadwal.data.isya);
							$('#subuh').html(jws1.jadwal.data.subuh);
							$('#zhuhur').html(jws1.jadwal.data.dzuhur);
							$('#ashar').html(jws1.jadwal.data.ashar);
						}
					};

					mintak.send();

	        $("#kuto").change(function(){
	            value=$(this).val();
	            if(value>0){

					mintak.open('GET', 'https://api.banghasan.com/sholat/format/json/jadwal/kota/'+value+'/tanggal/'+tgl);
					mintak.onreadystatechange = function () {
						if (this.readyState === 4) {
							var jws=JSON.parse(this.responseText);
							$('#tanggal').html(jws.jadwal.data.tanggal);
							$('#terbit').html(jws.jadwal.data.terbit);
							$('#dhuha').html(jws.jadwal.data.dhuha);
							$('#imsak').html(jws.jadwal.data.imsak);
							$('#maghrib').html(jws.jadwal.data.maghrib);
							$('#isya').html(jws.jadwal.data.isya);
							$('#subuh').html(jws.jadwal.data.subuh);
							$('#zhuhur').html(jws.jadwal.data.dzuhur);
							$('#ashar').html(jws.jadwal.data.ashar);
						}
					};

					mintak.send();
	            }
	        });
	    });
	</script>
</head>
<body>
	<select id="kuto"></select></br></br></br>
	<table border="1">
		<thead>
			<tr>
				<th>Tanggal</th>
				<th>Terbit</th>
				<th>Dhuha</th>
				<th>Imsak</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td id='tanggal'></td>
				<td id='terbit'></td>
				<td id='dhuha'></td>
				<td id='imsak'></td>
			</tr>
		</tbody>
	</table><br>
	<table border="2">
		<thead>
			<tr>
				<th>Magrib</th>
				<th>Isya'</th>
				<th>Subuh</th>
				<th>Zhuhur</th>
				<th>Ashar</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td id='maghrib'></td>
				<td id='isya'></td>
				<td id='subuh'></td>
				<td id='zhuhur'></td>
				<td id='ashar'></td>
			</tr>
		</tbody>
	</table>
</body>
</html>