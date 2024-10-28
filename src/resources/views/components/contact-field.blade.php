@php
    $fieldName = is_array($name) ? implode('_', $name) : $name;
    $fieldId = $id ?? (is_array($name) ? $name[0] : $name);
@endphp

<div class="form__group form__group--{{ $fieldName }}">
    <div class="form__label-box">
        <label class="form__label" for="{{ $fieldId }}">
            {{ $label }} @if(!empty($required)) <span class="form__required">※</span> @endif
        </label>
        @if(is_array($name))
            @foreach($name as $field)
                @error($field)
                    <div class="form__error">{{ $message }}</div>
                @enderror
            @endforeach
        @else
            @error($name)
                <div class="form__error">{{ $message }}</div>
            @enderror
        @endif
    </div>
    <div class="form__input-box">
        {{ $slot }}
    </div>
</div>
