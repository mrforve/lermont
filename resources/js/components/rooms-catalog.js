document.addEventListener('DOMContentLoaded', () => {
    const motionPreference = window.matchMedia('(prefers-reduced-motion: reduce)');
    const galleries = new Map();
    const wrap = (index, total) => (index + total) % total;

    document.querySelectorAll('[data-room-slider]').forEach((slider) => {
        const stage = slider.querySelector('[data-room-stage]');
        const main = slider.querySelector('[data-room-main]');
        const side = slider.querySelector('[data-room-side]');
        if (!stage || !main || !side) return;

        let images;
        try { images = JSON.parse(slider.dataset.roomImages); } catch { return; }
        if (!images.length) return;
        const mainImage = main.querySelector('img');
        const sideImage = side.querySelector('img');
        const previous = slider.querySelector('[data-slider-prev]');
        const next = slider.querySelector('[data-slider-next]');
        const counter = slider.querySelector('[data-slider-counter]');
        const controls = [previous, next, side].filter(Boolean);
        const loaded = new Map();
        let current = 0;
        let transition = null;

        const preload = (index) => {
            const { src } = images[wrap(index, images.length)];
            if (!loaded.has(src)) {
                const image = new Image();
                image.src = src;
                loaded.set(src, image.decode ? image.decode().catch(() => {}) : Promise.resolve());
            }
            return loaded.get(src);
        };
        const setImage = (element, index) => {
            const image = images[wrap(index, images.length)];
            element.src = image.src;
            element.alt = image.alt;
        };
        const setBusy = (busy) => {
            controls.forEach(control => { control.disabled = busy || images.length < 2; });
            main.setAttribute('aria-busy', String(busy));
        };
        const render = () => {
            setImage(mainImage, current);
            setImage(sideImage, current + 1);
            if (counter) counter.textContent = `${current + 1} / ${images.length}`;
            if (slider.closest('[data-room-panel]')?.classList.contains('is-active')) {
                preload(current + 1);
                preload(current - 1);
            }
        };
        const finish = (pending = transition) => {
            if (!pending || pending !== transition) return;
            pending.animations.forEach(animation => animation.cancel());
            pending.layer?.remove();
            current = pending.target;
            transition = null;
            render();
            setBusy(false);
        };
        const frame = (element) => {
            const stageBox = stage.getBoundingClientRect();
            const box = element.getBoundingClientRect();
            return {
                left: `${box.left - stageBox.left}px`,
                top: `${box.top - stageBox.top}px`,
                width: `${box.width}px`,
                height: `${box.height}px`,
            };
        };
        const move = async (direction) => {
            if (transition || images.length < 2) return;
            const pending = { target: wrap(current + direction, images.length), animations: [], layer: null };
            transition = pending;
            setBusy(true);
            await preload(pending.target);
            if (transition !== pending) return;

            if (motionPreference.matches || typeof stage.animate !== 'function') {
                finish(pending);
                return;
            }

            const source = direction > 0 ? side : main;
            const destination = direction > 0 ? main : side;
            const from = frame(source);
            const to = frame(destination);
            if (!source.getBoundingClientRect().width || !destination.getBoundingClientRect().width) {
                finish(pending);
                return;
            }

            // The same photo travels across the gutter; object-fit preserves its proportions as the frame grows.
            const layer = document.createElement('div');
            layer.className = 'room-slider__moving-photo';
            layer.setAttribute('aria-hidden', 'true');
            const movingImage = (direction > 0 ? sideImage : mainImage).cloneNode();
            movingImage.alt = '';
            movingImage.loading = 'eager';
            layer.append(movingImage);
            Object.assign(layer.style, from);
            stage.append(layer);
            pending.layer = layer;

            if (direction > 0) setImage(sideImage, pending.target + 1);
            else setImage(mainImage, pending.target);

            const options = { duration: 760, easing: 'cubic-bezier(.22, .61, .36, 1)', fill: 'both' };
            try {
                const travel = layer.animate([from, to], options);
                const background = mainImage.animate(direction > 0
                    ? [{ opacity: 1, transform: 'scale(1)' }, { opacity: .25, transform: 'scale(.97)' }]
                    : [{ opacity: .35, transform: 'translateX(-20px)' }, { opacity: 1, transform: 'translateX(0)' }], options);
                pending.animations.push(travel, background);
                // Both animations can be cancelled by a category change or viewport resize.
                background.finished.catch(() => {});
                await travel.finished;
            } catch {
                // A cancelled or unsupported animation still commits a consistent main/preview pair.
            } finally {
                finish(pending);
            }
        };

        previous?.addEventListener('click', () => move(-1));
        next?.addEventListener('click', () => move(1));
        side.addEventListener('click', () => move(1));
        main.tabIndex = images.length > 1 ? 0 : -1;
        main.addEventListener('keydown', event => {
            if (event.key !== 'ArrowLeft' && event.key !== 'ArrowRight') return;
            event.preventDefault();
            return move(event.key === 'ArrowRight' ? 1 : -1);
        });

        let pointerStart = null;
        main.addEventListener('pointerdown', event => {
            if (transition || (event.pointerType === 'mouse' && event.button !== 0)) return;
            pointerStart = { x: event.clientX, y: event.clientY, id: event.pointerId };
            main.setPointerCapture?.(event.pointerId);
        });
        main.addEventListener('pointerup', event => {
            if (!pointerStart || pointerStart.id !== event.pointerId) return;
            const dx = event.clientX - pointerStart.x;
            const dy = event.clientY - pointerStart.y;
            pointerStart = null;
            if (Math.abs(dx) > 40 && Math.abs(dx) > Math.abs(dy) * 1.2) return move(dx < 0 ? 1 : -1);
        });
        main.addEventListener('pointercancel', () => { pointerStart = null; });

        window.addEventListener('resize', () => finish());
        motionPreference.addEventListener('change', () => finish());
        const panel = slider.closest('[data-room-panel]');
        if (panel) galleries.set(panel, { finish: () => finish(), activate: render });
        render();
        setBusy(false);
    });

    const buttons = document.querySelectorAll('[data-room-toggle]');
    const panels = document.querySelectorAll('[data-room-panel]');
    buttons.forEach(button => button.addEventListener('click', () => {
        const panel = Array.from(panels).find(item => item.dataset.roomPanel === button.dataset.roomToggle);
        if (!panel) return;
        galleries.forEach(gallery => gallery.finish());
        buttons.forEach(item => item.classList.toggle('is-active', item === button));
        panels.forEach(item => item.classList.toggle('is-active', item === panel));
        galleries.get(panel)?.activate();
    }));
});
