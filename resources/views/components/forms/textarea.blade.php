<div {{ $attributes->merge(['class' => 'mt-3']) }}>
    <x-forms.label :fieldId="$fieldId" :fieldLabel="$fieldLabel" fieldRequired="{{ isset($fieldRequired) ? $fieldRequired : '' }}"></x-forms.label>
    <textarea class="form-control" rows="4" placeholder="{{ isset($fieldPlaceholder) ? $fieldPlaceholder : '' }}" name="{{ $fieldName }}" id="{{ $fieldId }}" @isset($fieldRequired) required @endisset>{{ isset($fieldValue) ? $fieldValue : '' }}</textarea>
</div>
