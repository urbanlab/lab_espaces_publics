import {callAjax} from '@scripts/ajax';

export function attachPaginationListeners() {
  document.querySelectorAll('#pagination-container a').forEach((link) => {
    link.removeEventListener('click', handlePaginationClick);
    link.addEventListener('click', handlePaginationClick);
  });
}

export function handlePaginationClick() {
  document.addEventListener('click', function (e) {
    if (e.target.matches('.pagination-container a')) {
      e.preventDefault();
      const page = new URL(e.target.href).searchParams.get('page');
      callAjax(page);
    }
  });
}
