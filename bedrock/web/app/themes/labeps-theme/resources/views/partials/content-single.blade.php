<article @php(post_class('h-entry single-post'))>
  <header class="hero-single mb-10">
    <x-breadcrumb/>
    <div class="relative">
      <figure class="rounded-md w-full md:h-96">
        {{the_post_thumbnail()}}   
       </figure>
       <img src="@asset('images/icon-single.svg'))" alt="icon article metropole" class="absolute top-32 md:top-56 lg:top-48 w-4/6 md:w-6/12 lg:w-5/12">
    </div>
      <h1 class="relative z-10 pl-12 md:pl-20 lg:pl-28 lg:pt-3 mb-12 text-2xl md:text-3xl font-bold text-wrap md:leading-[3.5rem]">
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

{{-- relative left-16 -top-20 md:-top-28 lg:-top-32 md:left-20
  relative left-16 -top-20 md:-top-28 lg:-top-32 md:left-20 --}}