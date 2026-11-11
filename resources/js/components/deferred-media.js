const activateVideo = (video) => {
    if (!video) return;
    let changed = false;
    if (video.dataset.mediaSrc && !video.getAttribute('src')) { video.src = video.dataset.mediaSrc; changed = true; }
    video.querySelectorAll('source[data-media-src]').forEach(source => { if (!source.getAttribute('src')) { source.src = source.dataset.mediaSrc; changed = true; } });
    if (changed) video.load();
};
// Capture runs before the existing video controls; playback keeps its user gesture.
document.addEventListener('click', event => {
    if (!(event.target instanceof Element)) return;
    const target = event.target;
    if (target.closest('.watchVideo')) activateVideo(document.querySelector('[data-video-player]'));
    if (target.closest('video')) activateVideo(target.closest('video'));
}, true);

document.addEventListener('DOMContentLoaded', () => {
    const frames = document.querySelectorAll('iframe[data-lazy-src], iframe[data-widget-content]');
    const load = frame => {
        if (frame.dataset.widgetContent) {
            frame.srcdoc = new TextDecoder().decode(Uint8Array.from(atob(frame.dataset.widgetContent), c => c.charCodeAt(0)));
            delete frame.dataset.widgetContent;
        }
        if (frame.dataset.lazySrc) { frame.src = frame.dataset.lazySrc; delete frame.dataset.lazySrc; }
    };
    if ('IntersectionObserver' in window) {
        const observer = new IntersectionObserver(entries => entries.forEach(entry => { if (entry.isIntersecting) { load(entry.target); observer.unobserve(entry.target); } }), { rootMargin: '200px' });
        frames.forEach(frame => observer.observe(frame));
    } else frames.forEach(load);
});
