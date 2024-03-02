<div {{ $attributes->merge(['class' => 'mt-3']) }}>
    <x-forms.label :fieldId="$fieldId" :fieldLabel="$fieldLabel" :fieldRequired="$fieldRequired" @isset($popover) :popover="$popover" @endisset>
    </x-forms.label>
    <input type="file" class="dropify" id="{{ $fieldId }}" name="{{ $fieldName }}" data-default-file="{{ $fieldValue }}" @isset($allowedFileExtensions) data-allowed-file-extensions="{{ $allowedFileExtensions }}" @endisset data-height="{{ $fieldHeight }}" @isset($fieldRequired) required @endisset />

    @isset($fieldHelp)
        <small id="{{ $fieldId }}Help" class="form-text text-muted">{{ $fieldHelp }}</small>
    @endisset
</div>
