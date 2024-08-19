@extends('layouts.app')

@section('content')
  @include('partials.page-header')
  @include('partials.hero',[
  'pageIntro' => 'Les inspirations du Lab des espaces publics sont des fiches
synthétiques de projets innovants réalisés en France et à l’étranger.'])
  @if (! have_posts())
  <x-alert type="warning">
    {!! __('Sorry, no results were found.', 'labeps-theme') !!}
  </x-alert>

  {!! get_search_form(false) !!}
  
  @endif
  <div id="filter-overlay" class="fixed inset-0 bg-black opacity-50 hidden lg:hidden"></div>

  <section class="container mx-auto my-4">
    <div class="flex flex-col lg:flex-row">

      <x-button id="filter-button" text="{{ __('FILTRER', 'labeps-theme') }}" class=" w-1/3 text-black border-2 border-black rounded-md p-2 mb-4 lg:hidden" icon="fas fa-filter" />
      @include('forms.filter', ['taxonomies' => $taxonomies])
      <div id="results-container" class="flex flex-col md:grid md:grid-cols-1 lg:grid-cols-2 content-stretch gap-4 w-full">
        @while(have_posts()) @php(the_post())
          @include('partials.content-inspirations', ['post' => get_post()])
        @endwhile
      </div>
    </div>
    <div id="pagination-container" class="">
      {!! the_posts_pagination() !!}
    </div>
  </section>

@endsection