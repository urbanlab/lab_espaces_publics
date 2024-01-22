<article class='card flex flex-col bg-white p-4 my-6 md:flex-row @php(get_post_class())'>
  <figure class="h-40 md:w-1/2">
    {!!get_the_post_thumbnail()!!}
  </figure>
  <div class="entry-summary md:p-4">
    <header>
      @include('partials.entry-meta')
      <h3 class="entry-title text-base font-bold md:text-lg">
        <a href="{{ get_permalink() }}">
          {!! $title !!}
        </a>
      </h3>
    </header>
    <p class="truncate">{{get_the_excerpt()}}</p> 
  </div>
</article>
