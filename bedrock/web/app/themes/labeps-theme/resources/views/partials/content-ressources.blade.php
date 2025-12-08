<x-content-card>
    <x-slot name="title">
        {!! $title !!}
    </x-slot>
    <x-slot name="tags">
        @foreach ((wp_get_post_terms($post->ID, 'types')) as $item)
            <p class="bg-secondary tags">{{$item->name}}</p>
        @endforeach
    </x-slot>
</x-content-card>
