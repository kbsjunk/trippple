<div class="form-group{{ $errors->first($field, ' has-error') }}">

	<label for="{{ $field }}" class="control-label">{{ $label }}</label>

	<select name="{{ $field }}" id="{{ $field }}" class="form-control" data-selectize="plain" placeholder="{{ $label }}">
		@if(!isset($noblank))
		<option value=""></option>
		@endif
		@foreach ($items as $key => $name)
		<option value="{{ $key }}"{{ Input::old($field, $trip->$field) == $key ? ' selected' : null }}>{{ $name }}</option>
		@endforeach
	</select>

	<span class="help-block">{{{ $errors->first($field, ':message') }}}</span>

</div>