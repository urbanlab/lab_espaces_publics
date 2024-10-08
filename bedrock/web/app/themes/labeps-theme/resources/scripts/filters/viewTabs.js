export function ViewTabs(map) {
  const mapViewButton = document.getElementById('map-view-button');
  const listViewButton = document.getElementById('list-view-button');
  const mapView = document.getElementById('map-view');
  const listView = document.getElementById('list-view');

  mapViewButton.addEventListener('click', function () {
    mapView.classList.add('active');
    listView.classList.remove('active');
    mapViewButton.classList.add('active');
    listViewButton.classList.remove('active');

    // Invalider la taille de la carte lorsque la vue carte devient active
    if (map) {
      map.invalidateSize();
    }
  });

  listViewButton.addEventListener('click', function () {
    listView.classList.add('active');
    mapView.classList.remove('active');
    listViewButton.classList.add('active');
    mapViewButton.classList.remove('active');
  });
}
