<form role="search" method="get" class="search-form" action="{{ home_url('/') }}">
  <label>
    <span class="sr-only">
      {{ _x('Recherche pour:', 'label', 'labeps-theme') }}
    </span>

    <input
      type="search"
      placeholder="{!! esc_attr_x('Rechercher &hellip;', 'placeholder', 'labeps-theme') !!}"
      value="{{ get_search_query() }}"
      name="s"
      class="bg-white p-2 border rounded-md border-black"
    >
  </label>

  <button class="loupe">{{ _x('⚲', 'submit button', 'labeps-theme') }}</button>
</form>
