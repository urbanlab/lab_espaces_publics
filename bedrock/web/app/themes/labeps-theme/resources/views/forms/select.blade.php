<section class="bg-secondary  p-4">
    <div class="container mx-auto flex justify-around items-center flex-wrap">
      @include('forms.search')
      @foreach($taxonomy_terms as $taxonomy => $terms)
        <select id="taxonomy-select" class="my-2 border border-black rounded-md" data-taxonomy="{{ $taxonomy }}" >
          <option value="all">
            @switch($taxonomy)
            @case('defis')
            Défis
                @break
            @case('localisation')
            Localisations
                @break
            @case('mots-clés')
                Mots clés
                @break
            @default
        @endswitch ()
          </option>
          @foreach($terms as $term)
          <option value="{{ $term->slug }}" id="term-{{ $term->slug }}">{{ $term->name }}</option>
          @endforeach
        </select>
      @endforeach
    </div>
  </section>