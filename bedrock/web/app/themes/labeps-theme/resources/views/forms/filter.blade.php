<aside id="filters-menu" class="filters slide-in pt-6 lg:static lg:translate-x-0 lg:flex-col lg:w-1/3 px-6 lg:max z-10">
<h4 class="bold text-lg">Filtrer par :</h4>
<div id="selected-filters" class="flex flex-wrap gap-2 mb-4"></div>

<form method="POST" action="#" id="taxonomy-filter-form" class="space-y-4 lg:overflow-y-auto lg:max-h-96">
    @php
        wp_nonce_field('filter_posts_nonce', 'filter_posts_nonce_field');
        $post_type = get_post_type();
        $taxonomies = get_object_taxonomies($post_type, 'objects');
        $current_taxonomies = request()->input('filter_taxonomies', []);
    @endphp

<input type="hidden" name="action" value="filter_posts">
<input type="hidden" name="nonce" value="{{ wp_create_nonce('filter_posts_nonce') }}">
<input type="hidden" name="content_type" value="{{ $post_type }}">
<button type="button" id="close-filter-menu" class="absolute top-2 right-2 text-gray-600 lg:hidden">
    <i class="fas fa-times"></i>
</button>
    @foreach ($taxonomies as $taxonomy)
    <div>
        <button type="button" class="accordion flex justify-between w-full text-base text-left py-2 px-4 border-b border-black focus:outline-none">
            {{ $taxonomy->labels->name }}
            <i class="fas fa-chevron-right"></i>
        </button>
        <div class="panel px-4 py-2 hidden">
            @php
                $terms = get_terms(['taxonomy' => $taxonomy->name,'parent' => 0, 'hide_empty' => true, 'update_term_meta_cache' => false]);
            @endphp

            @if (!empty($terms) && !is_wp_error($terms))
                @foreach ($terms as $term)
                @php
                    $colors = [
                        'Projet terminé' => 'bg-blue-600',
                        'Projet en cours'=> 'bg-orange-600',
                        'Projet évalué' => 'bg-green-500',
                    ];

                    $color = isset($colors[$term->name]) ? $colors[$term->name] : 'text-black';
                @endphp
                    <label class="block">
                        <input type="checkbox" name="{{ $taxonomy->name }}" value="{{ esc_attr($term->slug) }}" {{ in_array($term->slug, $current_taxonomies) ? 'checked' : '' }} class="mr-2 {{ $color }}">
                        {{ $term->name }}
                    </label>

                @endforeach
            @endif
        </div>
    </div>
    @endforeach
</form>
</aside>
