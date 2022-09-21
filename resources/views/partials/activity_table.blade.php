<table id="activity-table" class="table table-bordered">
  <thead>
    <tr class="table-secondary">
      <th scope="col">Metode</th>
      <th scope="col">Juli</th>
      <th scope="col">Agustus</th>
      <th scope="col">September</th>
      <th scope="col">Oktober</th>
      <th scope="col">November</th>
      <th scope="col">Desember</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($data as $item)
  		<tr>
			<td>
				<p>{{ $item['metode'] }}</p>
			</td>
			<td>
				<div class="d-grid gap-2">
				@foreach($item['juli'] as $itemb)
					<button
						type="button" class="btn activity-item btn-light" style="font-size: 12px"
						data-activity-id="{{ $itemb['activity_id'] }}"
					>
						<span>{{ $itemb['title'] }}</span><br>
						<span class="text-primary">{{ '(' . date('d/m/Y', strtotime($itemb['start'])) . ' - ' . date('d/m/Y', strtotime($itemb['finish'])) . ')' }}</span>
					</button>
				@endforeach
				</div>
			</td>
			<td>
				<div class="d-grid gap-2">
				@foreach($item['agustus'] as $itemb)
					<button
						type="button" class="btn activity-item btn-light" style="font-size: 12px"
						data-activity-id="{{ $itemb['activity_id'] }}"
					>
						<span>{{ $itemb['title'] }}</span><br>
						<span class="text-primary">{{ '(' . date('d/m/Y', strtotime($itemb['start'])) . ' - ' . date('d/m/Y', strtotime($itemb['finish'])) . ')' }}</span>
					</button>
				@endforeach
				</div>
			</td>
			<td>
				<div class="d-grid gap-2">
				@foreach($item['september'] as $itemb)
					<button
						type="button" class="btn activity-item btn-light" style="font-size: 12px"
						data-activity-id="{{ $itemb['activity_id'] }}"
					>
						<span>{{ $itemb['title'] }}</span><br>
						<span class="text-primary">{{ '(' . date('d/m/Y', strtotime($itemb['start'])) . ' - ' . date('d/m/Y', strtotime($itemb['finish'])) . ')' }}</span>
					</button>
				@endforeach
				</div>
			</td>
			<td>
				<div class="d-grid gap-2">
				@foreach($item['oktober'] as $itemb)
					<button
						type="button" class="btn activity-item btn-light" style="font-size: 12px"
						data-activity-id="{{ $itemb['activity_id'] }}"
					>
						<span>{{ $itemb['title'] }}</span><br>
						<span class="text-primary">{{ '(' . date('d/m/Y', strtotime($itemb['start'])) . ' - ' . date('d/m/Y', strtotime($itemb['finish'])) . ')' }}</span>
					</button>
				@endforeach
				</div>
			</td>
			<td>
				<div class="d-grid gap-2">
				@foreach($item['november'] as $itemb)
					<button
						type="button" class="btn activity-item btn-light" style="font-size: 12px"
						data-activity-id="{{ $itemb['activity_id'] }}"
					>
						<span>{{ $itemb['title'] }}</span><br>
						<span class="text-primary">{{ '(' . date('d/m/Y', strtotime($itemb['start'])) . ' - ' . date('d/m/Y', strtotime($itemb['finish'])) . ')' }}</span>
					</button>
				@endforeach
				</div>
			</td>
			<td>
				<div class="d-grid gap-2">
				@foreach($item['desember'] as $itemb)
					<button
						type="button" class="btn activity-item btn-light" style="font-size: 12px"
						data-activity-id="{{ $itemb['activity_id'] }}"
					>
						<span>{{ $itemb['title'] }}</span><br>
						<span class="text-primary">{{ '(' . date('d/m/Y', strtotime($itemb['start'])) . ' - ' . date('d/m/Y', strtotime($itemb['finish'])) . ')' }}</span>
					</button>
				@endforeach
				</div>
			</td>
	    </tr>
  	@endforeach
  </tbody>
