@php
    use Carbon\Carbon;

    $date = Carbon::createFromFormat('Y-m-d', get_field('event_datetime'))->locale('fr_FR');
    $now = Carbon::now()->locale('fr_FR');
@endphp


<x-content-card>
    <x-slot name="tags">
        <span class="tags bg-primary">@if ($now > $date)Passé @else À venir @endif</span>
    </x-slot>
    <x-slot name="title">
        {!! $title !!}
    </x-slot>
    <x-slot name="content">
        <p class="text-xs">
            @foreach ((wp_get_post_terms($post->ID, 'commune')) as $item)
                📍{{$item->name}}
            @endforeach
            <br>📆 {{$date->isoFormat('Do MMM Y')}}
        </p>
        <p>{{the_excerpt()}}</p>
    </x-slot>
</x-content-card>
