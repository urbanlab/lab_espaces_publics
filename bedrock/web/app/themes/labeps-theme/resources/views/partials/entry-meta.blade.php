<ul class="entry-meta flex flex-wrap my-2 justify-normal">
  @foreach ((get_the_category()) as $item)
  <li class="bg-secondary text-white p-2 rounded-md me-8"> {{$item->name}}</li>
  @endforeach
  <li class="bg-grey text-white p-2 rounded-md">
    <time class="dt-published" datetime="{{ get_post_time('c', true) }}">
      {{ get_the_date() }}
    </time>
  </li>
</ul>


