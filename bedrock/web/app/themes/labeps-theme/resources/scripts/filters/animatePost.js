export function animatePosts() {
  console.log('animatePosts called'); // Pour confirmer que la fonction est appelée
  const posts = document.querySelectorAll('.post:not(.visible)');
  console.log(posts); // Pour voir les éléments sélectionnés
  posts.forEach((post) => {
    setTimeout(() => post.classList.add('visible'), 10);
  });
}

export function observePosts() {
  const observer = new IntersectionObserver(
    (entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target); // Optionnel : arrêtez d'observer une fois visible
        }
      });
    },
    {
      rootMargin: '0px',
      threshold: 0.1, // Ajustez ce seuil selon le besoin
    },
  );

  document.querySelectorAll('.post:not(.visible)').forEach((post) => {
    observer.observe(post);
  });
}

export function hidePostsAnimation(callback) {
  const visiblePosts = document.querySelectorAll('.post.visible');
  visiblePosts.forEach((post) => post.classList.remove('visible'));

  if (callback && typeof callback === 'function') {
    const lastPost = visiblePosts[visiblePosts.length - 1];
    if (lastPost) {
      lastPost.addEventListener('transitionend', callback, {once: true});
    } else {
      callback();
    }
  }
}
