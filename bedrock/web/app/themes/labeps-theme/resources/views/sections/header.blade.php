<header class="banner sticky top-0 border-b border-black bg-white z-20">
  <div class="flex max-sm:flex-wrap justify-between sm:h-20 p-4 md:py-0  md:items-center">
    <a class="brand hidden sm:flex" href="{{ home_url('/') }}">
      @svg('images.logo_labdesEP')
    </a>
  
    <button data-collapse-toggle="navbar-hamburger" type="button" class="inline-flex items-center justify-center p-2 w-10 h-10 text-sm text-black focus:outline-none focus:ring-2 focus:ring-primary dark:text-gray-400 dark:focus:ring-primary md:hidden" aria-controls="navbar-hamburger" aria-expanded="false">
      <span class="sr-only">Open main menu</span>
      <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
      </svg>
    </button>

    <x-navigation />

    <figure>
      @svg('images.logo-metro')
    </figure>
  </div>

</header>