@extends('layouts.app')

@section('content')

@include('partials.page-header')

  <x-hero/>
  @include('partials.category')
  <h2 class="text-primary py-5 text-xl md:text-2xl font-bold">Dernières actus</h2>
  @if (! have_posts())
    <x-alert type="warning">
      {!! __('Sorry, no results were found.', 'sage') !!}
    </x-alert>

    {!! get_search_form(false) !!}
  @endif

  @while(have_posts()) @php(the_post())
    @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
  @endwhile

  {!! get_the_posts_navigation() !!}
@endsection

@section('sidebar')
  @include('sections.sidebar')
@endsection
