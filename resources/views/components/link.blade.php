<a href="{{ $link }}" {{ $attributes->merge(['class' => 'btn btn-primary mt-2']) }} @isset($newTab == 'true') target="_blank" @endisset>
    @isset($icon)
        <i class="fa fa-{{ $icon }} mr-1"></i>
    @endisset
    {{ $slot }}
</a>
