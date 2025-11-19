<article id="post-{{ get_the_ID() }}" class="post card self-stretch @php(get_post_class())">
  <a href="{{ get_permalink() }}">
    <figure>
      {!!get_the_post_thumbnail()!!}
    </figure>
    <div class="entry-summary md:p-4">
      <h3 class="entry-title text-base! leading-7 py-1! font-bold! lg:text-lg! break-words">
        {!! $title !!}
      </h3>
      @foreach ((wp_get_post_terms($post->ID, 'localisation-inspiration')) as $item)
        <p class="w-fit text-xs py-1 px-2 m-1 me-8">📍{{$item->name}}</p>
      @endforeach
        <p>{{the_excerpt()}}</p>
    </div>
  </a>
</article>
