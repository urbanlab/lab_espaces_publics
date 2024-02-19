export function callAjax() {
  const form = document.getElementById('filters');
  form.addEventListener('change', async function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append('action', 'my_custom_filter');
    formData.append('nonce', document.querySelector('#my_custom_nonce').value);

    try {
      const response = await fetch(ajax_object.ajaxurl, {
        method: 'POST',
        body: formData,
        credentials: 'same-origin',
      });
      const data = await response.json();
      console.log(data);
      // Traitez ici la réponse, par exemple, mettre à jour le DOM
    } catch (error) {
      console.error('Erreur:', error);
    }
  });
}
