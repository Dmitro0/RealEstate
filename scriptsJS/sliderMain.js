let currentSlide = 0;
const slider = document.querySelector('.slider');
const slides = document.querySelectorAll('.slide');
const maxSlide = slides.length - 3;

function moveSlide(direction) {
    currentSlide = currentSlide == maxSlide ? 0 : Math.max(0, Math.min(currentSlide + direction, maxSlide));
    slider.style.transform = `translateX(-${currentSlide * 33.333}%)`;
}