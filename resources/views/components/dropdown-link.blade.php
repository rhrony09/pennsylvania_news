<li>
    <a class="dropdown-item" href="{{ $link }}">
        @isset($icon)
            <i class="fa fa-{{ $icon }}"></i>
        @endisset {{ $slot }}
    </a>
</li>
