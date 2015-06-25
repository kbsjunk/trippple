<div class="form-group{{ $errors->first($field, ' has-error') }}">

	<label for="{{ $field }}" class="control-label">{{ $label }}</label>

	<select name="{{ $field }}" id="{{ $field }}" class="form-control" data-selectize="place" placeholder="{{ $label }}" value="{{{ Input::old($field, $trip->$field) }}}">
		@if ($place)
		<option value="{{{ $place->id }}}" selected data-data="{{ $place->toJson() }}">{{ $place->label }}</option>
		@elseif (Input::old($field))
		<?php $place = App\Place::find(Input::old($field)); ?>
		<option value="{{{ $place->id }}}" selected data-data="{{ $place->toJson() }}">{{ $place->label }}</option>
		@endif
	</select>

	<span class="help-block">{{{ $errors->first($field, ':message') }}}</span>

</div>