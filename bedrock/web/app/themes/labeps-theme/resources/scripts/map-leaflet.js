import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

let map;
let markers = [];

export function MapLeaflet() {
  try {
    if (
      typeof window.projects === 'undefined' ||
      window.projects.length === 0
    ) {
      console.log('No projects found or projects is undefined.');
      return;
    }

    map = L.map('map').setView([45.75, 4.85], 13);

    if (!map) {
      console.error('Failed to initialize the map');
      return;
    }

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution:
        '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);

    addMarkers(window.projects);

    setTimeout(() => {
      map.invalidateSize();
    }, 200);

    const observer = new MutationObserver(() => {
      map.invalidateSize();
    });

    observer.observe(document.getElementById('map-view'), {
      attributes: true,
      attributeFilter: ['style', 'class'],
    });
  } catch (error) {
    console.error('Error initializing the map:', error);
  }
}

export function addMarkers(projects) {
  clearMarkers();

  const bounds = [];

  projects.forEach((project) => {
    if (project.latitude && project.longitude) {
      const marker = L.marker([project.latitude, project.longitude]).addTo(map);
      markers.push(marker);

      marker.bindPopup(project.simple_popup);

      marker.on('mouseover', function () {
        this.setPopupContent(project.simple_popup);
        this.openPopup();
      });

      marker.on('mouseout', function () {
        this.closePopup();
      });

      marker.on('click', function () {
        this.setPopupContent(project.detailed_popup);
        this.openPopup();
      });

      bounds.push([project.latitude, project.longitude]);
    } else {
      console.warn(
        `Project "${project.title}" does not have valid coordinates.`,
      );
    }
  });

  if (bounds.length > 0) {
    setTimeout(() => {
      map.fitBounds(bounds); // Ajuste la vue de la carte pour inclure tous les marqueurs
      map.invalidateSize(); // Force la carte à vérifier ses dimensions
    }, 200);
  }
}

export function clearMarkers() {
  markers.forEach((marker) => map.removeLayer(marker));
  markers = [];
}
