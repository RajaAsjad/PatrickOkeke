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

      const btn = form.querySelector('button[type="submit"]');
      const originalText = btn ? btn.textContent : '';
      if (btn) {
        btn.disabled = true;
        btn.textContent = 'Sending...';
      }

      fetch(form.action, {
        method: 'POST',
        body: new FormData(form),
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          Accept: 'application/json',
        },
      })
        .then((response) =>
          response.json().then((data) => ({ ok: response.ok, data }))
        )
        .then((result) => {
          if (result.ok && result.data.success) {
            if (typeof Swal !== 'undefined') {
              Swal.fire({
                icon: 'success',
                title: 'You are on the list',
                text: result.data.message || 'Thank you. You are on the list.',
                confirmButtonText: 'Close',
                confirmButtonColor: '#1a1a1a',
                timer: 5000,
                timerProgressBar: true,
              });
            }
            form.reset();
            return;
          }

          const msg =
            result.data.message ||
            (result.data.errors
              ? Object.values(result.data.errors).flat().join(' ')
              : 'Something went wrong. Please try again.');

          if (typeof Swal !== 'undefined') {
            Swal.fire({
              icon: 'error',
              title: 'Could not subscribe',
              text: msg,
              confirmButtonText: 'Try again',
              confirmButtonColor: '#1a1a1a',
            });
          }
        })
        .catch(() => {
          if (typeof Swal !== 'undefined') {
            Swal.fire({
              icon: 'error',
              title: 'Could not subscribe',
              text: 'Something went wrong. Please try again.',
              confirmButtonText: 'Try again',
              confirmButtonColor: '#1a1a1a',
            });
          }
        })
        .finally(() => {
          if (btn) {
            btn.disabled = false;
            btn.textContent = originalText;
          }
        });
    });
  });
});
