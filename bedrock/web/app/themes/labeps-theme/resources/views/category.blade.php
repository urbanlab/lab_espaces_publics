@extends('layouts.app')

@section('content')
    @include('partials.page-header')
    @include(
        'partials.hero',
        [
            'title' => single_cat_title('', false),
            'pageIntro' => strip_tags(category_description()) ?: 'Articles de la catégorie ' . single_cat_title('', false),
        ]
    )
    <section class="container mx-auto">
        @if (! have_posts())
            <x-alert type="warning">
                {!! __('Désolé le contenu que vous cherchez n\'est pas ici.', 'labeps-theme') !!}
            </x-alert>
            {!! get_search_form(false) !!}
        @endif

        <x-grid>
            @while(have_posts())
                @php(the_post())
                @include('partials.content-search', ['post' => get_post()])
            @endwhile
        </x-grid>

        <div id="pagination-container" class="self-end">
            {!! get_the_posts_navigation() !!}
        </div>
    </section>
@endsection
