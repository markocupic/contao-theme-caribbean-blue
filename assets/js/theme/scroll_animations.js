document.addEventListener('DOMContentLoaded', () => {
  const revealElements = document.querySelectorAll('[data-animation],.mod_newslist .swiper, h2');

  const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add("is-visible");
        obs.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.2
  });

  revealElements.forEach(el => observer.observe(el));

  // Fallback
  revealElements.forEach(el => {
    const rect = el.getBoundingClientRect();
    if (rect.top < window.innerHeight && rect.bottom > 0) {
      el.classList.add("is-visible");
      observer.unobserve(el);
    }
  });
});
