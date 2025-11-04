export function UpdateTags(checkboxes) {
  const selectedFilters = document.getElementById('selected-filters');
  if (!selectedFilters) {
    return;
  }
  selectedFilters.innerHTML = '';

  if (!checkboxes || checkboxes.length === 0) {
    console.error('Checkboxes is undefined or empty');
    return;
  }

  checkboxes.forEach(function (checkbox) {
    if (checkbox.checked) {
      const label = checkbox.parentNode.textContent.trim();
      const tag = document.createElement('div');
      tag.className = 'tag';
      tag.innerHTML = `${label} <span class="remove-tag">&times;</span>`;
      tag.querySelector('.remove-tag').addEventListener('click', function () {
        checkbox.checked = false;
        UpdateTags(checkboxes);
        // Trigger change event to refilter posts
        checkbox.dispatchEvent(new Event('change'));
      });
      selectedFilters.appendChild(tag);
    }
  });
}
