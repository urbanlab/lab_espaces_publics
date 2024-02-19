<section id="taxonomy-checkboxes" class="bg-secondary p-4">
    <div class="container mx-auto flex justify-around items-center flex-wrap">
      <form id="filters">
      @if($cpt === 'ressources' && isset($taxonomies['types']))
        @php
          $taxonomy = $taxonomies['types'];
        @endphp
          @foreach($taxonomy['terms'] as $term)
            <label>
              <input type="checkbox" name="types[]" value="{{ $term->slug }}"> {{ $term->name }}
            </label>
          @endforeach
      @endif
      </form>
    </div>
  </section>