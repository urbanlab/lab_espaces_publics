<x-content-card>
    <x-slot name="title">
        {!! $title !!}
    </x-slot>
    <x-slot name="content">
        @foreach ((wp_get_post_terms($post->ID, 'commune')) as $item)
            <p class="text-xs">📍{{$item->name}}</p>
        @endforeach
        <p>{{the_excerpt()}}</p>
    </x-slot>
</x-content-card>
