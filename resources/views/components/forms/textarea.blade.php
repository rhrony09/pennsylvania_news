<div {{ $attributes->merge(['class' => 'mt-3']) }}>
    <x-forms.label :fieldId="$fieldId" :fieldLabel="$fieldLabel" :fieldRequired="$fieldRequired" @isset($popover) :popover="$popover" @endisset></x-forms.label>
    <textarea class="form-control" rows="4" placeholder="{{ $fieldPlaceholder }}" name="{{ $fieldName }}" id="{{ $fieldId }}" @isset($fieldRequired) required @endisset>{{ $fieldValue }}</textarea>
</div>
