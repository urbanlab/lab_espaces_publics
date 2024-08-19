import {UpdateTags} from './filters/updateTags';
import {attachPaginationListeners} from './pagnination';

export function callAjax(page = 1) {
  const form = document.getElementById('taxonomy-filter-form');
  if (!form) {
    console.error('Form not found');
    return;
  }

  const checkboxes = form.querySelectorAll('input[type="checkbox"]');

  checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
      handleFormChange(1); // Remet à la première page lors d'un changement de filtre
    });
  });

  handleFormChange(page);
  UpdateTags(checkboxes);

  function handleFormChange(page) {
    const formData = new FormData(form);
    formData.append('action', 'filter_posts');
    formData.append('nonce', labeps.nonce);
    formData.append('paged', page);

    fetch(labeps.ajax_url, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
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

          // Attacher les gestionnaires d'événements aux nouveaux liens de pagination
          attachPaginationListeners();

          // Déclenche l'événement pour mettre à jour la carte
          const event = new CustomEvent('projectsUpdated', {
            detail: {projects: data.data.projects},
          });
          document.dispatchEvent(event);
        } else {
          container.innerHTML = '<h3>Aucun post trouvé.</h3>';
          paginationContainer.innerHTML = '';

          // Déclenche l'événement pour vider la carte
          const event = new CustomEvent('projectsUpdated', {
            detail: {projects: []},
          });
          document.dispatchEvent(event);
        }
      })
      .catch((error) => console.error('Erreur AJAX :', error));
  }
}
