@extends('layouts.app')

@section('content')
  @include('partials.page-header')
  @include('partials.hero',[
  'pageIntro' => 'Les inspirations du Lab des espaces publics sont des fiches
synthétiques de projets innovants réalisés en France et à l’étranger.'])
  @if (! have_posts())
  <x-alert type="warning">
    {!! __('Sorry, no results were found.', 'labeps') !!}
  </x-alert>

  {!! get_search_form(false) !!}
  
  @endif
    @include('forms.select', ['taxonomies' => $taxonomies, 'cpt' => $cpt])
  <section class="container mx-auto my-4">
    <div id="results-container" class="flex flex-col md:grid md:grid-cols-2 lg:grid-cols-3 content-stretch gap-3">
      @while(have_posts()) @php(the_post())
        @include('partials.content-inspirations', ['post' => get_post()])
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