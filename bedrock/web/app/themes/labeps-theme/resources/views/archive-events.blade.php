@extends('layouts.app')

@section('content')
    @include('partials.page-header')
    @include(
        'partials.hero',
        [
            'title' => 'Événements',
            'pageIntro' => 'Les événéments du Lab des espaces publics.'
        ]
    )
    <x-filterable-archive :taxonomies="$taxonomies">
        <x-grid columnClasses="grid-cols-1 md:grid-cols-2">
            @while(have_posts())
                @php(the_post())
                @include('partials.content-events', ['post' => get_post()])
            @endwhile
        </x-grid>
    </x-filterable-archive>
@endsection
