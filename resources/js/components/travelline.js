document.addEventListener('DOMContentLoaded', () => {
    const definitions = [
        ['search-form', 'tl-search-form'],
        ['search-form', 'tl-search-form-inner'],
        ['search-form', 'tl-search-form-sticky'],
        ['booking-form', 'tl-booking-form'],
        ['guest-account', 'tl-guest-account'],
        ['reviews-widget', 'tl-reviews-widget'],
    ];
    const embeds = definitions.filter(([, id]) => document.getElementById(id));
    if (!embeds.length) return;

    const travelLine = window.travelline = window.travelline || {};
    const integration = travelLine.integration = travelLine.integration || {};
    const registered = integration.__lermontWidgets = integration.__lermontWidgets || new Set();
    const queue = [];
    if (!integration.__lermontContext) {
        queue.push(['setContext', 'TL-INT-hotel-lermont-new', 'ru']);
        integration.__lermontContext = true;
    }
    embeds.forEach(([type, id]) => {
        if (registered.has(id)) return;
        registered.add(id);
        queue.push(['embed', type, { container: id }]);
    });
    integration.__cq = (integration.__cq || []).concat(queue);

    if (!integration.__loader) {
        integration.__loader = true;
        const hosts = ['ru-ibe.tlintegration.ru', 'ibe.tlintegration.ru', 'ibe.tlintegration.com'];
        const load = (index) => {
            if (index >= hosts.length) {
                embeds.forEach(([type, id]) => {
                    const target = document.getElementById(id);
                    const link = document.createElement('a');
                    const path = type === 'guest-account' ? '/lk/' : type === 'reviews-widget' ? '/otzyvy/' : '/booking/';
                    link.href = `https://hotel-lermont.ru${path}${window.location.search}`;
                    link.textContent = 'Открыть модуль на основном сайте';
                    const notice = document.createElement('p');
                    notice.className = 'travelline-error';
                    notice.append('Не удалось загрузить модуль. ', link);
                    target.append(notice);
                });
                return;
            }
            const script = document.createElement('script');
            script.isReloadFuncSet = 'set';
            script.type = 'text/javascript';
            script.async = true;
            script.src = `https://${hosts[index]}/integration/loader.js`;
            let handled = false;
            const retry = () => {
                if (handled) return;
                handled = true;
                if (window.TL) return;
                script.remove();
                load(index + 1);
            };
            // The production site retries both a network error and a response that does not initialise TL.
            script.onerror = retry;
            script.onload = retry;
            (document.head || document.body).appendChild(script);
        };
        load(0);
    }

    const header = document.getElementById('mainNav');
    const sticky = document.querySelector('[data-travelline-sticky]');
    const primary = document.getElementById('tl-search-form');
    const update = () => {
        const headerHeight = header?.getBoundingClientRect().height || 0;
        document.documentElement.style.setProperty('--travelline-header-height', `${Math.ceil(headerHeight)}px`);
        if (!sticky || !primary) return;
        const visible = window.innerWidth >= 992 && primary.getBoundingClientRect().bottom <= headerHeight;
        sticky.classList.toggle('is-visible', visible);
        sticky.setAttribute('aria-hidden', String(!visible));
        sticky.inert = !visible;
    };
    update();
    window.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update);
    if ('ResizeObserver' in window) {
        const observer = new window.ResizeObserver(update);
        if (header) observer.observe(header);
        if (primary) observer.observe(primary);
    }
});
