<section class="wp-block-group container mx-auto my-10">
  <div class="actualite-hero flex items-start">
    <figure class="wp-block-image">
      <img src="@asset('images/picto-hero.svg')" alt="Picto Lab" class="hidden md:flex"/>
    </figure>
    <div class="block-heading-text w-8/12 md:w-auto">
      <h2 class="text-2xl md:text-3xl font-bold	">{!! $title !!}</h2>
      <p class="w-fit">{!! isset($pageIntro) ? $pageIntro : "" !!}</p>
    </div> 
  </div>    
</section>