@php
    use Carbon\Carbon;

    $date = Carbon::createFromFormat('Y-m-d', get_field('event_datetime'))->locale('fr_FR');
@endphp

<article @php(post_class('h-entry single-post'))>
    <header class="hero-single">
        <x-breadcrumb/>
        <figure class="flex w-screen h-[40vh] md:h-96">
            {{the_post_thumbnail('full')}}
        </figure>
    </header>
    <div class="e-content container mx-auto mb-10">
        <div class="heading-single flex items-start py-8 gap-4">
            <figure class="hidden lg:flex mr-4">
                @svg('resources.images.icon-hero-single')
            </figure>
            <h1 class="text-xl md:text-3xl leading-7 md:leading-[3.5rem] font-bold">
                {!! $title !!}
            </h1>
        </div>
        <section>
            <div class="ms-[10%] mb-10">
                <div class="entry-meta flex flex-wrap gap-2">
                    <div class="bg-grey tags list-none">
                        <time class="dt-published" datetime="{{$date->format('Y-m-d')}}">
                            {{$date->isoFormat('Do MMM Y')}}
                        </time>
                    </div>
                    @foreach ((wp_get_post_terms($post->ID, 'commune')) as $item)
                        <div class="bg-grey tags list-none">{{$item->name}}</div>
                    @endforeach
                </div>
                <div class="flex flex-wrap gap-2">
                    @foreach ((wp_get_post_terms($post->ID, 'motscles')) as $item)
                        <div class="bg-primary text-white font-bold px-4 text-[20px]">{{$item->name}}</div>
                    @endforeach
                </div>
            </div>
            {{the_content()}}
        </section>
        {!! wp_link_pages(['echo' => 0, 'before' => '<nav class="page-nav"><p>' . __('Pages:', 'labeps-theme'), 'after' => '</p></nav>']) !!}
    </div>
</article>
