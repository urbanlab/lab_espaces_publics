<article class='flex md:flex-col content-center bg-white p-4 border border-black rounded-md @php(get_post_class())'>
    <figure class="rounded-md w-full h-40 me-8">
      {!!get_the_post_thumbnail()!!}
    </figure>
    <div class="entry-summary md:p-4">
      @foreach ((wp_get_post_terms($post->ID, 'inspiration-localisation')) as $item)
        <p class="w-fit text-xs py-1 px-2 m-1 me-8">📍{{$item->name}}</p>
      @endforeach
        <h3 class="entry-title text-base font-bold md:text-lg">
          <a href="{{ get_permalink() }}">
            {!! $title !!}
          </a>
        </h3>
        {{ the_excerpt() }}
    </div>
  </article>