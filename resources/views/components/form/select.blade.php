<div class="form-group">
    {{ Form::label($name, $label) }}
    {{ Form::select($name, $values, $selectedValue, array_merge(['class' => 'form-control'], $attributes)) }}
</div>
