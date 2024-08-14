import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

export function MapLeaflet() {
  console.log('Initializing MapLeaflet...');

  const mapElement = document.getElementById('map');
  if (!mapElement) {
    console.error('Map element with ID "map" not found.');
    return;
  }
  console.log('Map element found:', mapElement);

  // Tester avec des données par défaut si window.projects est undefined
  const initialCommuneData = window.projects || [
    {
      title: 'Project Example',
      latitude: 45.75,
      longitude: 4.85,
      simple_popup: 'Simple popup content',
      detailed_popup: 'Detailed popup content',
    },
  ];
  console.log('Initial commune data:', initialCommuneData);

  if (initialCommuneData.length === 0) {
    console.log('No projects found or projects is undefined.');
    return;
  }

  let map;
  try {
    map = L.map(mapElement).setView([45.75, 4.85], 11);
    console.log('Map initialized with view set.');
  } catch (error) {
    console.error('Error initializing map:', error);
    return;
  }

  setTimeout(function () {
    console.log('Invalidating map size...');
    map.invalidateSize();
  }, 100);

  try {
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution:
        '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);
    console.log('Tile layer added to the map.');
  } catch (error) {
    console.error('Error adding tile layer to map:', error);
  }

  let markers = [];

  function updateMap(projects) {
    console.log('Updating map with new projects:', projects);

    if (markers.length > 0) {
      console.log('Removing existing markers...');
      markers.forEach((marker) => map.removeLayer(marker));
    }
    markers = [];

    projects.forEach(function (project) {
      if (project.latitude && project.longitude) {
        try {
          const marker = L.marker([project.latitude, project.longitude]).addTo(
            map,
          );
          marker.bindTooltip(project.simple_popup);
          marker.bindPopup(project.detailed_popup);
          markers.push(marker);
          console.log(`Marker added for project: ${project.title}`);
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

  // Initial map update
  console.log('Initial map update with commune data...');
  updateMap(initialCommuneData);

  document.addEventListener('projectsUpdated', function (e) {
    console.log('projectsUpdated event detected:', e.detail.projects);
    updateMap(e.detail.projects);
  });
}
