@extends('layouts.app')

@section('content')
  @include('partials.page-header')
  @include('partials.hero',[
  'pageIntro' => 'Parmi les actions clés identifiées dans la charte, certaines ont une dimension innovante : elles pourront être expérimentées dans le cadre de « projets pilotes », menés par les maîtres d’ouvrage sur le domaine public métropolitain. Le choix des projets pilotes tendra à couvrir les six défis de la Charte et sera fonction de leurs calendriers d’avancement.'])
  @if (! have_posts())
  <x-alert type="warning">
    {!! __('Sorry, no results were found.', 'sage') !!}
  </x-alert>

  {!! get_search_form(false) !!}
  @endif
  <div class="bg-secondary p-4 flex justify-around items-center flex-wrap">
    @include('forms.search')
      @foreach($taxonomy_terms as $taxonomy => $terms)
        <select id="taxonomy-select" class="my-2 border border-black rounded-md" data-taxonomy="{{ $taxonomy }}" >
          <option value="all">{{ $taxonomy }}</option>
          @foreach($terms as $term)
          <option value="{{ $term->slug }}" id="term-{{ $term->slug }}">{{ $term->name }}</option>
          @endforeach
        </select>
      @endforeach
  </div>
  <div id="ajax-results" class="grid grid-cols-4 gap-4 my-4 max-sm:grid-cols-none">
    @while(have_posts()) @php(the_post())
    @php($defis_terms = get_the_terms(get_the_ID(), 'projects-defis'))
    @php($localisation_terms = get_the_terms(get_the_ID(), 'projects-localisation'))
    @php($mots_cles_terms = get_the_terms(get_the_ID(), 'projects-mots-clés'))

    <div class="single-post
        @if($defis_terms) @foreach($defis_terms as $term) term-projects-defis-{{ $term->slug }} @endforeach @endif
        @if($localisation_terms) @foreach($localisation_terms as $term) term-projects-localisation-{{ $term->slug }} @endforeach @endif
        @if($mots_cles_terms) @foreach($mots_cles_terms as $term) term-projects-mots-clés-{{ $term->slug }} @endforeach @endif
    ">
        @includeFirst(['partials.content-' . get_post_type(), 'partials.content-localisation'])
    </div>
   @endwhile
  </div>


  {!! get_the_posts_navigation() !!}
  @endsection

@section('sidebar')
  @include('sections.sidebar')
@endsection