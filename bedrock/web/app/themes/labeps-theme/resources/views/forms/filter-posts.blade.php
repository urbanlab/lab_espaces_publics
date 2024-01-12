  <div>
    <form method="GET">
        @php(
            $taxonomies = get_object_taxonomies( 'ressources' )
        )
    
        @php($terms = get_terms(array(
        'taxonomy' => $taxonomies,
        'hide_empty' => false,)))
    
        @foreach ($terms as $term)
    
        {{-- @php(var_dump($term)) --}}
    
        <label>
            <input
              type="checkbox"
              name="{!!$term->name!!}"
              value="{!!$term->slug!!}"
              @php(checked(
                (isset($_GET['ressources']) && in_array($term->slug, $_GET['ressources']))
              ))
            />
            {!!$term->name!!}
          </label>
    
            
        @endforeach
    
    
        <button type="submit">Apply</button>
      </form>
  </div>
  