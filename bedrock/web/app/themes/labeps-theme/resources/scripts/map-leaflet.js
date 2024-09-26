import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

export function MapLeaflet() {
  const mapElement = document.getElementById('map');
  if (!mapElement) {
    console.error('Map element with ID "map" not found.');
    return;
  }

  const markerIcon = L.icon({
    iconSize: [25, 41],
    iconAnchor: [10, 41],
    popupAnchor: [2, -40],
    iconUrl: 'https://unpkg.com/leaflet@1.5.1/dist/images/marker-icon.png',
    shadowUrl: 'https://unpkg.com/leaflet@1.5.1/dist/images/marker-shadow.png',
  });

  const initialCommuneData = window.projects || [
    {
      title: 'Project Example',
      latitude: 45.75,
      longitude: 4.85,
      simple_popup: 'Simple popup content',
      detailed_popup: 'Detailed popup content',
      status: 'default',
    },
  ];

  console.log(initialCommuneData);

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

  setTimeout(function () {
    try {
      map.invalidateSize();
    } catch (error) {
      console.error('Error invalidating map size:', error);
    }
  }, 100);

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
    if (markers.length > 0) {
      markers.forEach((marker) => {
        try {
          map.removeLayer(marker);
        } catch (error) {
          console.error('Error removing marker:', error);
        }
      });
    }
    markers = [];
    console.log(projects);
    projects.forEach(function (project) {
      if (project.latitude && project.longitude) {
        try {
          const marker = L.marker([project.latitude, project.longitude], {
            icon: markerIcon,
            draggable: true,
          }).addTo(map);
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

  updateMap(initialCommuneData);

  document.addEventListener('projectsUpdated', function (e) {
    updateMap(e.detail.projects);
  });
}
