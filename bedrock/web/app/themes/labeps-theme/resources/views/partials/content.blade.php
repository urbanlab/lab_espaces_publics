<article class='card flex flex-col bg-white p-4 my-6 md:flex-row @php(get_post_class())'>
  <figure class="size-auto">
    {!!get_the_post_thumbnail()!!}
  </figure>
  <div class="entry-summary md:p-4">
    <header>
      @include('partials.entry-meta')
      <h3 class="entry-title text-base leading-6 font-bold lg:text-lg">
        <a href="{{ get_permalink() }}">
          {!! $title !!}
        </a>
      </h3>
    </header>
    {{the_excerpt()}}
  </div>
</article>
