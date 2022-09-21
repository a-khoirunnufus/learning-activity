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
					<button type="button" class="btn btn-light" style="font-size: 12px">
						<span>{{ $itemb['title'] }}</span><br>
						<span class="text-primary">{{ '(' . date('d/m/Y', strtotime($itemb['start'])) . ' - ' . date('d/m/Y', strtotime($itemb['finish'])) . ')' }}</span>
					</button>
				@endforeach
				</div>
			</td>
			<td>
				<div class="d-grid gap-2">
				@foreach($item['februari'] as $itemb)
					<button type="button" class="btn btn-light" style="font-size: 12px">
						<span>{{ $itemb['title'] }}</span><br>
						<span class="text-primary">{{ '(' . date('d/m/Y', strtotime($itemb['start'])) . ' - ' . date('d/m/Y', strtotime($itemb['finish'])) . ')' }}</span>
					</button>
				@endforeach
				</div>
			</td>
			<td>
				<div class="d-grid gap-2">
				@foreach($item['maret'] as $itemb)
					<button type="button" class="btn btn-light" style="font-size: 12px">
						<span>{{ $itemb['title'] }}</span><br>
						<span class="text-primary">{{ '(' . date('d/m/Y', strtotime($itemb['start'])) . ' - ' . date('d/m/Y', strtotime($itemb['finish'])) . ')' }}</span>
					</button>
				@endforeach
				</div>
			</td>
			<td>
				<div class="d-grid gap-2">
				@foreach($item['april'] as $itemb)
					<button type="button" class="btn btn-light" style="font-size: 12px">
						<span>{{ $itemb['title'] }}</span><br>
						<span class="text-primary">{{ '(' . date('d/m/Y', strtotime($itemb['start'])) . ' - ' . date('d/m/Y', strtotime($itemb['finish'])) . ')' }}</span>
					</button>
				@endforeach
				</div>
			</td>
			<td>
				<div class="d-grid gap-2">
				@foreach($item['mei'] as $itemb)
					<button type="button" class="btn btn-light" style="font-size: 12px">
						<span>{{ $itemb['title'] }}</span><br>
						<span class="text-primary">{{ '(' . date('d/m/Y', strtotime($itemb['start'])) . ' - ' . date('d/m/Y', strtotime($itemb['finish'])) . ')' }}</span>
					</button>
				@endforeach
				</div>
			</td>
			<td>
				<div class="d-grid gap-2">
				@foreach($item['juni'] as $itemb)
					<button type="button" class="btn btn-light" style="font-size: 12px">
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