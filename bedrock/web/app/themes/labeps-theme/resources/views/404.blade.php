@extends('layouts.app')

@section('content')
  @include('partials.page-header')

  <section class="container mx-auto my-4">
    <div class="wp-block-group actualite-hero header-background">
      <figure class="wp-block-image">
        <img src="@asset('images/archive-hero.svg')" alt="" class="wp-image-115"/>
      </figure>
      <div class="block-heading-text">
        <h1 class="wp-block-heading">404</h1>
      </div>        
    </div>
  
    @if (! have_posts())
      <div class="flex flex-wrap flex-col mx-auto">
        <h4 class="text-xl py-5">Vous êtes parti dans la mauvaise direction, cette page n'existe pas !</h4>
        <a href="{{ home_url('/') }}" class="flex justify-center">
          <button type="button" class="bg-secondary text-white text-lg w-1/4 rounded-md p-5">Revenez à l'accueil</button>
        </a>
      </div>
    @endif
  </section>

@endsection
