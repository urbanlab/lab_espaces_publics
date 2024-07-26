import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

export function MapLeaflet() {
  const mapView = document.getElementById('map');
  if (!mapView) {
    console.error('Map view not found');
    return;
  }

  const map = L.map('map').setView([48.8566, 2.3522], 13); // Centre sur Paris par défaut

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution:
      '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
  }).addTo(map);

  // Exemple de marqueur, vous pouvez ajouter vos propres marqueurs ici
  L.marker([48.8566, 2.3522])
    .addTo(map)
    .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
    .openPopup();

  // Pour centrer la carte sur les marqueurs existants lorsque la vue "Map" est activée
  document
    .getElementById('map-view-button')
    .addEventListener('click', function () {
      setTimeout(function () {
        map.invalidateSize();
      }, 200);
    });
}

export function fetchPostsAndAddMarkers(map) {
  fetch(labeps.ajax_url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
    },
    body: new URLSearchParams({
      action: 'filter_posts',
      nonce: labeps.nonce,
      content_type: 'commune', // Modifier selon votre type de post
      page_number: 1,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        data.locations.forEach((location) => {
          const {latitude, longitude, title} = location;
          if (latitude && longitude) {
            L.marker([latitude, longitude])
              .addTo(map)
              .bindPopup(`<b>${title}</b>`)
              .openPopup();
          }
        });
      } else {
        console.error('Erreur lors de la récupération des communes:', data);
      }
    })
    .catch((error) => console.error('Erreur AJAX :', error));
}
