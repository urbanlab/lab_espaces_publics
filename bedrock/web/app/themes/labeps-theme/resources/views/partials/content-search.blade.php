<x-content-card>
    <x-slot name="title">
        {{$title}}
    </x-slot>
    <x-slot name="tags">
        <p class="bg-secondary tags">
            <x-translatable-post-type :post-type="$post->post_type"/>
        </p>
    </x-slot>
    <x-slot name="content">
        {!! the_excerpt() !!}
    </x-slot>
</x-content-card>
