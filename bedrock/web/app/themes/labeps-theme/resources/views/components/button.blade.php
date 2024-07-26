<button {{ $attributes->merge(['class' => 'btn ' . $class]) }}>
    @if ($icon)
        <i class="{{ $icon }} mr-2"></i>
    @endif
    {{ $text }}
</button>