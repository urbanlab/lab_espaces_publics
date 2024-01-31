<article @php(post_class('h-entry single-post'))>
  <header class="hero-single">
    <x-breadcrumb/>
    <figure class="flex w-screen h-[40vh] md:h-96">
      {{the_post_thumbnail('full')}}   
     </figure>
  </header>
  <div class="e-content container mx-auto mb-10">
    <div class="heading-single z-10">
      <h1 class="pl-8 pb-6 md:pb-9 text-xl md:text-3xl leading-7 md:leading-[3.5rem] font-bold text-balance">
        {!! $title !!}
      </h1>
    </div>
    <section class="lg:mt-24">
      @include('partials.entry-meta')
      @php(the_content())
    </section>
    {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']) !!}
  </div>
</article>