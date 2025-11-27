<a href="{{ get_permalink() }}">
    <article id="post-{{ get_the_ID() }}" class="post card self-stretch @php(get_post_class()) h-full">
        <figure>
            {!!get_the_post_thumbnail()!!}
        </figure>
        <div class="entry-summary md:p-4">
            @if (isset($tags))
                {!! $tags !!}
            @endif
            <h3 class="entry-title text-base! leading-7 py-1! font-bold! lg:text-lg! break-words">
                {!! $title !!}
            </h3>
            @if (isset($content))
                {!! $content !!}
            @endif
        </div>
    </article>
</a>
