<div class="form-group{{ $errors->first($field, ' has-error') }}">

	<label for="{{ $field }}" class="control-label">{{ $label }}</label>

	<input type="date" class="form-control" name="{{ $field }}" id="{{ $field }}" ng-model="{{ $model->ng_model }}.{{ $field }}" placeholder="{{ $label }}" value="{{{ Input::old($field, $model->$field ? $model->$field->format('Y-m-d') : null) }}}">

	<span class="help-block">{{{ $errors->first($field, ':message') }}}</span>

</div>