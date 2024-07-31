<article @php(post_class('h-entry single-post'))>
  <header class="hero-single">
    <x-breadcrumb/>
    <figure class="flex w-screen h-[40vh] md:h-96">
      {{the_post_thumbnail('full')}}   
     </figure>
  </header>
  <div class="e-content container mx-auto mb-10">
    <div class="heading-single flex items-start py-8">
      <figure class="hidden lg:flex mr-4">
        @svg('images.icon-hero-single')
      </figure>
      <h2 class="text-xl md:text-3xl leading-7 md:leading-[3.5rem] font-bold">
        {!! $title !!}
      </h2>
    </div>
    <section>
      @include('partials.entry-meta')
      @php(the_content())
    </section>
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'labeps-theme'), 'after' => '</p></nav>']) !!}
  </div>
</article>