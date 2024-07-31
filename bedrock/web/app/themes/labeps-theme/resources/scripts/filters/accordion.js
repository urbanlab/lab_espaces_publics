export function Accordion() {
  const acc = document.getElementsByClassName('accordion');
  for (let i = 0; i < acc.length; i++) {
    acc[i].addEventListener('click', function () {
      this.classList.toggle('active');
      const panel = this.nextElementSibling;
      if (panel.style.maxHeight) {
        panel.style.maxHeight = null;
        panel.classList.remove('open');
        panel.classList.add('hidden');
      } else {
        panel.style.maxHeight = panel.scrollHeight + 'px';
        panel.classList.add('open');
        panel.classList.remove('hidden');
      }
    });
  }
}
