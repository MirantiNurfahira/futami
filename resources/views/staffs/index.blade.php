@extends('staffs.dashboard_admin')
@section('content')
<div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <div class="table-responsive">
				<h4>Data Staff</h4>
				
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
                        <th>No. Dokumen</th>
                            <th>Pemberi sampel</th>
                            <th>Parameter Pengujian	</th>
                            <th width="280px">Tanggal terima sampel</th>	
                            <th>Jumlah sampel</th>	
                            <th width="280px">Tanggal uji	</th>
                            <th width="280px">Tanggal  selesai uji</th>
                            <th>Sampel</th>
                            <th width="280px">Parameter dan Nilai Uji</th>
                            <th>Spesifikasi</th>
                            <th>Keterangan</th>
                            <th>Tanda Tangan Operator</th>
                            <th>Tanda Tangan Staff</th>
							
						</tr>
					</thead>
					@foreach($staffs as $key => $staff)
					<tbody>
						<tr>
                            <td>{{ $loop->iteration }}</td>
							<td>{{ $staff-> document_no}}</td>
                            <td>{{ $staff-> sampler}}</td>
                            <td>{{ $staff-> testing_parameter}}</td>
                            <td>{{ $staff-> recieved_date}}</td>
                            <td>{{ $staff-> sample_count}}</td>
                            <td>{{ $staff-> test_start_date}}</td>
                            <td>{{ $staff-> test_end_date}}</td>
                            <td>{{ $staff-> sample_no}}</td>
                            <td>
								@foreach($staff->parameter_and_values as $param => $values)
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
                            <td>{{ $staff-> specification}}</td>
                            <td>{{ $staff-> note}}</td>
                            <td>{!! QrCode::format('svg')->size(100)->generate($staff->ttd_operator); !!}</td>
							@if (isset($staff->ttd_staff))
                            <td>{!! QrCode::format('svg')->size(100)->generate($staff->ttd_staff); !!}</td> 
                            @else
							<td> 
								<a href="{{URL::to('/ttd_staff/'.$staff->id) }}" class="btn btn-warning">TTD</a>
								<a href="{{URL::to('/decline/'.$staff->id) }}" class="btn btn-danger">Decline</a>
							</td>
                            @endif
							 
						</tr>
					</tbody>
					@endforeach
				</table>
			</div>
		</div>
	</div>
</div>


@endsection