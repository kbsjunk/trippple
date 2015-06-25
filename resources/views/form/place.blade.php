<div class="form-group{{ $errors->first($field, ' has-error') }}">

	<label for="{{ $field }}" class="control-label">{{ $label }}</label>

	@if (!$place && Input::old($field))
	<?php $place = App\Place::find(Input::old($field)); ?>
	@endif

	<selectize config="placesConfig" options="[{{ $place->toJson() }}]" ng-model="{{ $model->ng_model }}.{{ $field }}"></selectize>

	<span class="help-block">{{{ $errors->first($field, ':message') }}}</span>

</div>