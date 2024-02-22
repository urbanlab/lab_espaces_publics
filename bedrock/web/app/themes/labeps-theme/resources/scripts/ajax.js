export function callAjax(page = 1) {
  const filtersForm = document.getElementById('filters');

  filtersForm.addEventListener('change', function () {
    const formData = new FormData(filtersForm);
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
        if (data && data.success) {
          const container = document.getElementById('results-container');
          container.innerHTML = data.data.html;
          document.getElementById('pagination-container').innerHTML =
            data.data.pagination;
        } else {
          console.error('Erreur lors du filtrage des posts.', data);
        }
      })
      .catch((error) => console.error('Erreur AJAX :', error));
  });
}
