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
  // Vérifiez et exécutez MapLeaflet uniquement sur la page spécifique
  if (typeof MapLeaflet === 'function') {
    MapLeaflet();
  }

  // Vérifiez et exécutez callAjax si nécessaire
  if (typeof callAjax === 'function') {
    callAjax();
  }

  function handleSelectionChange() {
    // Vérifiez et exécutez animatePostsOnLoad si nécessaire
    if (typeof animatePostsOnLoad === 'function') {
      animatePostsOnLoad();
    }
    // Vérifiez et exécutez hidePostsAnimation si nécessaire
    if (typeof hidePostsAnimation === 'function') {
      hidePostsAnimation(() => {
        // Vérifiez et exécutez animatePosts si nécessaire
        if (typeof animatePosts === 'function') {
          animatePosts();
        }
      });
    }
  }

  const selectInputs = document.querySelectorAll(
    'select, input[type="checkbox"]',
  );
  if (selectInputs.length > 0) {
    selectInputs.forEach((element) => {
      element.addEventListener('change', handleSelectionChange);
    });
  }

  // Vérifiez et exécutez FilterMenu si nécessaire
  if (typeof FilterMenu === 'function') {
    FilterMenu();
  }

  // Vérifiez et exécutez Accordion si nécessaire
  if (typeof Accordion === 'function') {
    Accordion();
  }

  // Vérifiez et exécutez ViewTabs si nécessaire
  if (typeof ViewTabs === 'function') {
    ViewTabs();
  }

  const checkboxes = document.querySelectorAll('input[type="checkbox"]');
  if (checkboxes.length > 0) {
    // Vérifiez et exécutez UpdateTags si nécessaire
    if (typeof UpdateTags === 'function') {
      UpdateTags(checkboxes);
    }

    checkboxes.forEach(function (checkbox) {
      checkbox.addEventListener('change', function () {
        if (typeof UpdateTags === 'function') {
          UpdateTags(checkboxes);
        }
      });
    });
  }

  // Vérifiez et exécutez Matomo si nécessaire
  if (typeof Matomo === 'function') {
    Matomo();
  }
});
