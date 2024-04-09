<x-app-layout>
	<x-slot name="title">
		@role('Rekam Medis')
		Laporan
		@endrole
		Hasil Diagnosa Tuberkulosis
	</x-slot>

	@if(session()->has('success'))
	<x-alert type="success" message="{{ session()->get('success') }}" />
	@endif
	<x-card title="Berikut hasil diagnosa penyakit">
	
		<ul>
			<li>Nama : {{ $riwayat->nama }}</li>
			<li>Tanggal Diagnosa : {{ $riwayat->created_at->format('d M Y, H:m:s') }}</li>
			{{-- <li>Suhu Tubuh : {{ $riwayat->suhu_tubuh }}°C</li>
			<li>Tensi Darah : {{ $riwayat->tensi_darah }}</li> --}}
		</ul>
	
		<div class="table-responsive">
			<table class="table table-hover border">
				<thead class="thead-light">
					<tr>
						<th>Gejala Tuberkulosis</th>
						<th>Nilai jawaban</th>
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
		</div>
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
	<div class="mt-3 text-center">
		<a href="{{ asset("storage/downloads/$riwayat->file_pdf") }}" target="_blank" class="btn btn-primary mr-1"><i class="fas fa-print mr-1"></i> Print</a>
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
	<div class="mt-3 text-center">
		<a href="{{ asset("storage/downloads/$riwayat->file_pdf") }}" target="_blank" class="btn btn-primary mr-1"><i class="fas fa-print mr-1"></i> Print</a>
	</div>
	@endif
			
	</x-card>
</x-app-layout>