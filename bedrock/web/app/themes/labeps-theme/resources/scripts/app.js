import domReady from '@roots/sage/client/dom-ready';
import 'flowbite';
import '@scripts/filters/archive-filter';
import {checkboxPosts, selectPosts} from '@scripts/filters/archive-filter';
import {Matomo} from './matomo';
import {callAjax} from './ajax';
/**
 * Application entrypoint
 */
domReady(async () => {
  callAjax();
  checkboxPosts();
  selectPosts();
  Matomo();
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
