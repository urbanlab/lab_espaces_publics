<section id="taxonomy-checkboxes" class="bg-secondary p-4">
    <div class="container mx-auto flex justify-around items-center flex-wrap">
      @foreach ($taxonomy_terms['types'] as $term)
          <label for="category-{{ $term->slug }}" class="bg-white p-2 m-2 border rounded-md border-black">
              <input type="checkbox" id="category-{{ $term->slug }}" value="{{ $term->slug }}">
              {{ $term->name }}
            </label>
      @endforeach
    </div>
  </section>