@if ($query->have_posts())
    @while ($query->have_posts()) @php($query->the_post())
      @includeFirst(['partials.content-' . get_post_type(), 'partials.content'], ['post' => get_post()])
    @endwhile
@else
    <p>Aucun post trouvé.</p>
@endif