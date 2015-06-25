@extends('app')

@section('content')
<div class="container" ng-controller="TripController">
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
								@include('form.place', ['model' => $trip, 'field' => 'start_place_id', 'label' => 'Start Place', 'place' => $trip->startPlace])
							</div>
							<div class="col-sm-6 col-md-3">
								@include('form.date', ['model' => $trip, 'field' => 'start_at', 'label' => 'Start Date'])
							</div>
							<div class="col-sm-6 col-md-4">
								@include('form.timezone', ['model' => $trip, 'field' => 'start_at_tz', 'label' => 'Time Zone'])
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12 col-md-5">
								@include('form.place', ['model' => $trip, 'field' => 'end_place_id', 'label' => 'End Place', 'place' => $trip->endPlace])
							</div>
							<div class="col-sm-6 col-md-3">
								@include('form.date', ['model' => $trip, 'field' => 'end_at', 'label' => 'End Date'])
							</div>
							<div class="col-sm-6 col-md-4">
								@include('form.timezone', ['model' => $trip, 'field' => 'end_at_tz', 'label' => 'Time Zone'])
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

					{{--@include('form.map', [ 'markers' => ''])--}}

				</div>
			</div>
		</div>
	</div>
</div>
<script>
	trippple.controllers.TripController = ['$scope', function($scope) {
		$scope.trip = {!! $trip->toJson() !!};

		$scope.trip.start_at = $scope.trip.start_at ? new Date($scope.trip.start_at) : null;
		$scope.trip.end_at = $scope.trip.end_at ? new Date($scope.trip.end_at) : null;

		$scope.placesConfig = {
			valueField: 'id',
			searchField: ['name', 'name_alt'],
			create: false,
			maxItems: 1,
			render: {
				option: function(item, escape) {
					var option = '<div class="option">' + escape(item.name);
					if (item.region) {
						option = option + ', <span class="text-muted">' + escape(item.region.name) + '</span>';
					}
					if (item.country) {
						option = option + ', <span class="text-muted">' + escape(item.country.name) + '</span>';
					}
					return option+'</div>';
				},
				item: function(item, escape) {
					var option = '<div class="option">' + escape(item.name);
					if (item.region) {
						option = option + ', <span class="text-muted">' + escape(item.region.name) + '</span>';
					}
					if (item.country) {
						option = option + ', <span class="text-muted">' + escape(item.country.name) + '</span>';
					}
					return option+'</div>';
				}
			},
			load: function(query, callback) {
				if (!query.length) return callback();
				$.ajax({
					url: '/api/places/search/' + encodeURIComponent(query) + '?include=timezone,geometry',
					type: 'GET',
					error: function() {
						callback();
					},
					success: function(res) {
						callback(res.data);
					}
				});
			}
		};

		$scope.placesOptions = [];

	}];
</script>
@endsection
