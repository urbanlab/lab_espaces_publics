@extends('layouts.app')

@section('content')
    @include('partials.page-header')
    @include('partials.hero')
    <section class="container mx-auto my-4">
        @if (! have_posts())
            <x-alert type="warning">
                {!! __('Sorry, no results were found.', 'labeps-theme') !!}
            </x-alert>

            {!! get_search_form(false) !!}
        @endif

        @while(have_posts()) @php(the_post())
        @include('partials.content-search')
        @endwhile

        {!! the_posts_pagination() !!}
    </section>
@endsection
