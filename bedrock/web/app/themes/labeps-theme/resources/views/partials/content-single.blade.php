<article @php(post_class('h-entry single-post'))>
  <header class="hero-single">
    <x-breadcrumb/>
    <figure class="flex md:h-96">
      {{the_post_thumbnail('full')}}   
     </figure>
  </header>
  <div class="e-content container mx-auto">
      {{-- <figure class="icon-background relative">
        <img src="@asset('images/icon-single.svg'))" alt="icon article metropole">
      </figure> --}}
      <h1 class="leading-10 text-balance text-2xl md:text-3xl lg:pt-8 font-bold md:leading-[3.5rem]">
        {!! $title !!}
      </h1>

    <section class="lg:mt-24">
      @include('partials.entry-meta')
      @php(the_content())
    </section>
  </div>

  <footer>
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
  </footer>

  @php(comments_template())
</article>