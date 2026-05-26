function tmm() {
  const m = document.getElementById('mm');
  if (!m) return;
  m.classList.toggle('open');
  document.body.style.overflow = m.classList.contains('open') ? 'hidden' : '';
}

function initScrollAnimations() {
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
    document.querySelectorAll('[data-anim]').forEach((el) => el.classList.add('is-visible'));
    document.querySelectorAll('.meta-list').forEach((el) => el.classList.add('is-visible'));
    return;
  }

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        const el = entry.target;
        const delay = parseInt(el.getAttribute('data-delay') || '0', 10);
        if (delay > 0) {
          setTimeout(() => el.classList.add('is-visible'), delay);
        } else {
          el.classList.add('is-visible');
        }
        observer.unobserve(el);
      });
    },
    { root: null, rootMargin: '0px 0px -8% 0px', threshold: 0.12 }
  );

  document.querySelectorAll('[data-anim]').forEach((el) => observer.observe(el));
  document.querySelectorAll('.meta-list[data-anim]').forEach((el) => observer.observe(el));
}

function initHeroStats() {
  const stats = document.querySelector('.hero-stats');
  if (!stats || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  const items = stats.querySelectorAll('dd');
  const targets = [12, 4, 10];
  const suffixes = ['', '', '+'];

  const run = () => {
    items.forEach((dd, i) => {
      const end = targets[i];
      const suffix = suffixes[i];
      const duration = 1200;
      const start = performance.now();
      const tick = (now) => {
        const p = Math.min((now - start) / duration, 1);
        const eased = 1 - (1 - p) ** 3;
        dd.textContent = Math.round(end * eased) + suffix;
        if (p < 1) requestAnimationFrame(tick);
      };
      requestAnimationFrame(tick);
    });
  };

  const obs = new IntersectionObserver(
    (entries) => {
      if (entries[0].isIntersecting) {
        run();
        obs.disconnect();
      }
    },
    { threshold: 0.5 }
  );
  obs.observe(stats);
}

document.addEventListener('DOMContentLoaded', () => {
  initScrollAnimations();
  initHeroStats();

  document.querySelectorAll('.newsletter-form').forEach((form) => {
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      const input = form.querySelector('input[type="email"]');
      if (input) input.value = '';
      alert('Thank you — you are on the list.');
    });
  });

  document.querySelectorAll('.contact-form').forEach((form) => {
    form.addEventListener('submit', (e) => {
      e.preventDefault();
      form.reset();
      alert('Your letter has been sent. Thank you.');
    });
  });
});
