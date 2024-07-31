@extends('layouts.app')

@section('content')
  @include('partials.page-header')
  @include('partials.hero',[
    'pageIntro' => 'Les projets pilotes du Lab des espaces publics sont des projets exemplaires et innovants en lien avec
    les défis de la Charte des espaces publics. Ils ont été réalisés en maitrise d’ouvrage par la Métropole de Lyon,
    ou par ses partenaires maitres d’ouvrages œuvrant sur le périmètre géographique métropolitain.
    Vous retrouverez dans ces pages des éléments utiles détaillant les modalités de réalisation de ces projets pour faciliter
    leur réplicabilité (planning, budget, freins, leviers…).'])

  @if (! have_posts())
    <x-alert type="warning">
      {!! __('Sorry, no results were found.', 'labeps-theme') !!}
    </x-alert>
    {!! get_search_form(false) !!}
  @endif
  <div class="view-switcher">
    <div class="container mx-auto">
      <button id="list-view-button" class="active">List View</button>
      <button id="map-view-button">Map View</button>
    </div>
  </div>
  <section class="container mx-auto my-4">
    <div id="filter-overlay" class="fixed inset-0 bg-black opacity-50 hidden lg:hidden"></div>

    <div class="flex flex-col lg:flex-row">
      <x-button id="filter-button" text="{{ __('FILTRER', 'labeps-theme') }}" class=" w-1/3 text-black border-2 border-black rounded-md p-2 mb-4 lg:hidden" icon="fas fa-filter" />
      @include('forms.filter', ['taxonomies' => $taxonomies])
  
      <div id="list-view" class="view active md:w-3/4">
        <div id="results-container" class="flex flex-col md:grid md:grid-cols-1 lg:grid-cols-2 content-stretch gap-4 w-full">
          @while(have_posts()) @php(the_post())
            @include('partials.content-projects', ['post' => get_post()])
          @endwhile
        </div>
        <div id="pagination-container">
          {!! the_posts_pagination() !!}
        </div>
      </div>
      <div id="map-view" class="view md:w-3/4">
        <div id="map"></div>
        @if (!empty($projects))
        <script>
          window.projects = @json($projects);
          window.statuts = @json($statuts);

        </script>
      @else
        <p>Aucune commune trouvée.</p>
      @endif
      </div>
    </div>
    
  </section>
@endsection