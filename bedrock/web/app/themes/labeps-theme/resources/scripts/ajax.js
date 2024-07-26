import {UpdateTags} from './filters/updateTags';

export function callAjax(page = 1) {
  const form = document.getElementById('taxonomy-filter-form');
  if (!form) {
    console.error('Form not found');
    return;
  }
  const checkboxes = form.querySelectorAll('input[type="checkbox"]');

  checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
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
          } else {
            container.innerHTML =
              '<p>Aucun projet trouvé pour les filtres sélectionnés.</p>';
            paginationContainer.innerHTML = '';
          }
        })
        .catch((error) => console.error('Erreur AJAX :', error));

      UpdateTags(checkboxes);
    });
  });
  // Initial update to handle pre-checked boxes
  UpdateTags(checkboxes);
}
