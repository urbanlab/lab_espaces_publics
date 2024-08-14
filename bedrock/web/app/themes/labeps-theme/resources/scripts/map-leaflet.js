import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

export function MapLeaflet() {
  const mapElement = document.getElementById('map');
  if (!mapElement) {
    console.error('Map element with ID "map" not found.');
    return;
  }

  const initialCommuneData = window.projects || [];
  if (initialCommuneData.length === 0) {
    console.warn('No projects found or projects is undefined.');
    return;
  }

  let map;
  try {
    map = L.map(mapElement).setView([45.75, 4.85], 11);
  } catch (error) {
    console.error('Error initializing map:', error);
    return;
  }

  // Forcer la réinitialisation de la taille de la carte après un délai
  setTimeout(function () {
    map.invalidateSize();
  }, 1000);

  // Réinitialiser la taille de la carte après un redimensionnement de la fenêtre
  window.addEventListener('resize', function () {
    map.invalidateSize();
  });

  // Assurer la réinitialisation de la taille lorsque la carte est prête
  map.whenReady(function () {
    map.invalidateSize();
  });

  try {
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution:
        '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);
  } catch (error) {
    console.error('Error adding tile layer to map:', error);
  }

  let markers = [];

  function updateMap(projects) {
    // Retirer les anciens marqueurs
    if (markers.length > 0) {
      markers.forEach((marker) => map.removeLayer(marker));
    }
    markers = [];

    // Ajouter de nouveaux marqueurs
    projects.forEach(function (project) {
      if (project.latitude && project.longitude) {
        try {
          const marker = L.marker([project.latitude, project.longitude]).addTo(
            map,
          );
          marker.bindTooltip(project.simple_popup);
          marker.bindPopup(project.detailed_popup);
          markers.push(marker);
        } catch (error) {
          console.error(
            `Error adding marker for project: ${project.title}`,
            error,
          );
        }
      } else {
        console.warn(
          `Project "${project.title}" does not have valid coordinates.`,
        );
      }
    });
  }

  // Mise à jour initiale de la carte
  updateMap(initialCommuneData);

  // Mettre à jour la carte lorsque l'événement custom est déclenché
  document.addEventListener('projectsUpdated', function (e) {
    updateMap(e.detail.projects);
  });
}
