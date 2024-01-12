<article @php(post_class('h-entry single-post'))>
  <header class="h-fit">
    <x-breadcrumb/>
    <figure class="rounded-md w-full h-96">
     {{the_post_thumbnail()}}
    </figure>
    <div class="flex flex-col relative -top-52 md:-top-40">
      <img src="@asset('images/icon-single.svg'))" alt="icon article metropole" class=" bg-white p-7 w-5/6 md:w-6/12 lg:w-5/12">
      <h1 class="relative left-24 -top-28 md:-top-28 lg:-top-36 md:left-28 text-2xl md:text-3xl font-bold text-wrap w-6/12 md:leading-[3.5rem]">
        {!! $title !!}
      </h1>
    </div>


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
