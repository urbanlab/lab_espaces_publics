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
      handleFormChange(1); // Remet à la première page lors d'un changement de filtre
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

        if (data && data.success) {
          container.innerHTML = data.data.html;

          // Trigger custom event to update the map
          const event = new CustomEvent('projectsUpdated', {
            detail: {projects: data.data.projects},
          });
          document.dispatchEvent(event);
        } else {
          container.innerHTML = '<h3>Aucun post trouvé.</h3>';

          // Trigger custom event to clear the map
          const event = new CustomEvent('projectsUpdated', {
            detail: {projects: []},
          });
          document.dispatchEvent(event);
        }
      })
      .catch((error) => console.error('Erreur AJAX :', error));
  }
}
