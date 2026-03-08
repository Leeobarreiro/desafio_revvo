document.addEventListener('DOMContentLoaded', function () {
    const slideshow = document.getElementById('slideshow');
    if (!slideshow) return;

    const slides = slideshow.querySelectorAll('.slide');
    const dots = slideshow.querySelectorAll('.slide-dot');
    const prevBtn = slideshow.querySelector('.slide-prev');
    const nextBtn = slideshow.querySelector('.slide-next');

    if (!slides.length) return;

    let currentIndex = 0;
    let interval;

    function showSlide(index) {
        slides.forEach((slide, i) => {
            slide.classList.toggle('active', i === index);
        });

        dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
        });

        currentIndex = index;
    }

    function nextSlide() {
        let next = currentIndex + 1;
        if (next >= slides.length) next = 0;
        showSlide(next);
    }

    function prevSlide() {
        let prev = currentIndex - 1;
        if (prev < 0) prev = slides.length - 1;
        showSlide(prev);
    }

    function startAutoPlay() {
        interval = setInterval(nextSlide, 5000);
    }

    function stopAutoPlay() {
        clearInterval(interval);
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', function () {
            nextSlide();
            stopAutoPlay();
            startAutoPlay();
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', function () {
            prevSlide();
            stopAutoPlay();
            startAutoPlay();
        });
    }

    dots.forEach((dot) => {
        dot.addEventListener('click', function () {
            const index = Number(this.dataset.slide);
            showSlide(index);
            stopAutoPlay();
            startAutoPlay();
        });
    });

    slideshow.addEventListener('mouseenter', stopAutoPlay);
    slideshow.addEventListener('mouseleave', startAutoPlay);

    startAutoPlay();
});