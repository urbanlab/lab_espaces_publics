@extends('layouts.app')

@section('content')

  <div id="map-view" style="height: 500px;"></div>
  <div id="list-view" style="display: none;">
    {{-- <div id="list-content">
      @foreach ($locations as $location)
        <div class="list-item">
          <h3>{{ $location->title }}</h3>
          <p>{{ $location->description }}</p>
        </div>
      @endforeach
    </div> --}}
    <div id="pagination">
      {{ the_posts_pagination(['mid_size' => 2, 'prev_text' => __('Retour', 'textdomain'), 'next_text' => __('Suivant', 'textdomain')]) }}
    </div>
  </div>
@endsection

@section('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function () {
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

      document.getElementById('map-view-button').addEventListener('click', function () {
        document.getElementById('map-view').style.display = 'block';
        document.getElementById('list-view').style.display = 'none';
      });

      document.getElementById('list-view-button').addEventListener('click', function () {
        document.getElementById('map-view').style.display = 'none';
        document.getElementById('list-view').style.display = 'block';
      });

      document.getElementById('filters').addEventListener('submit', function (event) {
        event.preventDefault();
        var xhr = new XMLHttpRequest();
        var formData = new FormData(event.target);
        formData.append('action', 'filter_posts');
        formData.append('nonce', '<?php echo wp_create_nonce("filter_posts_nonce"); ?>');

        xhr.open('POST', '<?php echo admin_url("admin-ajax.php"); ?>', true);
        xhr.onload = function () {
          if (xhr.status >= 200 && xhr.status < 400) {
            var response = JSON.parse(xhr.responseText);
            if (response.success) {
              document.getElementById('list-content').innerHTML = response.data.html;
              document.getElementById('pagination').innerHTML = response.data.pagination;
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