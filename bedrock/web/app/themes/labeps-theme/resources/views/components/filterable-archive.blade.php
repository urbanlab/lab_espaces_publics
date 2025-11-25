<section class="container mx-auto my-4">
    <div id="filter-overlay" class="fixed inset-0 bg-black opacity-50 hidden lg:hidden"></div>
    <x-button
        id="filter-button" text="{{ __('FILTRER', 'labeps-theme') }}"
        class="w-1/3 text-black border-2 border-black rounded-md p-2 mb-4 lg:hidden"
        icon="fas fa-filter"
    />
    <div class="flex flex-col lg:flex-row">
        @include('forms.filter', ['taxonomies' => $taxonomies])
        {{$slot}}
    </div>
</section>
