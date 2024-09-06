<article id="post-{{ get_the_ID() }}" class='card flex flex-col content-center bg-white @php(get_post_class())'>
    <a href="{{ get_permalink() }}">
      <figure class="w-full me-8 md:me-2 h-40">
        {!!the_post_thumbnail('thumbnail', array('class' => ''))!!}
      </figure>
    </a>
    <div class="entry-summary md:p-4">
      @foreach ((wp_get_post_terms($post->ID, 'types')) as $item)
        <p class="bg-secondary text-white w-fit text-xs py-1 px-2 m-1 rounded-md me-8">{{$item->name}}</p>
      @endforeach
        <h3 class="entry-title text-base leading-7 p-1 font-bold lg:text-lg">
          <a href="{{ get_permalink() }}">
            {!! $title !!}
          </a>
        </h3>
      
    </div>
  </article>