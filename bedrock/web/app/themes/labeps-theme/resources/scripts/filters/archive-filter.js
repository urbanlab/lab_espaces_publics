export function archiveFilterRessources() {
  const taxonomyCheckboxes = document.querySelectorAll(
    '#taxonomy-checkboxes input[type="checkbox"]',
  );
  const allPosts = document.querySelectorAll('.single-post');

  taxonomyCheckboxes.forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
      // Get selected terms
      const selectedTerms = Array.from(taxonomyCheckboxes)
        .filter(function (checkbox) {
          return checkbox.checked && checkbox.value !== 'all';
        })
        .map(function (checkbox) {
          return checkbox.value;
        });

      // Filter and display posts based on the selected terms
      filterPosts(selectedTerms);
    });
  });

  function filterPosts(terms) {
    allPosts.forEach(function (post) {
      const postTerms = Array.from(post.classList)
        .filter(function (className) {
          return className.startsWith('term-');
        })
        .map(function (className) {
          return className.replace('term-', '');
        });

      // Show or hide posts based on the selected terms
      if (
        terms.length === 0 ||
        terms.some(function (term) {
          return postTerms.includes(term);
        })
      ) {
        post.style.display = 'block';
      } else {
        post.style.display = 'none';
      }
    });
  }
}

export function archiveFilterInspirations() {
  const allPosts = document.querySelectorAll('.single-post');

  // Retrieve all selection elements with the data attribute
  const taxonomySelects = document.querySelectorAll('[data-taxonomy]');

  taxonomySelects.forEach(function (taxonomySelect) {
    taxonomySelect.addEventListener('change', function () {
      const selectedTerm = taxonomySelect.value;
      const taxonomy = taxonomySelect.dataset.taxonomy;
      filterPosts(selectedTerm, taxonomy);
    });
  });

  function filterPosts(term, taxonomy) {
    allPosts.forEach(function (post) {
      const postTerms = Array.from(post.classList)
        .filter(function (className) {
          return className.startsWith('term-' + taxonomy + '-');
        })
        .map(function (className) {
          return className.replace('term-' + taxonomy + '-', '');
        });
      // Use the 'taxonomy' variable within the function
      if (term === 'all' || postTerms.includes(term)) {
        post.style.display = 'block';
      } else {
        post.style.display = 'none';
      }
    });
  }
}
