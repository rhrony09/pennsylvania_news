<div {{ $attributes->merge(['class' => 'mt-3']) }}>
    <x-forms.label :fieldId="$fieldId" :fieldLabel="$fieldLabel" fieldRequired="{{ isset($fieldRequired) ? $fieldRequired : '' }}">
    </x-forms.label>
    <input type="file" class="dropify" id="{{ $fieldId }}" name="{{ $fieldName }}" data-default-file="{{ isset($fieldValue) ? $fieldValue : '' }}" @isset($allowedFileExtensions) data-allowed-file-extensions="{{ $allowedFileExtensions }}" @endisset data-height="{{ isset($fieldHeight) ? $fieldHeight : '' }}" @isset($fieldRequired) required @endisset />

    @isset($fieldHelp)
        <small id="{{ $fieldId }}Help" class="form-text text-muted">{{ $fieldHelp }}</small>
    @endisset
</div>
