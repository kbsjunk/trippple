@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<form action="" method="post">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="panel panel-default">
					<div class="panel-heading"><h4>Regions</h4></div>
					<table class="table">
						<thead>
							<tr>
								<th colspan="2">Geonames</th>
								<th colspan="2">ISO 3166-2</th>
							</tr>
							<tr>
								<th class="col-md-1">Code</th>
								<th class="col-md-5">Name</th>
								<th class="col-md-1">Code</th>
								<th class="col-md-5">Name</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($regions as $region)
							<tr>
								<td>
									{{ $region->code }}
								</td>
								<td>
									{{ $region->name }}
								</td>
								<td>
									{{ $region->iso_code }}
								</td>
								<td>
									<select name="iso_code[{{{ $region->code }}}]" class="form-control">
										<option value=""></option>
										@foreach ($allRegions as $newRegion)
										<option value="{{ $newRegion->iso_code }}"{{ $newRegion->iso_code == $region->iso_code ? 'selected' : null }}>{{ $newRegion->name }} ({{ $newRegion->type }}) {{ $newRegion->attached ? ' *' : null }}</option>
										@endforeach
									</select>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
					<div class="panel-footer">
						<button type="submit" class="btn btn-primary">Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
