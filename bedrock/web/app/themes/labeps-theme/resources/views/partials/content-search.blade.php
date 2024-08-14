  <article @php(post_class())>
    <header>
      <h2 class="entry-title text-black text-xl">
        <a href="{{ get_permalink() }}">
          {!! $title !!}
        </a>
      </h2>

      @includeWhen(get_post_type() === 'post', 'partials.entry-meta')
    </header>

    <div class="entry-summary">
      <p>{{the_excerpt()}}</p>
    </div>
  </article>
