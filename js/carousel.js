document.addEventListener('DOMContentLoaded', () => {
  const slides = document.querySelectorAll('.slide');
  const dots = document.querySelectorAll('.dot');
  const prev = document.querySelector('.prev');
  const next = document.querySelector('.next');

  let current = 0;

  function showSlide(index) {
    slides.forEach((slide, i) => {
      slide.classList.toggle('active', i === index);
      dots[i].classList.toggle('active', i === index);
    });
    current = index;
  }

  next.addEventListener('click', () => {
    let nextIndex = (current + 1) % slides.length;
    showSlide(nextIndex);
  });

  prev.addEventListener('click', () => {
    let prevIndex = (current - 1 + slides.length) % slides.length;
    showSlide(prevIndex);
  });

  dots.forEach(dot => {
    dot.addEventListener('click', () => {
      showSlide(parseInt(dot.dataset.slide));
    });
  });

  // autoplay opcional
  setInterval(() => {
    showSlide((current + 1) % slides.length);
  }, 6000);
});
