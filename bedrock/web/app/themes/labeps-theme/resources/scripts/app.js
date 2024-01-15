import domReady from '@roots/sage/client/dom-ready';
import 'flowbite';
import '@scripts/filters/archive-filter';
import {
  archiveFilterInspirations,
  archiveFilterRessources,
} from '@scripts/filters/archive-filter';
import {Matomo} from './matomo';
/**
 * Application entrypoint
 */
domReady(async () => {
  archiveFilterRessources();
  archiveFilterInspirations();
  Matomo();
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
