import './lermont.js';
document.addEventListener('DOMContentLoaded', () => {
    const gallery = document.querySelector('[data-room-gallery]');
    const lightbox = document.querySelector('[data-room-lightbox]');

    if (!gallery || !lightbox) {
        return;
    }

    const items = Array.from(
        gallery.querySelectorAll('[data-lightbox-image]')
    );

    const preview = lightbox.querySelector('[data-lightbox-preview]');
    const caption = lightbox.querySelector('[data-lightbox-caption]');
    const previousButton = lightbox.querySelector('[data-lightbox-prev]');
    const nextButton = lightbox.querySelector('[data-lightbox-next]');
    const closeButtons = lightbox.querySelectorAll('[data-lightbox-close]');

    let currentIndex = 0;

    const renderImage = () => {
        const item = items[currentIndex];

        if (!item) {
            return;
        }

        const image = item.dataset.lightboxImage;
        const alt = item.dataset.lightboxAlt || '';

        preview.src = image;
        preview.alt = alt;
        caption.textContent = alt;

        previousButton.hidden = items.length < 2;
        nextButton.hidden = items.length < 2;
    };

    const openLightbox = (index) => {
        currentIndex = index;
        renderImage();

        lightbox.classList.add('is-open');
        lightbox.setAttribute('aria-hidden', 'false');
        document.body.classList.add('room-lightbox-open');

        lightbox.querySelector('[data-lightbox-close]').focus();
    };

    const closeLightbox = () => {
        lightbox.classList.remove('is-open');
        lightbox.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('room-lightbox-open');

        preview.src = '';
    };

    const showPrevious = () => {
        currentIndex = currentIndex === 0
            ? items.length - 1
            : currentIndex - 1;

        renderImage();
    };

    const showNext = () => {
        currentIndex = currentIndex === items.length - 1
            ? 0
            : currentIndex + 1;

        renderImage();
    };

    items.forEach((item, index) => {
        item.addEventListener('click', () => {
            openLightbox(index);
        });
    });

    closeButtons.forEach((button) => {
        button.addEventListener('click', closeLightbox);
    });

    previousButton.addEventListener('click', showPrevious);
    nextButton.addEventListener('click', showNext);

    document.addEventListener('keydown', (event) => {
        if (!lightbox.classList.contains('is-open')) {
            return;
        }

        if (event.key === 'Escape') {
            closeLightbox();
        }

        if (event.key === 'ArrowLeft') {
            showPrevious();
        }

        if (event.key === 'ArrowRight') {
            showNext();
        }
    });
});
document.addEventListener('DOMContentLoaded', () => {
    const gallery = document.querySelector('[data-hotel-gallery]');
    const lightbox = document.querySelector('[data-gallery-lightbox]');
    if (!gallery || !lightbox) return;

    const items = Array.from(gallery.querySelectorAll('[data-gallery-item]'));
    const filterButtons = gallery.querySelectorAll('[data-gallery-filter]');
    const preview = lightbox.querySelector('[data-gallery-preview]');
    const caption = lightbox.querySelector('[data-gallery-caption]');
    let visibleItems = items;
    let currentIndex = 0;

    const render = () => {
        const item = visibleItems[currentIndex];
        if (!item) return;
        preview.src = item.dataset.gallerySrc;
        preview.alt = item.dataset.galleryAlt || '';
        caption.textContent = item.dataset.galleryTitle || item.dataset.galleryAlt || '';
    };
    const open = (item) => {
        currentIndex = Math.max(0, visibleItems.indexOf(item));
        render();
        lightbox.classList.add('is-open');
        lightbox.setAttribute('aria-hidden', 'false');
        document.body.classList.add('hotel-gallery-lightbox-open');
        lightbox.querySelector('[data-gallery-close]').focus();
    };
    const close = () => {
        lightbox.classList.remove('is-open');
        lightbox.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('hotel-gallery-lightbox-open');
        preview.src = '';
    };
    const move = (step) => {
        if (!visibleItems.length) return;
        currentIndex = (currentIndex + step + visibleItems.length) % visibleItems.length;
        render();
    };

    filterButtons.forEach((button) => button.addEventListener('click', () => {
        const filter = button.dataset.galleryFilter;
        filterButtons.forEach((item) => item.classList.toggle('is-active', item === button));
        items.forEach((item) => { item.hidden = filter !== 'all' && item.dataset.galleryCategory !== filter; });
        visibleItems = items.filter((item) => !item.hidden);
    }));
    items.forEach((item) => item.addEventListener('click', () => open(item)));
    lightbox.querySelectorAll('[data-gallery-close]').forEach((button) => button.addEventListener('click', close));
    lightbox.querySelector('[data-gallery-prev]').addEventListener('click', () => move(-1));
    lightbox.querySelector('[data-gallery-next]').addEventListener('click', () => move(1));
    document.addEventListener('keydown', (event) => {
        if (!lightbox.classList.contains('is-open')) return;
        if (event.key === 'Escape') close();
        if (event.key === 'ArrowLeft') move(-1);
        if (event.key === 'ArrowRight') move(1);
    });
});
