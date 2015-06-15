@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading"><h4>Trips</h4></div>

				<div class="panel-body">
					Your trips are available below.
				</div>

				<table class="table">
					<thead>
						<tr>
							<th class="col-md-4">Name</th>
							<th class="col-md-3">From</th>
							<th class="col-md-3">To</th>
							<th class="col-md-2">Actions</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($trips as $trip)
						<tr>
							<td>
								<a href="{{ route('trips.show', $trip->id) }}">{{ $trip->name }}</a>
							</td>
							<td>
								{{ $trip->startPlace->name }}, {{ $trip->startPlace->country }}<br>
								{{ $trip->start_at->formatLocalized(Config::get('app.dateformat')) }}
							</td>
							<td>
								{{ $trip->endPlace->name }}, {{ $trip->endPlace->country }}<br>
								{{ $trip->end_at->formatLocalized(Config::get('app.dateformat')) }}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

			</div>
		</div>
	</div>
</div>
@endsection
