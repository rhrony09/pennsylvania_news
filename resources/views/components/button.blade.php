<button {{ $attributes->merge(['class' => 'btn btn-primary mt-2', 'type' => 'button']) }}>
    @isset($icon)
        <i class="fa fa-{{ $icon }} mr-1"></i>
    @endisset
    {{ $slot }}
</button>
