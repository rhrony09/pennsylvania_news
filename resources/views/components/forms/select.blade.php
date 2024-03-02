<div {{ $attributes->merge(['class' => 'mt-3']) }}>
    <x-forms.label :fieldId="$fieldId" :fieldLabel="$fieldLabel" :fieldRequired="$fieldRequired" @isset($popover) :popover="$popover" @endisset></x-forms.label>
    <select name="{{ $fieldName }}" id="{{ $fieldId }}" @isset($multiple) multiple @endisset class="form-control select-picker" @isset($fieldRequired) required @endisset>
        {!! $slot !!}
    </select>
</div>
