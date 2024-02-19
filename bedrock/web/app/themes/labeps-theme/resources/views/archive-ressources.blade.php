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
@include('forms.checkbox', ['taxonomies' => $taxonomies, 'cpt' => $cpt])
<section id="ajax-results" class="container mx-auto my-4">
  <div class="flex flex-col md:grid md:grid-cols-2 lg:grid-cols-3 content-stretch gap-3">
    @while(have_posts()) @php(the_post())
    @php($post_terms = get_the_terms(get_the_ID(), 'types'))
    <div class="single-post flex flex-wrap break-words term-{{ $post_terms ? $post_terms[0]->slug : '' }}">
      @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
    </div>     
  @endwhile
  </div>
  {!! the_posts_pagination() !!}
</section>
@endsection

@section('sidebar')
  @include('sections.sidebar')
@endsection
