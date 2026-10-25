(() => {
    const form = document.querySelector('[data-booking-form]');
    if (form) {
        const arrival = form.elements.date;
        const departure = form.elements.departure;
        const nights = form.elements.nights;
        const isoDate = (date) => date.toISOString().slice(0, 10);
        const today = new Date();
        const todayLocal = new Date(Date.UTC(today.getFullYear(), today.getMonth(), today.getDate()));
        arrival.min = isoDate(todayLocal);
        const updateDates = () => {
            if (!arrival.value) return;
            const nextDay = new Date(`${arrival.value}T00:00:00Z`);
            nextDay.setUTCDate(nextDay.getUTCDate() + 1);
            departure.min = isoDate(nextDay);
            if (departure.value && departure.value < departure.min) departure.value = departure.min;
            departure.setCustomValidity('');
            if (departure.value) nights.value = Math.round((Date.parse(`${departure.value}T00:00:00Z`) - Date.parse(`${arrival.value}T00:00:00Z`)) / 86400000);
        };
        arrival.addEventListener('change', updateDates);
        departure.addEventListener('change', updateDates);
        form.addEventListener('submit', (event) => {
            updateDates();
            if (!form.checkValidity()) { event.preventDefault(); form.reportValidity(); return; }
            const target = new URL(form.action, window.location.origin);
            target.searchParams.set('date', arrival.value);
            target.searchParams.set('nights', nights.value);
            event.preventDefault();
            window.location.assign(target.href);
        });
        updateDates();
    }
    const track = document.querySelector('[data-gallery-track]');
    const galleryButtons = document.querySelectorAll('[data-gallery-step]');
    if (track) {
        const updateControls = () => {
            galleryButtons.forEach(button => {
                button.disabled = Number(button.dataset.galleryStep) < 0 ? track.scrollLeft < 2 : track.scrollLeft + track.clientWidth >= track.scrollWidth - 2;
            });
        };
        galleryButtons.forEach(button => button.addEventListener('click', () => {
            track.scrollBy({ left: Number(button.dataset.galleryStep) * (track.clientWidth + 9), behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'instant' : 'smooth' });
        }));
        track.addEventListener('scroll', updateControls, { passive: true });
        window.addEventListener('resize', updateControls);
        updateControls();
    }
    const lightbox = document.querySelector('[data-lightbox]');
    if (lightbox && typeof lightbox.showModal === 'function') {
        document.querySelectorAll('[data-gallery-image]').forEach(link => link.addEventListener('click', event => {
            event.preventDefault();
            lightbox.querySelector('img').src = link.href;
            lightbox.querySelector('img').alt = link.querySelector('img').alt;
            lightbox.showModal();
        }));
        lightbox.querySelector('[data-lightbox-close]').addEventListener('click', () => lightbox.close());
        lightbox.addEventListener('click', event => { if (event.target === lightbox) lightbox.close(); });
    }
})();
