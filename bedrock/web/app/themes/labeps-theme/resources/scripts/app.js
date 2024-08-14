import domReady from '@roots/sage/client/dom-ready';
import 'flowbite';
import {callAjax} from './ajax';
import {Matomo} from './matomo';
import {
  animatePosts,
  hidePostsAnimation,
  animatePostsOnLoad,
} from './filters/animatePost';
import {Accordion} from './filters/accordion';
import {UpdateTags} from './filters/updateTags';
import {FilterMenu} from './filters/filterMenu';
import {ViewTabs} from './filters/viewTabs';
import {MapLeaflet} from './map-leaflet';

/**
 * Application entrypoint
 */
domReady(async () => {
  console.log('DOM is ready.');

  function isPage(urlFragment) {
    return window.location.href.indexOf(urlFragment) > -1;
  }

  // Vérification des modules chargés
  console.log('MapLeaflet:', typeof MapLeaflet);
  console.log('callAjax:', typeof callAjax);
  console.log('Matomo:', typeof Matomo);

  // Afficher l'URL actuelle pour vérifier les conditions de page
  console.log('Current URL:', window.location.href);

  // Vérifiez et exécutez MapLeaflet uniquement sur la page spécifique
  if (isPage('/projets-pilotes/') && typeof MapLeaflet === 'function') {
    console.log('Executing MapLeaflet...');
    MapLeaflet();
  } else {
    console.log('MapLeaflet not executed.');
  }

  // Vérifiez et exécutez callAjax si nécessaire
  if (typeof callAjax === 'function') {
    console.log('Executing callAjax...');
    callAjax();
  }

  function handleSelectionChange() {
    // Vérifiez et exécutez animatePostsOnLoad si nécessaire
    if (typeof animatePostsOnLoad === 'function') {
      console.log('Executing animatePostsOnLoad...');
      animatePostsOnLoad();
    }
    // Vérifiez et exécutez hidePostsAnimation si nécessaire
    if (typeof hidePostsAnimation === 'function') {
      console.log('Executing hidePostsAnimation...');
      hidePostsAnimation(() => {
        // Vérifiez et exécutez animatePosts si nécessaire
        if (typeof animatePosts === 'function') {
          console.log('Executing animatePosts...');
          animatePosts();
        }
      });
    }
  }

  // Sélectionnez et ajoutez des écouteurs d'événements si les éléments existent
  const selectInputs = document.querySelectorAll(
    'select, input[type="checkbox"]',
  );
  if (selectInputs.length > 0) {
    console.log('Adding change event listeners to select inputs.');
    selectInputs.forEach((element) => {
      element.addEventListener('change', handleSelectionChange);
    });
  }

  // Vérifiez et exécutez FilterMenu si nécessaire
  if (typeof FilterMenu === 'function') {
    console.log('Executing FilterMenu...');
    FilterMenu();
  }

  // Vérifiez et exécutez Accordion si nécessaire
  if (typeof Accordion === 'function') {
    console.log('Executing Accordion...');
    Accordion();
  }

  // Vérifiez et exécutez ViewTabs si nécessaire
  if (typeof ViewTabs === 'function') {
    console.log('Executing ViewTabs...');
    ViewTabs();
  }

  // Sélectionnez les cases à cocher et ajoutez des écouteurs d'événements si les éléments existent
  const checkboxes = document.querySelectorAll('input[type="checkbox"]');
  if (checkboxes.length > 0) {
    console.log('Adding change event listeners to checkboxes.');

    // Vérifiez et exécutez UpdateTags si nécessaire
    if (typeof UpdateTags === 'function') {
      console.log('Executing UpdateTags...');
      UpdateTags(checkboxes);
    }

    checkboxes.forEach(function (checkbox) {
      checkbox.addEventListener('change', function () {
        if (typeof UpdateTags === 'function') {
          console.log('Executing UpdateTags on checkbox change...');
          UpdateTags(checkboxes);
        }
      });
    });
  }

  // Vérifiez et exécutez Matomo si nécessaire
  if (typeof Matomo === 'function') {
    console.log('Executing Matomo...');
    Matomo();
  }
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) {
  console.log('HMR is active.');
  import.meta.webpackHot.accept(console.error);
}
