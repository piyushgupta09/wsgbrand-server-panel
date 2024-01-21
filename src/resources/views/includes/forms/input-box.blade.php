{{-- 
   $label : The text to be displayed as the label of the input field.
   $modelName : The name of the Laravel model, used to generate a unique ID for the input field.
   $name : The attribute of the model that this input field corresponds to. Also serves as the 'name' attribute for the input field in HTML.
   $p_style : CSS class names to be added to the parent div of the input field.
   $type : The type of the input field (such as 'text', 'file', etc.).
   $style : CSS class names to be added to the input field.
   $attribute : An array of additional HTML attributes to apply to the input field.
   $placeholder : The placeholder text for the input field.
   $show : A boolean determining if the input field should be disabled or not.
   $model : The instance of the model. If provided, the model's corresponding value will be set as the input value. If not provided, Laravel's old() helper function is used to maintain the form state after validation errors.
   @error($name) : Laravel Blade directive. If there is a validation error for this input field, the error message is displayed.
--}}
<div class="form-floating mb-3 {{ empty($p_style) ? '' : $p_style }}">

  <input 
    name="{{ $name }}" 
    @if($show) disabled @endif
    id="floating{{ $modelName }}{{ $name }}"
    type="{{ empty($type) ? 'text' : $type }}" 
    class="form-control {{ empty($style) ? '' : $style }}" 
    {{ empty($attribute) ? '' : implode(' ', $attribute)  }}
    value="{{ empty($model) ? (isset($default) ? $default : old($name)) : $model->$name }}" 
    placeholder="{{ empty($placeholder) ? '' : $placeholder }}" 
  >

  @if (!empty($label))  
    <label for="floating{{ $modelName }}{{ $name }}" class="ps-4 font-quick">{{ $label }}</label>
  @endif

  <!-- Display validation error message if any -->
  @error($name)
      <span class="input_val_error">{{ $message }}</span>
  @enderror

  @if (!empty($note))  
    <span class="small ps-2 font-quick">{{ $note }}</span>
  @endif

</div>
