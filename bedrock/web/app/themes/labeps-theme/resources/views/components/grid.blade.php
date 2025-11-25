@if (! have_posts())
    <x-alert type="warning">
        {!! __('Aucun résultat ne répond à votre recherche.', 'labeps-theme') !!}
    </x-alert>
@endif

<div>
    <div id="results-container" class="grid {{$columnClasses}} gap-4">
        {{$slot}}
    </div>
    <div id="pagination-container">
        {!! the_posts_pagination(array('class' => 'list-none')) !!}
    </div>
</div>
