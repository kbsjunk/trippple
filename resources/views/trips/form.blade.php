@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-lg-10 col-lg-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Trip
						@if ($trip->exists)
						<small>{{ $trip->name }}</small>
						@endif
					</h4>
				</div>

				<div class="panel-body">

					<form role="form"  action="{{ $trip->exists ? route('trips.update', $trip->id) : route('trips.store') }}" method="post">

						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						@if ($trip->exists)
						<input type="hidden" name="_method" value="PUT">
						@endif

						@include('form.text', ['field' => 'name', 'label' => 'Trip Name'])

						<div class="row">
							<div class="col-sm-12 col-md-5">
								@include('form.place', ['field' => 'start_place_id', 'label' => 'Start Place', 'place' => $trip->startPlace])
							</div>
							<div class="col-sm-6 col-md-3">
								@include('form.date', ['field' => 'start_at', 'label' => 'Start Date'])
							</div>
							<div class="col-sm-6 col-md-4">
								@include('form.timezone', ['field' => 'start_at_tz', 'label' => 'Time Zone'])
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								@include('form.place', ['field' => 'end_place_id', 'label' => 'End Place', 'place' => $trip->endPlace])
							</div>
							<div class="col-sm-6 col-md-3">
								@include('form.date', ['field' => 'end_at', 'label' => 'End Date'])
							</div>
							<div class="col-sm-6 col-md-4">
								@include('form.timezone', ['field' => 'end_at_tz', 'label' => 'Time Zone'])
							</div>
						</div>

						<hr>

						<button type="submit" class="btn btn-primary">Save</button>
						<a href="{{ route('trips.index') }}" class="btn btn-link">Cancel</a>

					</form>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h4>Map</h4>
				</div>

				<div class="panel-body" style="padding:0;">

					@include('form.map', [ 'markers' => ''])

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
