document.addEventListener('DOMContentLoaded', () => {
    const dialog = document.querySelector('[data-page-video-dialog]');
    const video = dialog?.querySelector('[data-page-video-player]');
    if (!dialog || !video) return;
    let opener = null;
    const close = () => { if (dialog.open) dialog.close(); };
    document.querySelectorAll('[data-page-video-open]').forEach(button => {
        button.addEventListener('click', event => {
            const source = button.dataset.pageVideoOpen;
            if (!source) return;
            event.preventDefault();opener = button;
            document.querySelectorAll('video').forEach(player => player.pause());
            if (video.getAttribute('src') !== source) { video.src = source; video.load(); }
            else video.currentTime = 0;
            dialog.showModal();dialog.classList.add('is-open');document.body.classList.add('video-lightbox-open');
            video.play().catch(() => { video.controls = true; });
        });
    });
    dialog.querySelector('[data-page-video-close]')?.addEventListener('click', close);
    dialog.addEventListener('click', event => { if (event.target === dialog) close(); });
    dialog.addEventListener('cancel', event => { event.preventDefault();close(); });
    dialog.addEventListener('close', () => { video.pause();dialog.classList.remove('is-open');document.body.classList.remove('video-lightbox-open');opener?.focus({ preventScroll: true }); });
});
