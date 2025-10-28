<section class="wp-block-theme-hero wp-block-group container mx-auto my-10">
  <div class="block-hero flex items-start py-8">
    <figure class="wp-block-image">
      @svg('resources.images.picto-hero')
    </figure>
    <div class="block-heading-text shrink w-3/4">
      <h2 class="text-2xl md:text-3xl font-bold	">{!! $title !!}</h2>
      <p>{!! isset($pageIntro) ? $pageIntro : "" !!}</p>
    </div>
  </div>
</section>
