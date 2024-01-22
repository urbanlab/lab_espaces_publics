<article class='card @php(get_post_class())'>
    <figure>
      {!!get_the_post_thumbnail()!!}
    </figure>
    <div class="entry-summary md:p-4">
      @foreach ((wp_get_post_terms($post->ID, 'localisation')) as $item)
        <p class="w-fit text-xs py-1 px-2 m-1 me-8">📍{{$item->name}}</p>
      @endforeach
        <h3 class="entry-title text-base font-bold md:text-lg">
          <a href="{{ get_permalink() }}">
            {!! $title !!}
          </a>
        </h3>
        <p class="truncate">{{get_the_excerpt()}}</p>
    </div>
  </article>