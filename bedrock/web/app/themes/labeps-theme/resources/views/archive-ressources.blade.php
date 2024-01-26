@extends('layouts.app')

@section('content')
@include('partials.page-header')
@include('partials.hero',[
'pageIntro' => 'Le Lab des espaces publics est une source d’inspiration pour améliorer la qualité de vie dans les villes et les espaces publics. 
En travaillant ensemble pour expérimenter, innover et collaborer, nous pouvons créer des espaces publics plus inclusifs, durables et adaptés aux besoins des usagers.'])
@if (! have_posts())
<x-alert type="warning">
  {!! __('Sorry, no results were found.', 'sage') !!}
</x-alert>

{!! get_search_form(false) !!}
@endif
@include('forms.checkbox')
<div id="ajax-results" class="container mx-auto grid grid-cols-4 gap-4 my-4 max-sm:grid-cols-none">
  @while(have_posts()) @php(the_post())
    @php($post_terms = get_the_terms(get_the_ID(), 'types'))
    <div class="single-post term-{{ $post_terms ? $post_terms[0]->slug : '' }}">
      @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
    </div>     
  @endwhile
</div>
  {!! get_the_posts_navigation() !!}
@endsection

@section('sidebar')
  @include('sections.sidebar')
@endsection
