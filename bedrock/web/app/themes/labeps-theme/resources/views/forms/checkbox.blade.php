<section class="bg-secondary p-4">
      <form id="filters" action="#" method="POST" class="container mx-auto flex justify-around items-center flex-wrap">
        <input type="hidden" name="content_type" value="{{$cpt}}">
        @php
          wp_nonce_field('filter_posts_nonce', 'filter_posts_nonce_field');
        @endphp
        @if($cpt === 'ressources' && isset($taxonomies['types']))
          @php
            $taxonomy = $taxonomies['types'];
          @endphp
            @foreach($taxonomy['terms'] as $term)
              <label for="{{ $term->slug }}" class="bg-white p-2 m-2 border rounded-md border-black">
                <input type="checkbox" name="types[]" value="{{ $term->slug }}"> {{ $term->name }}
              </label>
            @endforeach
        @endif
      </form>
  </section>