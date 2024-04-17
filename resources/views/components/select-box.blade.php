@php
    $multipleValue = !empty($multipleValues) ? json_decode(html_entity_decode($multipleValues), true) : array();
@endphp
<div class="form-group">
    <label class="font-weight-bold {{ $extraLabelClass }}">{{ $placeholder }}</label>
    <select class="js-example-basic-single w-100 {{ $extraClass }}" data-width="100%" name="{{ $name }}" data-endpoint="{{ $endpoint }}" data-field1-id="{{ $field1 }}" data-field2-id="{{ $field2 }}" {{ $multiple ? 'multiple' : '' }}>
        @if(!$multiple && ($noSelectOption == 'false' ? false : true ))
            <option value="">Select {{ $removeTextSelection ? "" : $placeholder }}</option>
        @endif
        @if(!empty($values))
            @foreach($values as $key => $data)
                @if($multiple && !empty($selectedValues))
                    <option value="{{ $key }}" {{ (in_array($key, explode(',',$selectedValues))) ? 'selected' : '' }}>{{ $data }}</option>
                @else
                    <option value="{{ $key }}" {{ ($key == $value) ? 'selected' : '' }}>{{ $data }}</option>
                @endif
            @endforeach
        @endif
        @if(isset($multipleValue['id']) && count($multipleValue['id']) > 0)
            @foreach($multipleValue['id'] as $key => $data)
                <option value="{{ $multipleValue['id'][$key] }}" selected>{{ $multipleValue['name'][$key] }}</option>
            @endforeach
        @endif
        @if(!empty($value) && (strpos($extraClass, 'ajax-endpoint') !== false))
            <option value="{{ $value }}" selected>{{ $optionText }}</option>
        @endif
    </select>
    @error($name)
        <div class="text text-danger">{{ $message }}</div>
    @enderror
</div>
