export function FilterMenu() {
    const filterButton = document.getElementById('filter-button');
    const filterMenu = document.getElementById('filters-menu');
    const closeButton = document.getElementById('close-filter-menu');
    const filterOverlay = document.getElementById('filter-overlay');

    if (filterMenu) {
        if (filterButton) {
            filterButton.addEventListener('click', function () {
                filterMenu.classList.toggle('show');
            });
        }

        if (closeButton) {
            closeButton.addEventListener('click', function () {
                filterMenu.classList.remove('show');
            });
        }

        if (filterOverlay) {
            filterOverlay.addEventListener('click', function () {
                filterMenu.classList.remove('show');
                filterOverlay.classList.add('hidden');
            });
        }
    }
}
