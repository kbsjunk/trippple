@if (count($errors) > 0)
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>Error</strong> 
				@if(count($errors) == 1)
				{{ $errors->first() }}
				@else
				There were some problems with your input.<br><br>
				<ul>
					@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
					@endforeach
				</ul>
				@endif
			</div>
		</div>
	</div>
</div>
@endif