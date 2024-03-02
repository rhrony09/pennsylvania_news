<div {{ $attributes->merge(['class' => 'mt-3']) }}>
    <x-forms.label :fieldId="$fieldId" :fieldLabel="$fieldLabel" fieldRequired="{{ isset($fieldRequired) ? $fieldRequired : '' }}"></x-forms.label>
    <input type="text" class="form-control" placeholder="{{ isset($fieldPlaceholder) ? $fieldPlaceholder : '' }}" value="{{ isset($fieldValue) ? $fieldValue : '' }}" name="{{ $fieldName }}" id="{{ $fieldId }}" @isset($fieldRequired) required @endisset>
    @isset($fieldHelp)
        <small id="{{ $fieldId }}Help" class="form-text text-muted">{{ $fieldHelp }}</small>
    @endisset
</div>
