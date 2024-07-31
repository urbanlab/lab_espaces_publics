import {UpdateTags} from './filters/updateTags';
import {addMarkers, clearMarkers} from './map-leaflet';

export function callAjax(page = 1) {
  const form = document.getElementById('taxonomy-filter-form');
  if (!form) {
    console.error('Form not found');
    return;
  }
  const checkboxes = form.querySelectorAll('input[type="checkbox"]');

  checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
      handleFormChange(page);
    });
  });

  // Initial update to handle pre-checked boxes
  handleFormChange(page);
  UpdateTags(checkboxes);

  function handleFormChange(page) {
    const formData = new FormData(form);
    formData.append('action', 'filter_posts');
    formData.append('nonce', labeps.nonce);
    formData.append('page_number', page);

    fetch(labeps.ajax_url, {
      method: 'POST',
      body: new URLSearchParams(formData),
      credentials: 'same-origin',
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error('Réponse réseau non OK');
        }
        return response.json();
      })
      .then((data) => {
        const container = document.getElementById('results-container');
        const paginationContainer = document.getElementById(
          'pagination-container',
        );
        if (data && data.success) {
          container.innerHTML = data.data.html;
          paginationContainer.innerHTML = data.data.pagination;

          if (data.data.projects) {
            clearMarkers(); // Videz les anciens marqueurs
            addMarkers(data.data.projects); // Met à jour les marqueurs sur la carte
          }
        } else {
          container.innerHTML =
            '<p>Aucun projet trouvé pour les filtres sélectionnés.</p>';
          paginationContainer.innerHTML = '';

          clearMarkers(); // Videz les marqueurs de la carte
        }
      })
      .catch((error) => console.error('Erreur AJAX :', error));
  }
}
