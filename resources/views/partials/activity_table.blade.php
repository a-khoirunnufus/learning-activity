<table id="activity-table" class="table table-bordered">
  <thead>
    <tr class="table-secondary">
      <th scope="col">Metode</th>
      <th scope="col">Januari</th>
      <th scope="col">Februari</th>
      <th scope="col">Maret</th>
      <th scope="col">April</th>
      <th scope="col">Mei</th>
      <th scope="col">Juni</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($data as $item)
  		<tr>
			<td>{{ $item['metode'] }}</td>
			<td>
				<div class="d-grid gap-2">
				@foreach($item['januari'] as $itemb)
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
				@foreach($item['februari'] as $itemb)
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
				@foreach($item['maret'] as $itemb)
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
				@foreach($item['april'] as $itemb)
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
				@foreach($item['mei'] as $itemb)
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
				@foreach($item['juni'] as $itemb)
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
				    <input id="update-start" name="start" type="date" class="form-control" min="2022-01-01" max="2022-06-30" required>
				  </div>
				  <div class="mb-3">
				    <label class="form-label">Tanggal Selesai</label>
				    <input id="update-finish" name="finish" type="date" class="form-control" min="2022-01-01" max="2022-06-30" required>
				  </div>
				  <button type="submit" class="btn btn-primary">Update</button>
				</form>
				<button id="btn-delete-activity" data-activity-id="" class="btn btn-danger">Hapus</button>
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