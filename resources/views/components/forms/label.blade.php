<label {{ $attributes->merge(['class' => 'mb-1']) }} for="{{ $fieldId }}">{{ $fieldLabel }}
    @isset($fieldRequired == 'true')
        <sup class="mr-1">*</sup>
    @endisset

    @isset($popover)
        <i class="fa fa-question-circle" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="{{ $popover }}"></i>
    @endisset
</label>
