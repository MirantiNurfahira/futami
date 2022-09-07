@extends('operators.dashboard_admin')
@section('content')
<div class="section-body">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <div class="table-responsive">
				<h4>Data Operator</h4>
				<button class="btn btn-sm btn-success" data-toggle="modal" data-target="#exampleModal">Add</button>
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
				<table class="table table-bordered table-sm table-hover  text-center" id="tableMy">
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
                            <th>Parameter dan Nilai Uji</th>
                            <th>Spesifikasi</th>
                            <th>Keterangan</th>
                            <th>Tanda Tangan Operator</th>
                        <th>Action</th>
						</tr>
					</thead>
					@foreach($operators as $key => $operator)
					<tbody>
						<tr>
                            <td>{{ $loop->iteration }}</td>
							<td>{{ $operator-> document_no}}</td>
                            <td>{{ $operator-> sampler}}</td>
                            <td>{{ $operator-> testing_parameter}}</td>
                            <td>{{ $operator-> recieved_date}}</td>
                            <td>{{ $operator-> sample_count}}</td>
                            <td>{{ $operator-> test_start_date}}</td>
                            <td>{{ $operator-> test_end_date}}</td>
                            <td>{{ $operator-> sample_no}}</td>
                            <td>
								@foreach($operator->parameter_and_values as $param => $values)
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
                            <td>{{ $operator-> specification}}</td>
                            <td>{{ $operator-> note}}</td>
                            @if (isset($operator->ttd_operator))
                            <td>{!! QrCode::format('svg')->size(100)->generate($operator->ttd_operator); !!}</td> 
                            @else
							<td> <a href="{{URL::to('/ttd_operator/'.$operator->id) }}" class="btn btn-warning">TTD</a></td>
                            @endif
                            <td align="center" class="d-flex">
								<button class="btn btn-primary btn-sm open_modal_management" value="<?= $operator->id?>"><i class="fas fa-pencil-alt"></i></button>
								<form action="{{ route('DeleteProcess',$operator->id) }}"  method="POST">
									@csrf
									@method('delete')
									<button type="submit" class="btn btn-danger btn-sm"  onclick="return confirm('Yakin Data Mau Dihapus??');"><i class="fas fa-trash"></i></button>
								</form>
							</td>
						</tr>
					</tbody>
					@endforeach
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Create Form</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form action="{{ URL::to('/operators/add') }}"  method="POST">
					@csrf
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label>No Dokumen</label>
								<input class="form-control" type="text" name="document_no" id="document_no" required>
							</div>	
							<div class="form-group">
								<label>Pemberi Sampel</label>
								<input class="form-control" type="text" name="sampler" id="sampler" required>
							</div>	
			
							<div class="form-group">
								<label>Parameter Pengujian</label>
								<input class="form-control" type="text" name="testing_parameter" id="testing_parameter" required>
							</div>	
							<div class="form-group">
								<label>Tanggal Terima Sampel</label>
								<input class="form-control" type="date" name="recieved_date" id="recieved_date" required>
							</div>
						
                       
							<div class="form-group">
								<label>Jumlah Sampel</label>
								<input class="form-control" type="text" name="sample_count" id="sample_count" required>
							</div>	
							<div class="form-group">
								<label>Tanggal Uji</label>
								<input class="form-control" type="date" name="test_start_date" id="test_start_date" required>
							</div>
						
                       
							<div class="form-group">
								<label>Tanggal Selesai Uji</label>
								<input class="form-control" type="date" name="test_end_date" id="test_end_date" required>
							</div>	
							<div class="form-group">
								<label>Sampel</label>
								<input class="form-control" type="text" name="sample_no" id="sample_no" required>
							</div>
							<div class="form-group" id="formModal">
									<label>Parameter dan Nilai Uji </label>
									<input type="text" name="parameter_and_values[0][parameter]" placeholder="Enter Parameter" class="form-control" />
									<input type="text" name="parameter_and_values[0][test_values]" placeholder="Enter Nilai Uji" class="form-control" />
									<button type="button" name="add" id="add" class="btn btn-outline-primary">Add</button>
								     
							</div>								
							<div class="form-group">
								<label>Spesifikasi</label>
								<input class="form-control" type="text" name="specification" id="specification" required>
							</div>
                            <div class="form-group">
								<label>Keterangan</label>
								<input class="form-control" type="text" name="note" id="note" required>
							</div>
						
					</div>
						<div class="col-lg-12 col-12">
							<div class="float-right">
								<button type="submit" class="btn btn-sm btn-success">Submit</button>
							</div>	
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal Edit Management -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">Management Form</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
			</div>
			<div class="modal-body">
				<form id="frmProducts" name="frmProducts" novalidate="">
					@csrf
					<input type="hidden" name="" id="id_operators_d">
					<div class="row">
						<div class="col-lg-6">
						<div class="form-group">
								<label>No Dokumen</label>
								<input class="form-control" type="text" name="document_no" id="document_no_d" required>
							</div>	
							<div class="form-group">
								<label>Pemberi Sampel</label>
								<input class="form-control" type="text" name="sampler" id="sampler_d" required>
							</div>	
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>Parameter Pengujian</label>
								<input class="form-control" type="text" name="testing_parameter" id="testing_parameter_d" required>
							</div>	
							<div class="form-group">
								<label>Tanggal Terima Sampel</label>
								<input class="form-control" type="date" name="recieved_date" id="recieved_date_d" required>
							</div>
						</div>
                        <div class="col-lg-6">
							<div class="form-group">
								<label>Jumlah Sampel</label>
								<input class="form-control" type="text" name="sample_count" id="sample_count_d" required>
							</div>	
							<div class="form-group">
								<label>Tanggal Uji</label>
								<input class="form-control" type="date" name="test_start_date" id="test_start_date_d" required>
							</div>
						</div>
                        <div class="col-lg-6">
							<div class="form-group">
								<label>Tanggal Selesai Uji</label>
								<input class="form-control" type="text" name="test_end_date" id="test_end_date_d" required>
							</div>	
							<div class="form-group">
								<label>Sampel</label>
								<input class="form-control" type="text" name="sample" id="sample_no_d" required>
							</div>
						</div>
                        <div class="col-lg-6">
						<tr>
							<div class="form-group" id="edit-parameter-and-values-input">
								<label>Parameter dan Nilai Uji </label>
								
							</div>								
							</tr>	
							<div class="form-group">
								<label>Spesifikasi</label>
								<input class="form-control" type="text" name="specification" id="specification_d" required>
							</div>
                            <div class="form-group">
								<label>Keterangan</label>
								<input class="form-control" type="text" name="note" id="note_d" required>
							</div>
						</div>
					</div>	
						<div class="col-lg-12 col-12">
							<div class="float-right">
								<button type="submit" class="btn btn-sm btn-success" id="btn-update">Update</button>
							</div>	
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('javascript')

