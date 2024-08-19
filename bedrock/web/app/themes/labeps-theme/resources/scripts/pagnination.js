import {callAjax} from './ajax';

export function attachPaginationListeners() {
  document.querySelectorAll('#pagination-container a').forEach((link) => {
    link.removeEventListener('click', handlePaginationClick);
    link.addEventListener('click', handlePaginationClick);
  });
}

function handlePaginationClick(e) {
  e.preventDefault();
  const page = new URL(e.target.href).searchParams.get('paged'); // 'paged' pour WordPress
  callAjax(page);
}
