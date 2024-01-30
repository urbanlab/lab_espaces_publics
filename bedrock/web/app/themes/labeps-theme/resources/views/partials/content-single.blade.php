<article @php(post_class('h-entry single-post'))>
  <header class="hero-single">
    <x-breadcrumb/>
    <figure class="flex h-[40vh] md:h-96">
      {{the_post_thumbnail('full')}}   
     </figure>
  </header>
  <div class="e-content container mx-auto mt-36 md:mt-64 lg:mt-72">
    <div class="absolute top-80 md:top-[21rem]">
      <figure class="icon-hero-single w-80 md:w-full">
        <img src="@asset('images/icon-single.svg'))" alt="icon article metropole" class="relative z-10">
      </figure>
      <h1 class="absolute top-36 md:top-48 lg:top-40 left-16 md:left-20 leading-7 w-3/4 md:w-full text-balance text-xl md:text-3xl lg:pt-8 font-bold md:leading-[3.5rem]">
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