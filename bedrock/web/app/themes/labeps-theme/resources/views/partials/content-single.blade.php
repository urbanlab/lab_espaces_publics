<article @php(post_class('h-entry single-post'))>
  <header class="hero-single mb-10">
    <x-breadcrumb/>
    <div class="relative">
      <figure class="flex md:h-96">
        {{the_post_thumbnail('full')}}   
       </figure>
      </div>
  </header>
  <div class="e-content container mx-auto">
    <img src="@asset('images/icon-single.svg'))" alt="icon article metropole" class="absolute w-11/12 top-60 md:w-3/5 md:top-80 lg:w-1/2 xl:w-1/3 lg:top-72">
    <h1 class="relative z-10 left-20 top-0 -inset-6 text-balance md:pl-7 mb-12 text-2xl md:text-3xl font-bold md:leading-[3.5rem]">
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