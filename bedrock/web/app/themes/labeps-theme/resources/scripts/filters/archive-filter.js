export function checkboxPosts() {
  var checkboxes = document.querySelectorAll('#filters input[type="checkbox"]');

  // Ajoutez un écouteur d'événements pour chaque case à cocher
  checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
      // Soumettez le formulaire lorsque l'état d'une case change
      document.getElementById('filters').submit();
    });
  });
}

export function selectPosts() {
  var form = document.getElementById('filters');

  // Ajoutez un écouteur d'événements pour les sélections et les cases à cocher
  form.addEventListener(
    'change',
    function (e) {
      if (e.target.tagName === 'SELECT' || e.target.type === 'checkbox') {
        // Empêche le formulaire de soumettre normalement
        e.preventDefault();

        // Créez un FormData basé sur le formulaire
        var formData = new FormData(form);

        // Utilisez fetch pour soumettre le formulaire via AJAX
        fetch(form.action, {
          method: 'POST',
          body: formData,
        })
          .then((response) => response.json()) // Supposons que le serveur répond avec JSON
          .then((data) => {
            // Traitez la réponse ici, par exemple, mettre à jour la partie de la page avec les résultats filtrés
            console.log(data);
          })
          .catch((error) => console.error('Erreur:', error));
      }
    },
    false,
  );
}
