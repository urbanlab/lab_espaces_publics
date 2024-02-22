export function animatePostsOnLoad() {
  const posts = document.querySelectorAll('.post');
  posts.forEach((post) => {
    post.classList.add('invisible');
  });
}

export function animatePosts() {
  const posts = document.querySelectorAll('.post:not(.invisible)');
  posts.forEach((post) => {
    setTimeout(() => post.classList.add('invisible'), 10);
  });
}

export function hidePostsAnimation(callback) {
  const visiblePosts = document.querySelectorAll('.post.invisible');
  visiblePosts.forEach((post) => post.classList.remove('invisible'));

  if (callback && typeof callback === 'function') {
    const lastPost = visiblePosts[visiblePosts.length - 1];
    if (lastPost) {
      lastPost.addEventListener('transitionend', callback, {once: true});
    } else {
      callback();
    }
  }
}
