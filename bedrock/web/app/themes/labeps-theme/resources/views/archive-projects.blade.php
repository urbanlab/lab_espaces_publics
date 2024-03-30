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
    {!! __('Sorry, no results were found.', 'sage') !!}
  </x-alert>

  {!! get_search_form(false) !!}
  @endif
  @include('forms.select', ['taxonomies' => $taxonomies, 'cpt' => $cpt])
  <section class="container mx-auto my-4">
    <div id="results-container" class="flex flex-col md:grid md:grid-cols-2 lg:grid-cols-3 content-stretch gap-3">
        @while(have_posts()) @php(the_post())
          @include('partials.content-projects', ['post' => get_post()])
        @endwhile
    </div>
        <div id="pagination-container">
          {!! the_posts_pagination() !!}
        </div>    
      </section>
  @endsection

@section('sidebar')
  @include('sections.sidebar')
@endsection