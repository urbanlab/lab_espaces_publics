@extends('layouts.app')

@section('content')
    @include('partials.page-header')
    @include(
        'partials.hero',
        [
            'title' => 'Recherche',
            'pageIntro' => 'Résultats de votre recherche pour : ' . request()->get('s')
        ]
    )
    <section class="container mx-auto">
        <x-grid>
            @while(have_posts())
                @php(the_post())
                @include('partials.content-search', ['post' => get_post()])
            @endwhile
        </x-grid>
    </section>
@endsection
