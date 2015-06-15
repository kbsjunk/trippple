<div id="map-canvas"></div>

@section('scripts')
@parent
<script src="{{ asset('js/fontawesome-markers.min.js') }}"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=false"></script>
<script>

	var map;
	var tripCoordinates;
	var tripPath;

	function initialize() {

		var mapOptions = {
			zoom: 2,
			center: new google.maps.LatLng(0,0),
			mapTypeId: google.maps.MapTypeId.TERRAIN
		};

		map = new google.maps.Map(document.getElementById('map-canvas'),
			mapOptions);

		tripCoordinates = [
		new google.maps.LatLng({{ $trip->startPlace->latitude }}, {{ $trip->startPlace->longitude }}),
		@foreach ($trip->destinations as $place)
		new google.maps.LatLng({{ $place->latitude }}, {{ $place->longitude }}),
		@endforeach
		new google.maps.LatLng({{ $trip->endPlace->latitude }}, {{ $trip->endPlace->longitude }})
		];

		tripPath = new google.maps.Polyline({
			path: tripCoordinates,
			geodesic: true,
			strokeColor: 'rgb(244, 180, 0)',
			strokeOpacity: 1.0,
			strokeWeight: 3,
			zIndex: 100
		});

		tripPath.setMap(map);
	}

	google.maps.event.addDomListener(window, 'load', initialize);

</script>
@endsection

@section('styles')
@parent
<style>
	#map-canvas {
		height: 400px;
		margin: 0px;
		padding: 0px
	}
</style>
@endsection