<section class="bg-secondary h-[600px] w-full p-8">
  <h2 class="text-white font-bold text-xl my-4 md:text-2xl">À la une</h2>
  <div id="default-carousel" class="relative w-full" data-carousel="static">
  <div class="relative h-96 overflow-hidden rounded-lg md:h-80 md:w-[60vw] md:m-auto">
    @if (have_posts())
       @php(
       $the_query = new WP_Query(array(
        'category_name' => 'a-la-une', 
        'order' => 'DESC'  
        ))) 
       @while($the_query->have_posts()) @php($the_query->the_post())
      <div class="hidden duration-700 ease-in-out" data-carousel-item>
        <div class="flex flex-col w-full bg-white p-4 border rounded-md md:flex-row md:h-80 ">
          <figure class="rounded-md self-center w-full h-40 md:w-1/2">
            <?php the_post_thumbnail('large');?>
          </figure>
          <div class="carousel-caption md:p-4 md:w-1/2 overflow-hidden">
            @include('partials.entry-meta')
            <h3 class="text-base font-bold md:text-lg">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h4>
            <?php the_excerpt();?>
          </div>
        </div>
      </div>      
      @endwhile
      @php(wp_reset_postdata())
      @else
        <p>{{ __('No articles found') }}</p>
      @endif
  </div>
  <div class="absolute z-30 flex translate-y-14 -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
      <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
      <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
      <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
      <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
      <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
  </div>
  <button type="button" class="absolute -top-10 -left-20 start-0 z-30 hidden md:flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
      <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
          <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
          </svg>
          <span class="sr-only">Previous</span>
      </span>
  </button>
  <button type="button" class="absolute hidden -top-10 -right-20 end-0 z-30 md:flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
      <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
          <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
          </svg>
          <span class="sr-only">Next</span>
      </span>
  </button>
  </div>
</section>