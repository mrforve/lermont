@once
<script>
(function (w, d) {
    const embeds = [];

    if (d.getElementById('tl-search-form')) {
        embeds.push(['embed', 'search-form', { container: 'tl-search-form' }]);
    }

    if (d.getElementById('tl-booking-form')) {
        embeds.push(['embed', 'booking-form', { container: 'tl-booking-form' }]);
    }

    if (d.getElementById('tl-guest-account')) {
        embeds.push(['embed', 'guest-account', { container: 'tl-guest-account' }]);
    }

    if (embeds.length === 0) {
        return;
    }

    const queue = [
        ['setContext', 'TL-INT-hotel-lermont-new', 'ru'],
        ...embeds,
    ];

    const hosts = [
        'ru-ibe.tlintegration.ru',
        'ibe.tlintegration.ru',
        'ibe.tlintegration.com',
    ];

    const travelLine = w.travelline = w.travelline || {};
    const integration = travelLine.integration = travelLine.integration || {};

    integration.__cq = integration.__cq
        ? integration.__cq.concat(queue)
        : queue;

    if (integration.__loader) {
        return;
    }

    integration.__loader = true;

    const target = d.head || d.body;

    function load(hostIndex) {
        if (hostIndex >= hosts.length) {
            return;
        }

        const script = d.createElement('script');
        script.type = 'text/javascript';
        script.async = true;
        script.src = `https://${hosts[hostIndex]}/integration/loader.js`;

        script.onerror = function () {
            script.remove();
            load(hostIndex + 1);
        };

        target.appendChild(script);
    }

    load(0);
})(window, document);
</script>
@endonce
