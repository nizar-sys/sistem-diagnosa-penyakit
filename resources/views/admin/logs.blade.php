<x-app-layout>
	<x-slot name="title">Log Aktivitas</x-slot>

	@if(session()->has('success'))
	<x-alert type="danger" message="{{ session()->get('success') }}" />
	@endif

	<x-card>
		<x-slot name="title">Semua Log Aktivitas</x-slot>
		<x-slot name="option">
			<form action="{{ route('admin.logs.delete') }}" method="post">
				@csrf
				<button type="submit" class="btn btn-danger">Delete 7 days ago</button>
			</form>
		</x-slot>

		<div class="table-responsive">
			<table class="table table-bordered mb-3">
				<thead>
					<th>Deskripsi</th>
					<th>Properti</th>
					<th>Tanggal</th>
				</thead>
				<tbody>
					@forelse($logs as $log)
					<tr>
						<td>{{ $log->description }}</td>
						<td>
							@if(!empty($log->properties))
								@if(!empty($log->properties['attributes']))
									@foreach($log->properties["attributes"] as $key => $value)
									<ul>
										<li><b>{{ $key }}</b>: {{ $value }}</li>
									</ul>
									@endforeach
								@else
								@foreach($log->properties as $key => $value)
									<ul>
										@if(!empty($value))
										<li><b>{{ $key }}</b>: {{ $value }}</li>
										@endif
									</ul>
									@endforeach
								@endif
							@else
							<td class="text-center">kosong</td>
							@endif
						</td>
						<td>{{ $log->created_at->format('d-M-Y H:m:s') }}</td>
					</tr>
					@empty
					<tr>
						<td colspan="3" class="text-center">tidak ada aktivitas</td>
					</tr>
					@endforelse
				</tbody>
			</table>
		</div>
		{{ $logs->links() }}
	</x-card>
</x-app-layout>