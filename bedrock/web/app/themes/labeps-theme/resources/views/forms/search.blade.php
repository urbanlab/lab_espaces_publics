<form role="search" method="get" class="search-form" action="{{ home_url('/') }}">
    <input
        type="search"
        placeholder="{!! esc_attr_x('Rechercher &hellip;', 'placeholder', 'labeps-theme') !!}"
        value="{{ get_search_query() }}"
        name="s"
    >
    <button
        type="submit"
        aria-label="{{ esc_attr_x('Rechercher', 'submit button', 'labeps-theme') }}"
    >
        @svg('resources.images.search-icon', 'w-5 h-5')
    </button>
</form>