<script type="text/javascript">
	$(document).ready(function() {
		var my_url = '{{ env('BASE_URL') }}'

		$(document).on('click', '.open_modal_management', function() {
			var id_operators = $(this).val();
			$.ajax({
				type: 'GET',
				dataType: 'JSON',
				url: my_url + 'operators/edit/' + id_operators,
				success: function(data){
					$('#id_operators_d').val(data.data.id);
					$('#document_no_d').val(data.data.document_no);
					$('#sampler_d').val(data.data.sampler);
					$('#testing_parameter_d').val(data.data.testing_parameter);
					$('#recieved_date_d').val(data.data.recieved_date);
					$('#sample_count_d').val(data.data.sample_count);
					$('#test_start_date_d').val(data.data.test_start_date);
                    $('#test_end_date_d').val(data.data.test_end_date);
                    $('#sample_no_d').val(data.data.sample_no);


					let html = '';
					let index = 0;
					$.each(data.data.parameter_and_values,
					(parameter, test_values) => {
						html += `
						<label class="mt-2 text-bold">Parameter dan Nilai Uji</label>
						<tr><td><input class="parameter_and_values_param form-control" type="text" name="parameter_and_values" value="${parameter}" placeholder="Enter Parameter"/></tr></td>
						<tr><td><input class="parameter_and_values_value form-control" type="text" name="parameter_and_values" value="${test_values[0]}" placeholder="Enter Nilai Uji"/></tr></td>
						`;

						index++;
					})

					$('#edit-parameter-and-values-input').html(html);
                    $('#specification_d').val(data.data.specification);
                    $('#note_d').val(data.data.note);
					$('#editModal').modal('show');
				},
				error: function(error){
					console.log(error);
				}
			})
		})

		$('#btn-update').click(function(e) {
			e.preventDefault();

			let _token   = $('meta[name="csrf-token"]').attr('content');


			let params = []
			$('.parameter_and_values_param').each(function(){
				params.push($(this)[0].value)
			});

			let values = []
			$('.parameter_and_values_value').each(function(){
				values.push([$(this)[0].value])
			});

			let object = {}

			params.forEach((item, index) => {
				object[item] = values[index]
			})

			var formData = {
				id_operator: $('#id_operators_d').val(),
                document_no:$('#document_no_d').val(),
                sampler:$('#sampler_d').val(),
                testing_parameter:$('#testing_parameter_d').val(),
                recieved_date:$('#recieved_date_d').val(),
                sample_count:$('#sample_count_d').val(),
                test_start_date:$('#test_start_date_d').val(),
                test_end_date:$('#test_end_date_d').val(),
                sample_no:$('#sample_no_d').val(),
                parameter:$('#parameter_d').val(),
                specification:$('#specification_d').val(),
                note:$('#note_d').val(),
				parameter_and_values: object,
				_token: _token
			}

			var type = "PUT"
			var dataType = "JSON"
			var id_operator = $('#id_operators_d').val();
			var base_url = "{{ URL::to('/operators/edit/:id') }}"
			base_url = base_url.replace(':id', id_operator);

			$.ajax({
				url: base_url,
				type: type,
				data: formData,
				dataType: dataType,
				success: function(result) {
					if (result.code === 200) {
						Swal.fire({
							icon: 'success',
							title: 'Your work has been saved',
							showConfirmButton: false,
							timer: 1500,
						}).then((result) => {
							window.location = "/operators"
						}).catch((err) => {
							alert('Silahkan refresh')
						})

					} else if(result.code === 300) 	{
						Swal.fire({
							icon: 'error',
							title: 'Ops....! Failed Update',
							timer: 1500
						}).then((result) => { window.location = "/operators" })
					} else {
						alert('Erros Request')
					}
				},
				error: function(err) {
					return
					Swal.fire({
						icon: 'error',
						title: 'Oops...',
						text: 'Something went wrong!',

					}).then((result) => { window.location = "/operators" })
				}
			})
		})
	})


    var i = 0;
       
    $("#add").click(function(){
   
        ++i;
   
        $("#formModal").append('<tr><td><input type="text" name="parameter_and_values['+i+'][parameter]" placeholder="Enter your Parameter" class="form-control" /></td><td><input type="text" name="parameter_and_values['+i+'][test_values]" placeholder="Enter your Nilai Uji" class="form-control" /></td><td><button type="button" class="btn btn-danger remove-tr">Remove</button></td></tr>');
    });
   
    $(document).on('click', '.remove-tr', function(){  
         $(this).parents('tr').remove();
    });  
</script>
@endsection