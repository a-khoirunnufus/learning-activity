@extends('layouts.master')

@push('styles')
	<link href="{{ url('css/dashboard.css') }}" rel="stylesheet">
@endpush

@section('content')
	<div class="mb-3 d-flex justify-content-between">
		<!-- Button trigger modal -->
		<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#create-modal">
		  + Tambah Activity
		</button>
	</div>

	<div id="table-container">
		Sedang mengambil data, mohon tunggu...
	</div>

	<!-- Create Modal -->
	<div class="modal fade" id="create-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="staticBackdropLabel">Tambah Activity</h5>
	        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
	      </div>
	      <div class="modal-body">
	        <form id="store-activity-form">
			  <div class="mb-3">
			    <label class="form-label">Metode</label>
			    <select id="input-method" name="method_id" class="form-select">
				  <option disabled selected>Pilih metode</option>
				  @foreach($methods as $method)
				  	<option value="{{ $method->id }}">{{ $method->name }}</option>
				  @endforeach
				</select>
			  </div>
			  <div class="mb-3">
			    <label class="form-label">Judul</label>
			    <input id="input-title" name="title" type="text" class="form-control" required>
			  </div>
			  <div class="mb-3">
			    <label class="form-label">Tanggal Mulai</label>
			    <input id="input-start" name="start" type="date" class="form-control" min="2022-07-01" max="2022-12-30" required>
			  </div>
			  <div class="mb-3">
			    <label class="form-label">Tanggal Selesai</label>
			    <input id="input-finish" name="finish" type="date" class="form-control" min="2022-07-01" max="2022-12-30" required>
			  </div>
			  <button type="submit" class="btn btn-primary">Tambah</button>
			</form>
	      </div>
	    </div>
	  </div>
	</div>
@endsection

@push('scripts')
<script>
$( document ).ready(function() {
 
	const createModal = new bootstrap.Modal('#create-modal');

	renderTable();

	$('#store-activity-form').submit(function(event) {
		event.preventDefault();
		const formData = $(this).serializeArray();
		$.ajax({
		  type: "POST",
		  url: "{{ url('activities') }}",
		  data: formData,
		  dataType: 'json',
		  beforeSend: function() {
		  },
		  success: function(data) {
		  	createModal.hide();
		  	alert(data.message);
		  	renderTable();
		  },
		});
	});

	function renderTable() {
		$('#table-container').html('Sedang mengambil data, mohon tunggu...');
		$.ajax({
		  type: "GET",
		  url: "{{ url('activities/table') }}",
		  dataType: 'html',
		  success: function(data) {
		  	$('#table-container').html(data);
		  },
		});
	}
});
</script>
@endpush