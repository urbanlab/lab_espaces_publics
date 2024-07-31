<?php

namespace App\Providers;

use Roots\Acorn\Sage\SageServiceProvider;
class ThemeServiceProvider extends SageServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();


        add_filter('nav_menu_css_class', [$this, 'addActiveClassToCptMenu'], 10, 2);


    }

    public function addActiveClassToCptMenu($classes, $item)
    {
        if (is_singular('your_cpt_slug') || is_post_type_archive('your_cpt_slug')) {
            $cpt_archive_link = get_post_type_archive_link('your_cpt_slug');

            if (trim($item->url, '/') === trim($cpt_archive_link, '/')) {
                $classes[] = 'current_page_item'; // Ajoutez la classe si cela correspond
            }
        }

        return $classes;
    }
}
