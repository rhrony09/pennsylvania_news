<li>
    <button {{ $attributes->merge(['class' => 'dropdown-item']) }}>
        @isset($icon)
            <i class="fa fa-{{ $icon }}"></i>
            {{ $slot }}
        @endisset
    </button>
</li>
