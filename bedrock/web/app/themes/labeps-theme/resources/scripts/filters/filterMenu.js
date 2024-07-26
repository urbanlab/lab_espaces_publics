export function FilterMenu() {
  const filterButton = document.getElementById('filter-button');
  const filterMenu = document.getElementById('filters-menu');
  const closeButton = document.getElementById('close-filter-menu');
  const filterOverlay = document.getElementById('filter-overlay');

  filterButton.addEventListener('click', function () {
    filterMenu.classList.toggle('show');
  });

  closeButton.addEventListener('click', function () {
    filterMenu.classList.remove('show');
  });

  filterOverlay.addEventListener('click', function () {
    filterMenu.classList.remove('show');
    filterOverlay.classList.add('hidden');
  });
}
