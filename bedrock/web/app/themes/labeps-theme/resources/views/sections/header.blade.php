<header class="banner flex">
  <a class="brand" href="{{ home_url('/') }}">
    <img src="<?= get_template_directory_uri(); ?>/public/images/logo-labeps.png" alt="Logo Lab espace public">
  </a>

  @if (has_nav_menu('primary_navigation'))
    <nav class="nav-primary" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
      {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'echo' => false]) !!}
    </nav>
  @endif
  {!! get_custom_logo() !!}
</header>
