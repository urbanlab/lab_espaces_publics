import 'leaflet/dist/leaflet.css';
import L from 'leaflet';

export function MapLeaflet() {
  const mapElement = document.getElementById('map');
  const initialCommuneData = window.projects;

  if (
    typeof initialCommuneData === 'undefined' ||
    initialCommuneData.length === 0
  ) {
    console.log('No projects found or projects is undefined.');
    return;
  }

  const map = L.map(mapElement).setView([45.75, 4.85], 11);

  setTimeout(function () {
    map.invalidateSize();
  }, 100);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution:
      '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
  }).addTo(map);

  let markers = [];

  function updateMap(projects) {
    // Remove existing markers
    markers.forEach((marker) => map.removeLayer(marker));
    markers = [];

    // Add new markers
    projects.forEach(function (project) {
      if (project.latitude && project.longitude) {
        const marker = L.marker([project.latitude, project.longitude]).addTo(
          map,
        );
        marker.bindTooltip(project.simple_popup);
        marker.bindPopup(project.detailed_popup);
        markers.push(marker);
      } else {
        console.warn(
          `Project "${project.title}" does not have valid coordinates.`,
        );
      }
    });
  }

  // Initial map update
  updateMap(initialCommuneData);

  // Listen for custom event to update the map
  document.addEventListener('projectsUpdated', function (e) {
    updateMap(e.detail.projects);
  });
}
