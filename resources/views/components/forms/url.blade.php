<div {{ $attributes->merge(['class' => 'mt-3']) }}>
    <x-forms.label :fieldId="$fieldId" :fieldLabel="$fieldLabel" :fieldRequired="$fieldRequired" @isset($popover) :popover="$popover" @endisset></x-forms.label>
    <input type="url" class="form-control" placeholder="{{ $fieldPlaceholder }}" value="{{ $fieldValue }}" name="{{ $fieldName }}" id="{{ $fieldId }}" @isset($fieldRequired) required @endisset @isset($fieldReadOnly) readonly @endisset>
    @isset($fieldHelp)
        <small id="{{ $fieldId }}Help" class="form-text text-muted">{{ $fieldHelp }}</small>
    @endisset
</div>
