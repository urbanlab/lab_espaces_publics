<section class="bg-secondary  p-4">
    <div class="container mx-auto flex justify-around items-center flex-wrap">
      <form id="filters">
        @foreach($taxonomies as $name => $taxonomy)
        @php
          $taxonomyObj = get_taxonomy($name);
          $taxonomyLabel = !empty($taxonomyObj->labels->singular_name) ? $taxonomyObj->labels->singular_name : ucfirst($name);
        @endphp
          @if($taxonomy['hierarchical'])
                <select name="{{ $name }}" class="my-2 border w-full md:size-auto border-black rounded-md">
                    <option value="">{{ $taxonomyLabel }}</option>
                    @foreach($taxonomy['terms'] as $term)
                        <option value="{{ $term->slug }}">{{ $term->name }}</option>
                    @endforeach
                </select>
          @endif
        @endforeach
      </form>
    </div>
  </section>