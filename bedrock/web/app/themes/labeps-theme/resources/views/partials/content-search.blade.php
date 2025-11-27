<x-content-card>
    <x-slot name="title">
        {{$title}}
    </x-slot>
    <x-slot name="content">
        {!! the_excerpt() !!}
    </x-slot>
</x-content-card>
