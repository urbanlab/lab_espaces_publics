@dd($attributes)
<section class="hero" style="background-image: url('{{ $attributes['backgroundImage'] }}')">
  <h1>{!! $attributes['title'] !!}</h1>
  <p>{!! $attributes['content'] !!}</p>
</section>