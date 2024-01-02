<header class="banner flex h-screen sm:h-20 p-5 justify-between items-center border-b border-black">
  <a class="brand hidden sm:flex" href="{{ home_url('/') }}">
    <img src="@asset('images/logo-labeps.png'))" alt="Logo Lab espace public">
  </a>

  <button data-collapse-toggle="navbar-hamburger" type="button" class="inline-flex items-center justify-center p-2 w-10 h-10 text-sm text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600 md:hidden" aria-controls="navbar-hamburger" aria-expanded="false">
    <span class="sr-only">Open main menu</span>
    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
    </svg>
  </button>

  @if (has_nav_menu('primary_navigation'))
    <nav class="nav-primary w-full hidden md:flex text-lg font-bold" id="navbar-hamburger" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
      {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'echo' => false]) !!}
    </nav>
  @endif
  {!! get_custom_logo() !!}
</header>