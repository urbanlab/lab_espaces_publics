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
        console.log('Received AJAX response:', data);
        const container = document.getElementById('results-container');
        const paginationContainer = document.getElementById(
          'pagination-container',
        );
        if (data && data.success) {
          container.innerHTML = data.data.html;
          paginationContainer.innerHTML = data.data.pagination;

          console.log('Projects received:', data.data.projects);

          if (data.data.projects) {
            clearMarkers();
            addMarkers(data.data.projects);
          }
        } else {
          container.innerHTML =
            '<p>Aucun projet trouvé pour les filtres sélectionnés.</p>';
          paginationContainer.innerHTML = '';

          console.log('No projects found'); // Log en cas d'absence de projets
          clearMarkers(); // Videz les marqueurs de la carte
        }
      })
      .catch((error) => console.error('Erreur AJAX :', error));
  }
}
