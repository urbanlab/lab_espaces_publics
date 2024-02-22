import domReady from '@roots/sage/client/dom-ready';
import 'flowbite';
import {callAjax} from './ajax';
import {Matomo} from './matomo';
import {
  animatePosts,
  hidePostsAnimation,
  animatePostsOnLoad,
} from './filters/animatePost';
// import {attachPaginationListeners, handlePaginationClick} from './pagnination';
/**
 * Application entrypoint
 */
domReady(async () => {
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

  // attachPaginationListeners();
  // handlePaginationClick();
  Matomo();
});

/**
 * @see {@link https://webpack.js.org/api/hot-module-replacement/}
 */
if (import.meta.webpackHot) import.meta.webpackHot.accept(console.error);
