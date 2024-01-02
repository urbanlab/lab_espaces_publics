<article @php(post_class('h-entry'))>
  <x-breadcrumb />
  <header>
    <figure class="rounded-md w-full h-40">
      {!!get_the_post_thumbnail()!!}
    </figure>
    <h1 class="p-name">
      {!! $title !!}
    </h1>

    @include('partials.entry-meta')
  </header>

  <div class="e-content">
    @php(the_content())
  </div>

  <footer>
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
  </footer>

  @php(comments_template())
</article>
