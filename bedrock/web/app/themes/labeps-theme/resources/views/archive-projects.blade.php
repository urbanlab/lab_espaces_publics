@extends('layouts.app')

@section('content')
    @include('partials.page-header')
    @include(
        'partials.hero',
        [
            'title' => 'Projets pilotes',
            'pageIntro' => 'Les projets pilotes du Lab des espaces publics sont des projets exemplaires et innovants en lien avec
            les défis de la Charte des espaces publics. Ils ont été réalisés en maitrise d’ouvrage par la Métropole de Lyon,
            ou par ses partenaires maitres d’ouvrages œuvrant sur le périmètre géographique métropolitain.
            Vous retrouverez dans ces pages des éléments utiles détaillant les modalités de réalisation de ces projets pour faciliter
            leur réplicabilité (planning, budget, freins, leviers…).'
        ]
    )

    <div class="view-switcher">
        <div class="container mx-auto">
            <button id="map-view-button" class="active">Vue Carte</button>
            <button id="list-view-button">Vue Liste</button>
        </div>
    </div>
    <x-filterable-archive :taxonomies="$taxonomies">
        <div id="list-view" class="view">
            <x-grid columnClasses="grid-cols-1 md:grid-cols-2">
                @while(have_posts())
                    @php(the_post())
                    @include('partials.content-projects', ['post' => get_post()])
                @endwhile
            </x-grid>
        </div>
        <div id="map-view" class="view active z-0">
            <div id="map"></div>
            @if (!empty($projects))
                <script>
                    window.projects = @json($projects);
                    window.statuts = @json($statuts);
                </script>
            @endif
        </div>
    </x-filterable-archive>
@endsection
