<section class="wp-block-group container mx-auto my-10">
  <div class="actualite-hero flex">
    <figure class="wp-block-image">
      <img src="@asset('images/picto-hero.svg')" alt="Picto Lab" class=""/>
    </figure>
    <div class="block-heading-text w-8/12 md:w-auto">
      <h1 class="">{!! $title !!}</h1>
      <p class="w-fit">{!! isset($pageIntro) ? $pageIntro : "" !!}</p>
    </div> 
  </div>    
</section>