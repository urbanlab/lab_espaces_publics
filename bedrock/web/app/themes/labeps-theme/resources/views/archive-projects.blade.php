@extends('layouts.app')

@section('content')
  @include('partials.page-header')
  @include('partials.hero',[
    'pageIntro' => 'Les projets pilotes du Lab des espaces publics sont des projets exemplaires et innovants en lien avec
    les défis de la Charte des espaces publics. Ils ont été réalisés en maitrise d’ouvrage par la Métropole de Lyon,
    ou par ses partenaires maitres d’ouvrages œuvrant sur le périmètre géographique métropolitain.
    Vous retrouverez dans ces pages des éléments utiles détaillant les modalités de réalisation de ces projets pour faciliter
    leur réplicabilité (planning, budget, freins, leviers…).'])

  @if (! have_posts())
    <x-alert type="warning">
      {!! __('Sorry, no results were found.', 'labeps-theme') !!}
    </x-alert>
    {!! get_search_form(false) !!}
  @endif

  <section class="container mx-auto my-4">
    <div id="filter-overlay" class="fixed inset-0 bg-black opacity-50 hidden lg:hidden"></div>

    <div class="view-switcher">
      <button id="list-view-button" class="active">List View</button>
      <button id="map-view-button" >Map View</button>
    </div>

    <div class="flex flex-col lg:flex-row">
      <x-button id="filter-button" text="{{ __('FILTRER', 'labeps-theme') }}" class=" w-1/3 text-black border-2 border-black rounded-md p-2 mb-4 lg:hidden" icon="fas fa-filter" />
      @include('forms.filter', ['taxonomies' => $taxonomies])
  
      <div id="list-view" class="view active md:w-3/4">
        <div id="results-container" class="flex flex-col md:grid md:grid-cols-1 lg:grid-cols-2 content-stretch gap-4 w-full">
          @while(have_posts()) @php(the_post())
            @include('partials.content-projects', ['post' => get_post()])
          @endwhile
        </div>
        <div id="pagination-container">
          {!! the_posts_pagination() !!}
        </div>
      </div>
      <div id="map-view" class="view md:w-3/4">
        <div id="map" style="width: 100%; height: 600px;"></div>
      </div>
    </div>
    
  </section>
@endsection

@section('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
  var mapViewButton = document.getElementById('map-view-button');
  var listViewButton = document.getElementById('list-view-button');
  var mapView = document.getElementById('map-view');
  var listView = document.getElementById('list-view');

  mapViewButton.addEventListener('click', function () {
    mapView.style.display = 'block';
    listView.style.display = 'none';
    // Adjust the map size and position
    setTimeout(function() {
      map.invalidateSize();
    }, 10);
  });

  listViewButton.addEventListener('click', function () {
    mapView.style.display = 'none';
    listView.style.display = 'block';
  });

  var map = L.map('map-view').setView([51.505, -0.09], 13);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  var markers = [];
  function updateMap(locations) {
    markers.forEach(function(marker) {
      map.removeLayer(marker);
    });

    markers = locations.map(function(location) {
      var marker = L.marker([location.latitude, location.longitude]).addTo(map);
      marker.bindPopup('<b>' + location.title + '</b><br>' + location.description).openPopup();
      return marker;
    });
  }

  // Fetch locations initially
  updateMap(@json($locations));

  document.getElementById('filters').addEventListener('submit', function (event) {
    event.preventDefault();
    var xhr = new XMLHttpRequest();
    var formData = new FormData(event.target);
    formData.append('action', 'filter_posts');
    formData.append('nonce', '{{ wp_create_nonce("filter_posts_nonce") }}');

    xhr.open('POST', '{{ admin_url("admin-ajax.php") }}', true);

    xhr.onload = function () {
      if (xhr.status >= 200 && xhr.status < 400) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          document.getElementById('results-container').innerHTML = response.data.html;
          document.getElementById('pagination-container').innerHTML = response.data.pagination;
          updateMap(response.data.locations);
        } else {
          console.error(response.data);
        }
      }
    };
    xhr.send(formData);
  });
});
  </script>
@endsection
