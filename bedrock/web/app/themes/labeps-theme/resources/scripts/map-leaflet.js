import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

let map;
let markers = [];

export function MapLeaflet() {
  try {
    console.log('Initializing MapLeaflet...');
    const mapElement = document.getElementById('map');
    if (!mapElement) {
      console.error('Map element not found');
      return;
    }

    if (
      typeof window.projects === 'undefined' ||
      window.projects.length === 0
    ) {
      console.log('No projects found or projects is undefined.');
      return;
    }

    if (!map) {
      map = L.map('map').setView([45.75, 4.85], 13);
      console.log('Map initialized');
    }

    if (!map) {
      console.error('Failed to initialize the map');
      return;
    }

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution:
        '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);

    console.log('Tile layer added');

    addMarkers(window.projects);

    setTimeout(() => {
      map.invalidateSize();
      console.log('Map size invalidated');
    }, 200);

    const observer = new MutationObserver(() => {
      map.invalidateSize();
      console.log('Map size invalidated by MutationObserver');
    });

    observer.observe(mapElement, {
      attributes: true,
      attributeFilter: ['style', 'class'],
    });
  } catch (error) {
    console.error('Error initializing the map:', error);
  }
}

export function addMarkers(projects) {
  if (!map) {
    console.error('Map is not initialized');
    return;
  }

  clearMarkers(); // Videz les anciens marqueurs

  console.log('Adding markers for projects:', projects);

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
  if (!map) {
    console.error('Map is not initialized');
    return;
  }

  markers.forEach((marker) => map.removeLayer(marker));
  markers = [];
}
