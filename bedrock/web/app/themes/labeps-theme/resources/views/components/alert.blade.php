<div {{ $attributes->merge(['class' => "px-2 py-1 {$type}"]) }}>
    {!! $message ?? $slot !!}
</div>