</table>

<!-- Update Modal -->
<div class="modal fade" id="update-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Update Activity</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      	<div class="alert alert-info" role="alert">
				  Status: <span id="activity-status"></span>
				</div>

        <form id="update-activity-form">
        	<input id="update-id" type="hidden" name="id" value="">
				  <div class="mb-3">
				    <label class="form-label">Metode</label>
				    <select id="update-method" name="method_id" class="form-select">
					  <option disabled selected>Pilih metode</option>
					  @foreach($methods as $method)
					  	<option value="{{ $method->id }}">{{ $method->name }}</option>
					  @endforeach
					</select>
				  </div>
				  <div class="mb-3">
				    <label class="form-label">Judul</label>
				    <input id="update-title" name="title" type="text" class="form-control" required>
				  </div>
				  <div class="mb-3">
				    <label class="form-label">Tanggal Mulai</label>
				    <input id="update-start" name="start" type="date" class="form-control" min="2022-07-01" max="2022-12-30" required>
				  </div>
				  <div class="mb-3">
				    <label class="form-label">Tanggal Selesai</label>
				    <input id="update-finish" name="finish" type="date" class="form-control" min="2022-07-01" max="2022-12-30" required>
				  </div>
				  <button type="submit" class="btn btn-primary w-100">Update</button>
				</form>
				<button id="btn-delete-activity" data-activity-id="" class="btn btn-danger mt-3 w-100">Hapus</button>
      </div>
    </div>
  </div>
</div>

<script>
$( document ).ready(function() {
 
	const updateModal = new bootstrap.Modal('#update-modal');

	$('.activity-item').each(function() {
		$(this).click(function() {
			const activityId = $(this).attr('data-activity-id');

			$.ajax({
			  type: "GET",
			  url: "{{ url('activities/details') }}"+`/${activityId}`,
			  dataType: 'json',
			  success: function(data) {
			  	const currentDate = new Date().getTime();
			  	const startDate = new Date(data.start).getTime();
			  	const finishDate = new Date(data.finish).getTime();

			  	if (startDate > currentDate) {
				    // activity akan datang
				    $('#activity-status').html('Activity Akan Datang');
				  } else if (startDate <= currentDate && finishDate >= currentDate) {
				    // activity berlangsung
				    $('#activity-status').html('Activity Sedang Berlangsung');
				  } else if (finishDate < currentDate) {
				    // activity selesai
				    $('#activity-status').html('Activity Telah Selesai');
				  }

			  	$('#update-id').val(data.id);
			  	$('#update-method').val(data.method_id.toString());
			  	$('#update-title').val(data.title);
			  	$('#update-start').val(data.start);
			  	$('#update-finish').val(data.finish);
			  	$('#btn-delete-activity').attr('data-activity-id', data.id);

			  	updateModal.show();
			  },
			});
		});
	});

	$('#update-activity-form').submit(function(event) {
		event.preventDefault();

		const formData = $(this).serializeArray();
		const activityId = formData[0].value;
		
		$.ajax({
		  type: "PUT",
		  url: "{{ url('activities') }}" + `/${activityId}`,
		  data: formData,
		  dataType: 'json',
		  beforeSend: function() {
		  	console.log('updating', activityId);
		  },
		  success: function(data) {
		  	alert(data.message);
		  	updateModal.hide();
		  	renderTable()
		  },
		});
	});

	$('#btn-delete-activity').click(function() {
		const activityId = $(this).attr('data-activity-id');
		$.ajax({
		  type: "DELETE",
		  url: "{{ url('activities/delete') }}" + `/${activityId}`,
		  dataType: 'json',
		  beforeSend: function() {
		  	console.log('deleting', activityId);
		  },
		  success: function(data) {
		  	alert(data.message);
		  	updateModal.hide();
		  	renderTable()
		  },
		});
	})

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