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
  const mapElement = document.getElementById('map');
  if (mapElement) {
    MapLeaflet();
  } else {
    console.error('Map element not found at DOMContentLoaded');
  }
  callAjax();
  function handleSelectionChange() {
    animatePostsOnLoad();
    hidePostsAnimation(() => {
      animatePosts();
    });
  }
  document
    .querySelectorAll('select, input[type="checkbox"]')
    .forEach((element) => {
      element.addEventListener('change', handleSelectionChange);
    });

  FilterMenu();
  Accordion();
  ViewTabs();

  const checkboxes = document.querySelectorAll('input[type="checkbox"]');
  UpdateTags(checkboxes);

  checkboxes.forEach(function (checkbox) {
    checkbox.addEventListener('change', function () {
      UpdateTags(checkboxes);
    });
  });

  Matomo();
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
