@extends('layouts.app')

@section('content')
    @include('partials.page-header')
    @include(
        'partials.hero',
        [
            'title' => 'Inspirations',
            'pageIntro' => 'Les inspirations du Lab des espaces publics sont des fiches synthétiques de projets innovants réalisés en France et à l’étranger.'
        ]
    )
    <x-filterable-archive :taxonomies="$taxonomies">
        <x-grid columnClasses="grid-cols-1 md:grid-cols-2">
            @while(have_posts())
                @php(the_post())
                @include('partials.content-inspirations', ['post' => get_post()])
            @endwhile
        </x-grid>
    </x-filterable-archive>
@endsection
