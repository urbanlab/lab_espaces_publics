@extends('layouts.app')

@section('content')
@include('partials.page-header')
@include('partials.hero',[
'pageIntro' => 'Pour améliorer la qualité de vie dans les villes et les espaces publics, le Lab des espaces publics met à votre 
disposition divers guides techniques, fiches thématiques (focus sur une thématique de la Charte des espaces publics) et fiches réflex (doctrines internes à la Métropole en matière d’aménagement de voirie et d’espace public).'])
@if (! have_posts())
<x-alert type="warning">
  {!! __('Sorry, no results were found.', 'labeps-theme') !!}
</x-alert>

{!! get_search_form(false) !!}
@endif
@include('forms.checkbox', ['taxonomies' => $taxonomies, 'cpt' => $cpt])
<section class="container mx-auto my-4">
  <div id="results-container" class="flex flex-col md:grid md:grid-cols-2 lg:grid-cols-3 content-stretch gap-3">
    @while(have_posts()) @php(the_post())
    @php($post_terms = get_the_terms(get_the_ID(), 'types'))
      @include('partials.content-ressources', ['post' => get_post()])
  @endwhile
  </div>
  <div id="pagination-container" class="self-end">
    {!! the_posts_pagination() !!}
  </div>
</section>

@endsection

@section('sidebar')
  @include('sections.sidebar')
@endsection
