<section class="bg-secondary p-4">
    <div class="container mx-auto flex justify-around items-center flex-wrap">
      <form id="filters" action="#" method="POST">
        @php
          wp_nonce_field('filter_posts_nonce', 'filter_posts_nonce_field');
        @endphp
        @foreach($taxonomies as $name => $taxonomy)
        <input type="hidden" name="content_type" value="{{$cpt}}">
        @php
          $taxonomyObj = get_taxonomy($name);
          $taxonomyLabel = !empty($taxonomyObj->labels->plural) ? $taxonomyObj->labels->plural : ucfirst($name);
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