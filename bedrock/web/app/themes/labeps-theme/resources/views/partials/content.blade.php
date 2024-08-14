<article id="post-{{ get_the_ID() }}" class='card flex flex-col w-full bg-white p-4 my-6 md:flex-row @php(get_post_class())'>
  <a href="{{ get_permalink() }}" class="flex">
    <figure class="size-auto">
      {!!the_post_thumbnail('large', ['class' => 'img-rounded', 'title' => 'Feature image'])!!}
    </figure>
  </a>
  <div class="entry-summary md:p-4">
    <header>
      @include('partials.entry-meta')
      <h3 class="entry-title text-base leading-6 font-bold lg:text-lg">
        <a href="{{ get_permalink() }}">
          {!! $title !!}
        </a>
      </h3>
    </header>
    <p>{{the_excerpt()}}</p>
  </div>
</article>
