@extends('supervisors.dashboard_admin')
@section('content')
<div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <div class="table-responsive">
				<h4>Data Supervisor</h4>
				
			</div>
			<div class="card-body">
				@if (session('sukses'))
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">×</button>
					{{ session('sukses') }}
				</div>
				@elseif(session('gagal'))
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">×</button>
					{{ session('gagal') }}
				</div>
				@endif

				@if (count($errors) > 0)
				<div class="alert alert-warning">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				<table class="table table-bordered table-sm table-hover  text-center">
                            <tr class="bg-info text-white">
					<thead>
						<tr>
                        <th>No</th>
                        <th>No. Dokumen	</th>
                            <th>Pemberi sampel</th>
                            <th>Parameter Pengujian</th>	
                            <th>Tanggal terima sampel	</th>
                            <th>Jumlah sampel	</th>
                            <th>Tanggal uji	</th>
                            <th>Tanggal  selesai uji</th>
                            <th>Sampel</th>
                            <th>Parameter dan Nilai Uji</th>
                            <th>Spesifikasi</th>
                            <th>Keterangan</th>
                            <th>Tanda Tangan Operator</th>
                            <th>Tanda Tangan Staff</th>
                            <th>Tanda Tangan Supervisor</th>
						</tr>
					</thead>
					@foreach($supervisors as $supervisor)
					<tbody>
						<tr>
                            <td>{{ $loop->iteration }}</td>
							<td>{{ $supervisor-> document_no}}</td>
                            <td>{{ $supervisor-> sampler}}</td>
                            <td>{{ $supervisor-> testing_parameter}}</td>
                            <td>{{ $supervisor-> recieved_date}}</td>
                            <td>{{ $supervisor-> sample_count}}</td>
                            <td>{{ $supervisor-> test_start_date}}</td>
                            <td>{{ $supervisor-> test_end_date}}</td>
                            <td>{{ $supervisor-> sample_no}}</td>
                            <td>
								@foreach($supervisor->parameter_and_values as $param => $values)
									<div>
										<p class="mb-0">{{$param}}</p>
										<ul>
											@foreach($values as $testValue)
											<li>{{$testValue}}</li>
											@endforeach
										</ul>
									</div>
								@endforeach
</td>
                            <td>{{ $supervisor-> specification}}</td>
                            <td>{{ $supervisor-> note}}</td>
							<td>{!! QrCode::format('svg')->size(100)->generate($supervisor->ttd_operator); !!}</td>
							<td>{!! QrCode::format('svg')->size(100)->generate($supervisor->ttd_staff); !!}</td>
							@if (isset($supervisor->ttd_supervisor))
                            <td>{!! QrCode::format('svg')->size(100)->generate($supervisor->ttd_supervisor); !!}</td> 
                            @else
							<td> <a href="{{URL::to('/ttd_supervisor/'.$supervisor->id) }}" class="btn btn-warning">TTD</a></td>
                            @endif
</form>
						</tr>
					</tbody>
					@endforeach
				</table>
			</div>
		</div>
	</div>
</div>


@endsection