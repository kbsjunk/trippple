<div class="form-group{{ $errors->first($field, ' has-error') }}">

	<label for="{{ $field }}" class="control-label">{{ $label }}</label>

	<input type="datetime" class="form-control" name="{{ $field }}" id="{{ $field }}" placeholder="{{ $label }}" value="{{{ Input::old($field, $trip->$field) }}}">

	<span class="help-block">{{{ $errors->first($field, ':message') }}}</span>

</div>