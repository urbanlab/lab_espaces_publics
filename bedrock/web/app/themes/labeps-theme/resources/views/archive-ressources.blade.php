@extends('layouts.app')

@section('content')
    @include('partials.page-header')
    @include('partials.hero',[
    'title' => 'Boite à outils',
    'pageIntro' => 'Pour améliorer la qualité de vie dans les villes et les espaces publics, le Lab des espaces publics met à votre
    disposition divers guides techniques, fiches thématiques (focus sur une thématique de la Charte des espaces publics) et fiches réflex (doctrines internes à la Métropole en matière d’aménagement de voirie et d’espace public).'])
    @if (! have_posts())
        <x-alert type="warning">
            {!! __('Sorry, no results were found.', 'labeps-theme') !!}
        </x-alert>

        {!! get_search_form(false) !!}
    @endif
    <section class="container mx-auto my-4">
        <div id="filter-overlay" class="fixed inset-0 bg-black opacity-50 hidden lg:hidden"></div>

        <div class="flex flex-col lg:flex-row">
            <x-button id="filter-button" text="{{ __('FILTRER', 'labeps-theme') }}"
                      class=" w-1/3 text-black border-2 border-black rounded-md p-2 mb-4 lg:hidden"
                      icon="fas fa-filter"/>
            @include('forms.filter', ['taxonomies' => $taxonomies])
            <div id="results-container"
                 class="flex flex-col mx-auto md:grid md:grid-cols-1 lg:grid-cols-2 content-stretch gap-4 w-full">
                @while(have_posts())
                    @php(the_post())
                    @php($post_terms = get_the_terms(get_the_ID(), 'types'))
                    @include('partials.content-ressources', ['post' => get_post()])
                @endwhile
            </div>
        </div>
        <div id="pagination-container" class="self-end">
            {!! the_posts_pagination(array('class' => 'list-none')) !!}
        </div>
    </section>

@endsection

@section('sidebar')
    @include('sections.sidebar')
@endsection
