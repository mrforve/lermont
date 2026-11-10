// Observe the existing vendor iframe; never modify its contents, height or API.
document.addEventListener('DOMContentLoaded', () => {
    const container = document.querySelector('.travelline-inner-search .tl-container');
    if (!container) return;
    let frame = null, pending = false;
    const sync = () => {
        pending = false;
        const candidate = container.querySelector('iframe');
        if (candidate !== frame) {
            if (frame) resize?.unobserve(frame);
            frame = candidate;
            if (frame) resize?.observe(frame);
        }
        if (!frame) return;
        const height = Math.ceil(frame.getBoundingClientRect().height);
        if (height > 24 && height < 1200) {
            const value = `${height}px`;
            if (container.style.getPropertyValue('--tl-inner-height') !== value) container.style.setProperty('--tl-inner-height', value);
        }
    };
    const schedule = () => { if (!pending) { pending = true; requestAnimationFrame(sync); } };
    const resize = 'ResizeObserver' in window ? new ResizeObserver(schedule) : null;
    new MutationObserver(schedule).observe(container, { childList: true, subtree: true, attributes: true, attributeFilter: ['height', 'style'] });
    window.addEventListener('resize', schedule, { passive: true });
    schedule();
});
