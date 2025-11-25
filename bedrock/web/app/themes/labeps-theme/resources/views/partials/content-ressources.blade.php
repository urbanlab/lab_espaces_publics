<x-content-card>
    <x-slot name="title">
        {!! $title !!}
    </x-slot>
    <x-slot name="tags">
        @foreach ((wp_get_post_terms($post->ID, 'types')) as $item)
            <p class="bg-secondary text-white w-fit text-xs! py-1.5! px-2! m-1! rounded-md! me-8!">{{$item->name}}</p>
        @endforeach
    </x-slot>
</x-content-card>
