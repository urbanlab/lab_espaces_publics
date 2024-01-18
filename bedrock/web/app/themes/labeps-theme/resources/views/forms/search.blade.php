<form role="search" method="get" class="search-form" action="{{ home_url('/') }}">
  <label>
    <span class="sr-only">
      {{ _x('Search for:', 'label', 'sage') }}
    </span>

    <input
      type="search"
      placeholder="{!! esc_attr_x('Rechercher &hellip;', 'placeholder', 'sage') !!}"
      value="{{ get_search_query() }}"
      name="s"
      class="bg-white p-2 border rounded-md border-black"
    >
  </label>

  <button class="loupe">{{ _x('⚲', 'submit button', 'sage') }}</button>
</form>
