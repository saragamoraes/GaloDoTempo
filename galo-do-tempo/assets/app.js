document.addEventListener('DOMContentLoaded', () => {
  const toggle = document.querySelector('[data-menu-toggle]');
  const nav = document.querySelector('[data-mobile-nav]');
  if (toggle && nav) {
    toggle.addEventListener('click', () => {
      const opened = nav.classList.toggle('open');
      toggle.setAttribute('aria-expanded', String(opened));
    });
  }

  if (!new URLSearchParams(window.location.search).has('demo_humidity')) {
    window.setTimeout(() => window.location.reload(), 30000);
  }
});
