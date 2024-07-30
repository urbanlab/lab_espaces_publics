import L from 'leaflet';
import 'leaflet/dist/leaflet.css';

export function MapLeaflet() {
  function getStatutColor(statutName) {
    const statut = window.statuts.find((s) => s.name === statutName);
    return statut ? statut.color : '#000000';
  }
  try {
    if (
      typeof window.projects === 'undefined' ||
      window.projects.length === 0
    ) {
      console.log('No projects found or projects is undefined.');
      return;
    }

    const map = L.map('map').setView([45.75, 4.85], 13);

    if (!map) {
      console.error('Failed to initialize the map');
      return;
    }

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      attribution:
        '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    }).addTo(map);

    let openMarker = null;

    window.projects.forEach((project) => {
      if (project.latitude && project.longitude) {
        const color = getStatutColor(project.statuts);
        const markerIcon = L.divIcon({
          className: 'custom-marker',
          html: `<div style="background-color: ${color}; width: 25px; height: 25px; border-radius: 50%;"></div>`,
        });

        const marker = L.marker([project.latitude, project.longitude], {
          icon: markerIcon,
        }).addTo(map);

        marker.bindPopup(project.simple_popup);

        marker.on('mouseover', function () {
          if (openMarker !== this) {
            this.setPopupContent(project.simple_popup);
            this.openPopup();
          }
        });

        marker.on('mouseout', function () {
          if (openMarker !== this) {
            this.closePopup();
          }
        });

        marker.on('click', function () {
          if (openMarker === this) {
            this.closePopup();
            openMarker = null;
          } else {
            this.setPopupContent(project.detailed_popup);
            this.openPopup();
            openMarker = this;
          }
        });
      } else {
        console.warn(
          `Project "${project.title}" does not have valid coordinates.`,
        );
      }
    });
    // Ajuster la taille de la carte après le chargement
    setTimeout(() => {
      map.invalidateSize();
    }, 200);
  } catch (error) {
    console.error('Error initializing the map:', error);
  }
}
// export function fetchPostsAndAddMarkers(map) {
//   fetch(labeps.ajax_url, {
//     method: 'POST',
//     headers: {
//       'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8',
//     },
//     body: new URLSearchParams({
//       action: 'filter_posts',
//       nonce: labeps.nonce,
//       content_type: 'commune', // Modifier selon votre type de post
//       page_number: 1,
//     }),
//   })
//     .then((response) => response.json())
//     .then((data) => {
//       if (data.success) {
//         data.locations.forEach((location) => {
//           const {latitude, longitude, title} = location;
//           if (latitude && longitude) {
//             L.marker([latitude, longitude])
//               .addTo(map)
//               .bindPopup(`<b>${title}</b>`)
//               .openPopup();
//           }
//         });
//       } else {
//         console.error('Erreur lors de la récupération des communes:', data);
//       }
//     })
//     .catch((error) => console.error('Erreur AJAX :', error));
// }
