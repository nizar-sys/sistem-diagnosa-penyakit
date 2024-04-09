<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hasil Diagnosa Penyakit </title>
    <link href="{{ public_path('dist/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
	@php
	$riwayat = App\Models\Riwayat::find($id);
	@endphp
	<h2 class="text-center mb-5">Hasil Diagnosa</h2>
	<ul>
		<li><b>Nama :</b> {{ $riwayat->nama }}</li>
		<li><b>Tanggal :</b> {{ $riwayat->created_at->format('d M Y, H:m:s A') }}</li>
		{{-- <li><b>Suhu Tubuh :</b> {{ $riwayat->suhu_tubuh }}°C</li>
		<li><b>Tensi :</b> {{ $riwayat->tensi_darah }}</li> --}}
	</ul>
	
	<table class="table table-hover border">
		<thead class="thead-light">
			<tr>
				<th>Gejala Tuberkulosis</th>
				<th>Nilai Jawaban</th>
			</tr>
		</thead>
		<tbody>
			@foreach(unserialize($riwayat->gejala_terpilih) as $gejala)
			<tr>
				<td>{{ $gejala['kode'] }} - {{ $gejala['nama'] }}</td>
				<td>{{ $gejala['keyakinan'] }}</td>
			</tr>
			@endforeach
		</tbody>
	</table>

	@foreach(unserialize($riwayat->hasil_diagnosa) as $diagnosa)
	
	@endforeach

	@php
		$simpul=number_format(unserialize($riwayat->cf_max)[0], 3) * 100;
		$kena = "Mungkin Terindikasi";
		$tidak = "Tidak Terindikasi";
		
	@endphp

	@if ($simpul>80)
	<div class="mt-5">
		<div class="alert alert-danger">
			<h5 class="font-weight-bold">Kesimpulan</h5>
			<p>
				Berdasarkan Dari Gejala Yang Dipilih, Anda {{ $kena }} Penyakit {{ $diagnosa['nama_penyakit'] }}. Karena Hasil Dari Perhitungan Sistem Sebesar<b> {{ number_format(unserialize($riwayat->cf_max)[0], 3) * 100 }}%</b>
			</p>
		</div>
	</div>
	@else
	<div class="mt-5">
		<div class="alert alert-primary">
			<h5 class="font-weight-bold">Kesimpulan</h5>
			<p>
				Berdasarkan Dari Gejala Yang Dipilih, Anda {{ $tidak }} Penyakit {{ $diagnosa['nama_penyakit'] }}. Karena Hasil Dari Perhitungan Sistem Sebesar<b> {{ number_format(unserialize($riwayat->cf_max)[0], 3) * 100 }}%</b> 
			</p>
		</div>
	</div>
	@endif
	
</body>
</html>