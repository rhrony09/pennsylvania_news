<div {{ $attributes->merge(['class' => 'mt-3']) }}>
    <x-forms.label :fieldId="$fieldId" :fieldLabel="$fieldLabel" fieldRequired="{{ isset($fieldRequired) ? $fieldRequired : '' }}"></x-forms.label>
    <select name="{{ $fieldName }}" id="{{ $fieldId }}" class="form-control select-picker" @isset($fieldRequired) required @endisset>
        {!! $slot !!}
    </select>
</div>
