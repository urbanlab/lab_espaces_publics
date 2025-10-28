<ul class="entry-meta flex flex-wrap my-2 justify-normal ml-0">
    @foreach ((get_the_category()) as $item)
        <li class="bg-secondary text-white text-xs py-1 px-2 m-1 rounded-md list-none"> {{$item->name}}</li>
    @endforeach
    <li class="bg-grey text-white text-xs py-1 px-2 m-1 rounded-md list-none">
        <time class="dt-published" datetime="{{ get_post_time('c', true) }}">
            {{ get_the_date() }}
        </time>
    </li>
</ul>
