(() => {
    const notice = document.querySelector('[data-cookie-notice]');
    if (!notice) return;
    const storageKey = 'lermont.cookieNoticeDismissed.v1';
    let dismissed = false;
    try { dismissed = window.localStorage.getItem(storageKey) === '1'; } catch {}
    const updateSpace = () => {
        if (!notice.hidden) document.documentElement.style.setProperty('--cookie-notice-space', `${Math.ceil(notice.getBoundingClientRect().height) + 32}px`);
    };
    const hide = () => {
        notice.hidden = true;
        document.body.classList.remove('has-cookie-notice');
        document.documentElement.style.removeProperty('--cookie-notice-space');
    };
    if (!dismissed) {
        notice.hidden = false;
        document.body.classList.add('has-cookie-notice');
        updateSpace();
    }
    notice.querySelector('[data-cookie-notice-dismiss]').addEventListener('click', () => {
        try { window.localStorage.setItem(storageKey, '1'); } catch {}
        hide();
    });
    window.addEventListener('resize', updateSpace);
    window.addEventListener('storage', event => {
        if (event.key === storageKey && event.newValue === '1') hide();
    });
    if ('ResizeObserver' in window) new window.ResizeObserver(updateSpace).observe(notice);
})();
