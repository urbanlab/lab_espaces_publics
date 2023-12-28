<section class="bg-secondary w-full p-36">
    <h2 class="text-white font-bold text-xl md:text-2xl">À la une</h2>
    @php
    $category_query = new WP_Query('category_name=evenements&posts_per_page=1');
    @endphp
    @if ($category_query->have_posts())
    <div class="slick-carousel">
      @while ($category_query->have_posts()) @php($category_query->the_post())
        <div class="carousel-item flex flex-col bg-white p-4 my-6 border rounded-md md:flex-row @php(get_post_class())">
            <figure class="rounded-md md:w-3/4">
                {!!get_the_post_thumbnail()!!}
              </figure>
              <div class="entry-summary md:p-4">
                @include('partials.entry-meta')
            <h3 class="text-base font-bold md:text-lg">
                {!! get_the_title() !!}
             </h3>
          {!! the_excerpt() !!}
              </div>
        </div>
      @endwhile
      {!!the_posts_navigation()!!}
    </div>
    @php(wp_reset_postdata())
  @else
    <p>{{ __('No articles found') }}</p>
  @endif
</section>
