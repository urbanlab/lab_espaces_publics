<section class="container mx-auto my-10">
  <div class="flex items-start py-8">
    <figure class="flex-none hidden lg:flex mr-4 ">
      {{-- <img src="@asset('images/picto-hero.svg')" alt="Picto Lab" class="object-contain"/> --}}
      @svg('images.picto-hero')
    </figure>
    <div class="shrink w-3/4">
      <h2 class="text-2xl md:text-3xl font-bold	">{!! $title !!}</h2>
      <p>{!! isset($pageIntro) ? $pageIntro : "" !!}</p>
    </div> 
  </div>    
</section>