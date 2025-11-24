<a href="{{ get_permalink() }}">
    <article id="post-{{ get_the_ID() }}" class="card @php(get_post_class()) h-full">
        <figure>
            {!!get_the_post_thumbnail()!!}
        </figure>
        <div class="entry-summary md:p-4">
            @foreach ((wp_get_post_terms($post->ID, 'types')) as $item)
            <p class="bg-secondary text-white w-fit text-xs! py-1.5! px-2! m-1! rounded-md! me-8!">{{$item->name}}</p>
            @endforeach
            <h3 class="entry-title text-base leading-7 p-1 font-bold lg:text-lg">
                {!! $title !!}
            </h3>
        </div>
    </article>
</a>