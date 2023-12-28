<article class='flex flex-col bg-white p-4 my-6 border rounded-md md:flex-row @php(get_post_class())'>
  <figure class="rounded-md md:w-3/4">
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
    @php(the_excerpt())
  </div>
</article>
