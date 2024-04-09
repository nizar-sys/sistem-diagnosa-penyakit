<x-app-layout>
	<x-slot name="title">
		@role('Rekam Medis') 
		Laporan
		@endrole
		Riwayat Diagnosa
		@role('Perawat') 
		Tuberkulosis
		{{-- {{ auth()->user()->name }} --}}
		@endrole

	</x-slot>

	@if(session()->has('success'))
	<x-alert type="success" message="{{ session()->get('success') }}" />
	@endif
	<x-card>
		<form action="#" method="GET" class="table-responsive">
			<div class="input-group flex-nowrap mb-3">
				<span class="input-group-text" id="addon-wrapping">Min Date</span>
				<input type="date" class="form-control" name="start_date">
				<span class="input-group-text" id="addon-wrapping">Max Date</span>
				<input type="date" class="form-control" name="end_date"><br>
				<a href="{{ route('admin.riwayat.daftar') }}" class="btn btn-danger ml-1">reset</a>
				<button class="btn btn-primary ml-1" type="submit">cari</button>
			</div>
			<hr>
		</form>
		<div class="table-responsive">
			<table class="table table-hover border" id="table-data">
			<thead>
				<th>No</th>
				@role('Rekam Medis')
				<th>Username</th>
				<th>Nama</th>
				@endrole
				<th>Hasil Diagnosa Penyakit TB</th>
				<th>Tanggal Diagnosa</th>
				<th>Aksi</th>
			</thead>
			<tbody>
				@forelse($riwayat as $row)
				<tr>
					<td>{{ $riwayat->count() * ($riwayat->currentPage() - 1) + $loop->iteration }}</td>
					@role('Rekam Medis')
					<td>{{ $row->username }}</td>
					<td>{{ $row->nama }}</td>
					@endrole
					<td><b>(<span class="text-center">{{ number_format(unserialize($row->cf_max)[0] * 100, 2) }}%</span>)</b></td>
					<td>{{ $row->created_at->format('d M Y, H:m:s') }}</td>
					<td>
                        <a href="{{ asset("storage/downloads/$row->file_pdf") }}" target="_blank" class="btn btn-primary btn-sm mb-1">print</a>
						<a href="{{ route('admin.riwayat', $row->id) }}" class="btn btn-info btn-sm mb-1">lihat</a> <br>
                        @role('Rekam Medis')
						{{-- <a href="{{ route('admin.riwayat.edit', $row->id) }}" class="btn btn-success btn-sm mb-1">edit</a> --}}
                        <form action="{{ route('admin.riwayat.destroy', $row->id) }}" method="post" class="d-none" id="form-delete-{{ $row->id }}">
                            @csrf
                            @method('delete')
                        </form>
                        <button type="button" class="btn btn-danger btn-sm" onclick="deleteData('{{ $row->id }}')">hapus</button>
                        @endrole

					</td>
				</tr>
				@empty
				<tr>
					<td colspan="5" class="text-center">No Data</td>
				</tr>
				@endforelse
			</tbody>
		</table>
		<div class="mt-3">
			{{ $riwayat->links() }}
		</div>
		</div>
	</x-card>

	<x-slot name="script">
        <script>
            function deleteData(id) {
                if(confirm('Yakin hapus data?')){
                    $('#form-delete-'+id).submit();
                }
            }

            $(document).ready(function() {
                var tablePengguna = $('#table-data').DataTable({
                    language: {
                        search: "_INPUT_",
                        searchPlaceholder: "Cari Data",
                        lengthMenu: "Menampilkan _MENU_ data",
                        zeroRecords: "Data tidak ditemukan",
                        infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
                        infoFiltered: "(disaring dari _MAX_ data)",
                        paginate: {
							previous: '<i class="fa fa-angle-left"></i>',
                            next: "<i class='fa fa-angle-right'></i>",
                        }
						// searchDelay: 200
                    },
                    dom: 'lfrtip',
                });
            });
        </script>
    </x-slot>
</x-app-layout>
