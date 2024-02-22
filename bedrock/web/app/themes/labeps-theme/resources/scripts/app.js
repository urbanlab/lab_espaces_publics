import domReady from '@roots/sage/client/dom-ready';
import 'flowbite';
import {callAjax} from './ajax';
import {Matomo} from './matomo';
import {animatePosts, observePosts} from './filters/animatePost';
import {attachPaginationListeners, handlePaginationClick} from './pagnination';
/**
 * Application entrypoint
 */
domReady(async () => {
  callAjax();
  animatePosts();
  observePosts();
  attachPaginationListeners();
  handlePaginationClick();
  Matomo();
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
