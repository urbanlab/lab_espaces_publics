  <section class="container mx-auto my-10">
    <div class="flex items-start py-8">
      <div class="flex-none hidden lg:flex mr-4">
        @svg('resources.images.picto-hero')
      </div>
      <div class="block-heading-text shrink w-3/4">
        <h1 class="text-2xl md:text-3xl font-bold	">{!! $title !!}</h1>
        <p>{!! isset($pageIntro) ? $pageIntro : "" !!}</p>
      </div>
    </div>
  </section>
