<div class="form-group{{ $errors->first($field, ' has-error') }}">

	<label for="{{ $field }}" class="control-label">{{ $label }}</label>

	<select name="{{ $field }}" id="{{ $field }}" class="form-control" data-selectize="timezone">
		<option value=""></option>
		@foreach (Config::get('datetime.timezones') as $timezone => $key)
		<option value="{{ $key }}"{{ Input::old($field, $trip->$field) == $key ? ' selected' : null }} data-data="">{{ $timezone }}</option>
		@endforeach
	</select>

	<span class="help-block">{{{ $errors->first($field, ':message') }}}</span>

</div>