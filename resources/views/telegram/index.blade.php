@extends ('app')

<div class="box">
	<div class="box-body">
		<div class="row">			
			<div class="col-md-12">
				<span id="description"><h1>Test Untuk Telegram Isi Pulsa</h1></span>
			</div>	
		</div>
		<br>
		<div class="row">			
			<div class="col-md-12">
				<div>
				  	Bot Token:
				</div>
				<div class="input-group" style="width:80%;">
				  	<span class="input-group-btn"><input type="text" id="botToken" class="form-control" style="width:400px;"/></span>
				</div>
				<span id="token_desc"><i><small>Masukkan token Bot Telegram</small></i></span>
			</div>	
		</div>
		<br>
		<div class="row">			
			<div class="col-md-12">
				<div>
				  	ID Tujuan:
				</div>
				<div class="input-group" style="width:80%;">
				  	<span class="input-group-btn"><input type="text" id="idTujuan" class="form-control" style="width:400px;"/></span>
				</div>
				<span id="token_desc"><i><small>Masukkan id dari username tujuan yang ada pada Telegram. (Bukan username). misal: '1211342342342'</small></i></span>
			</div>	
		</div>
		<br>
		<div class="row">			
			<div class="col-md-12">
				<div>
				  	No HP:
				</div>
				<div class="input-group" style="width:80%;">
				  	<span class="input-group-btn"><input type="text" id="noHp" class="form-control" style="width:200px;"/></span>
				</div>
				<span id="nohp_desc"><i><small>Masukkan no HP yang ingin diisi pulsa</small></i></span>
			</div>	
		</div>	
		<br>
		<div class="row">			
			<div class="col-md-12">
				<div>
				  	Pulsa:
				</div>
				<div class="input-group" style="width:80%;">
				  	<span class="input-group-btn">
						<select class="form-control" style="width:200px;" id="pulsa">
							<option value="1000">1.000</option>
							<option value="5000">5.000</option>
							<option value="10000">10.000</option>
							<option value="25000">25.000</option>
							<option value="50000">50.000</option>
							<option value="100000">100.000</option>
						</select>
					</span>
				</div>
				<span id="nohp_desc"><i><small>Pilih pulsa berapa yang ingin diisi</small></i></span>
			</div>	
		</div>	
		<br>
		<div class="row">			
			<div class="col-md-12">
				<div class="input-group" style="width:80%;">
				  	<span class="input-group-btn">
						<button id="kirim" class="btn btn-success" onclick="Kirim()">Kirim</button>
					</span>
				</div>
				<span id="nohp_desc"><i><small>Tombol untuk mengirim pesan</small></i></span>
			</div>				
		</div>
		<br>
		<div class="row">			
			<div class="col-md-12">
				<div class="input-group" style="width:80%;">
				  	<span class="input-group-btn">
						<button id="checkMsg" class="btn btn-success" onclick="CheckMsg()">Cek pesan di bot anda</button>
					</span>
				</div>
				<span id="msg_desc"><i><small>Tombol untuk mengecek pesan baru di bot anda. (Dapat melihat ID pengirim - ID ini dapat dicopy-paste di field 'ID Tujuan' di atas untuk mengirim pesan kembali)</small></i></span>
			</div>				
		</div>	
	</div>
</div>
<br>
<div class="box">
	<div class="box-body">
		<div class="row">			
			<div class="col-md-12">
				<b>Hasil (JSON)</b>
			</div>
			<div class="col-md-12" id="result">
			</div>				
		</div>
	</div>
</div>

@section ('javascript_per_page')
<script type="text/javascript">	

function Kirim()
{
	$.ajax({
		  url: '{{ url("telegram/kirim") }}', 
		  beforeSend: function(){			
			$('#result').html('<small>Loading....</small>');
		  },
		  type:'GET',
		  headers: { 'Content-Type':'application/json' },
		  dataType: 'json',
		  data:{
			'_token':'{{ csrf_token() }}',
			'botToken': $('#botToken').val(),
			'idTujuan': $('#idTujuan').val(),
			'noHp': $('#noHp').val(),
			'pulsa': $('#pulsa').val()
		  },
		  success: function (res) {	
			$('#result').html('<pre>' + JSON.stringify(res, null, 2) + '</pre>');  
		  },
		  error: function(a, b, c){
			$('#result').html('<pre>' + JSON.stringify(a, null, 2) + '</pre>');
		  }
		});
}

function CheckMsg()
{
	$.ajax({
		  url: '{{ url("telegram/checkmsg") }}', 
		  beforeSend: function(){			
			$('#result').html('<small>Loading....</small>');
		  },
		  type:'GET',
		  headers: { 'Content-Type':'application/json' },
		  dataType: 'json',
		  data:{
			'_token':'{{ csrf_token() }}',
			'botToken': $('#botToken').val()
		  },
		  success: function (res) {	
			$('#result').html('<pre>' + JSON.stringify(res, null, 2) + '</pre>');  
		  },
		  error: function(a, b, c){
			$('#result').html('<pre>' + JSON.stringify(a, null, 2) + '</pre>');
		  }
		});
}

</script>
@endsection