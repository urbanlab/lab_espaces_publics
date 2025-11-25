@extends('layouts.app')

@section('content')
    @include('partials.page-header')
    @include(
        'partials.hero',
        [
            'title' => 'Boite à outils',
            'pageIntro' => 'Pour améliorer la qualité de vie dans les villes et les espaces publics, le Lab des espaces publics met à votre
            disposition divers guides techniques, fiches thématiques (focus sur une thématique de la Charte des espaces publics) et fiches réflex (doctrines internes à la Métropole en matière d’aménagement de voirie et d’espace public).'
        ]
    )
    <x-filterable-archive :taxonomies="$taxonomies">
        <x-grid columnClasses="grid-cols-1 md:grid-cols-2">
            @while(have_posts())
                @php(the_post())
                @php($post_terms = get_the_terms(get_the_ID(), 'types'))
                @include('partials.content-ressources', ['post' => get_post()])
            @endwhile
        </x-grid>
    </x-filterable-archive>
@endsection

@section('sidebar')
    @include('sections.sidebar')
@endsection
