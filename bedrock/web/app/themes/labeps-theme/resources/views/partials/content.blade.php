<article @php(post_class())>
  <header>
    @if((has_post_thumbnail( $post->ID ) ))
    @php(get_the_post_thumbnail($post->ID, 'medium'))
    @php(get_the_post_thumbnail_url($post->ID, 'medium'))
    <img src="@php(get_the_post_thumbnail_url($post->ID, 'medium'))" alt="">
    @endif
    
    <h2 class="entry-title">
      <a href="{{ get_permalink() }}">
        {!! $title !!}
      </a>
    </h2>
    <ul>
      @foreach ((get_the_category()) as $item)
      <li> {{$item->name}}</li>
      @endforeach
    </ul>

    @include('partials.entry-meta')
  </header>

  <div class="entry-summary">
    @php(the_excerpt())
  </div>
</article>
