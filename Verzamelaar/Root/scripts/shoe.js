const mainSlide = document.querySelector('#main-slide');
const thumbnails = document.querySelectorAll('.thumbnail-img');

thumbnails.forEach((thumbnail, index) => {
    thumbnail.addEventListener('click', () => {
        mainSlide.src = thumbnail.src;
    });
});

const prevButton = document.querySelector('#prev-button');
const nextButton = document.querySelector('#next-button');

prevButton.addEventListener('click', () => {
    let currentIndex = Array.from(thumbnails).findIndex(thumbnail => thumbnail.src === mainSlide.src);
    currentIndex = currentIndex === -1 ? 0 : currentIndex;
    currentIndex = currentIndex === 0 ? thumbnails.length - 1 : currentIndex - 1;
    mainSlide.src = thumbnails[currentIndex].src;
});

nextButton.addEventListener('click', () => {
    let currentIndex = Array.from(thumbnails).findIndex(thumbnail => thumbnail.src === mainSlide.src);
    currentIndex = currentIndex === -1 ? 0 : currentIndex;
    currentIndex = currentIndex === thumbnails.length - 1 ? 0 : currentIndex + 1;
    mainSlide.src = thumbnails[currentIndex].src;
});
