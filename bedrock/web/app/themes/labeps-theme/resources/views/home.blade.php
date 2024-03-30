@extends('layouts.app')

@section('content')

@include('partials.page-header')

  @include('partials.hero',[
    'pageIntro' => 'Retrouvez toutes les actus du Lab : organisation d’évènements, publication de nouveaux outils, informations sur l’accompagnement des projets pilotes…'])
  @include('components.loop-posts')
  <section class="container mx-auto">
    <h2 class="text-primary py-5 text-xl md:text-2xl font-bold">Dernières actus</h2>
    @if (! have_posts())
      <x-alert type="warning">
        {!! __('Désolé le contenu que vous cherchez n\'est pas ici.', 'labeps-theme') !!}
      </x-alert>
      {!! get_search_form(false) !!}
    @endif
  
    @while(have_posts()) @php(the_post())
      @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
    @endwhile
  
    <div id="pagination-container" class="self-end">
      {!! the_posts_pagination() !!}
    </div>  @endsection
  
  </section>

@section('sidebar')
  @include('sections.sidebar')
@endsection
