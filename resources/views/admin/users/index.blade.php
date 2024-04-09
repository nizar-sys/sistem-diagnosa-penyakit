<x-app-layout>
	<x-slot name="title">Daftar User</x-slot>
	{{-- @dd($roles) --}}

	@if(session()->has('success'))
	<x-alert type="success" message="{{ session()->get('success') }}" />
	@endif
	<x-card>
		<x-slot name="title">Daftar User</x-slot>
		<x-slot name="option">
			<a href="{{ route('admin.member.create') }}" class="btn btn-success">
				tambah user 
			</a>
		</x-slot>
		<div class="table-responsive">
			<table class="table table-bordered" id="table-data">
				<thead>
					<th>Nama</th>
					<th>Username</th>
					<th>Alamat</th>
					<th>No Handphone</th>
					<th class="text-center">Aksi</th>
				</thead>
				<tbody>
					@forelse($users as $user)
					<tr>
						<td>{{ $user->name }}</td>
						<td>{{ $user->username }}</td>
						<td>{{ $user->alamat }}</td>
						<td>{{ $user->no_hp }}</td>
						<td class="text-center">
							<button type="button" class="btn btn-info mr-1 mb-1 info"
							data-name="{{ $user->name }}" 
							data-no_hp="{{ $user->no_hp }}" 
							data-alamat="{{ $user->alamat }}" 
							data-jenis_kelamin="{{ $user->jenis_kelamin }}" 
							data-umur="{{ $user->umur }}" 
							data-username="{{ $user->username }}" 
							data-roles="{{ $user->getRoleNames() }}" 
							data-created="{{ $user->created_at->format('d-M-Y H:m:s') }}">
								lihat
							</button>
							<a href="{{ route('admin.member.edit', $user->id) }}" class="btn btn-primary mr-1 mb-1">edit</a> 
							<form action="{{ route('admin.member.delete', $user->id) }}" style="display: inline-block;" method="POST">
								@csrf
								<button type="button" class="btn btn-danger delete">hapus</button>
							</form>
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="3" class="text-center">tidak ada</td>
					</tr>
					@endforelse
				</tbody>
			</table>
		</div>
		<div class="mt-3">
			{{-- {{ $users->links() }} --}}
		</div>
	</x-card>

	<x-modal>
		<x-slot name="id">infoModal</x-slot>
		<x-slot name="title">Informasi User</x-slot>

		<div class="row mb-2">
			<div class="col-6">
				<b>Nama</b>
			</div>
			<div class="col-6" id="name-modal"></div>
		</div>
		<div class="row mb-2">
			<div class="col-6">
				<b>Username</b>
			</div>
			<div class="col-6" id="username-modal"></div>
		</div>
		<div class="row mb-2">
			<div class="col-6">
				<b>Tanggal Daftar</b>
			</div>
			<div class="col-6" id="created-modal"></div>
		</div>
		<div class="row mb-2">
			<div class="col-6">
				<b>no_hp</b>
			</div>
			<div class="col-6" id="no_hp-modal"></div>
		</div>
		<div class="row mb-2">
			<div class="col-6">
				<b>alamat</b>
			</div>
			<div class="col-6" id="alamat-modal"></div>
		</div>
		<div class="row mb-2">
			<div class="col-6">
				<b>jenis_kelamin</b>
			</div>
			<div class="col-6" id="jenis_kelamin-modal"></div>
		</div>
		<div class="row mb-2">
			<div class="col-6">
				<b>umur</b>
			</div>
			<div class="col-6" id="umur-modal"></div>
		</div>
	</x-modal>

	<x-slot name="script">
		<script>
			$('.info').click(function(e) {
				e.preventDefault()

				$('#name-modal').text($(this).data('name'))
				$('#username-modal').text($(this).data('username'))
				$('#roles-modal').text($(this).data('roles'))
				$('#no_hp-modal').text($(this).data('no_hp'))
				$('#alamat-modal').text($(this).data('alamat'))
				$('#jenis_kelamin-modal').text($(this).data('jenis_kelamin'))
				$('#umur-modal').text($(this).data('umur'))
				$('#created-modal').text($(this).data('created'))

				$('#infoModal').modal('show')
			})

			$('.delete').click(function(e){
				e.preventDefault()
				const ok = confirm('Ingin menghapus pasien?')

				if(ok) {
					$(this).parent().submit()
				}
			})

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
                    },
                    dom: 'lfrtip',
                });
            });
		</script>
	</x-slot>

	{{-- <x-slot name="script">
        <script>
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
                    },
                    dom: 'lfrtip',
                });
            });
        </script>
    </x-slot> --}}
</x-app-layout>