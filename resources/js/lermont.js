document.addEventListener('DOMContentLoaded', function () {
    const header = document.getElementById('mainNav');
    const burger = document.querySelector('.header-burger');
    const menu = document.getElementById('navbarNav');
    const menuLinks = document.querySelectorAll('#navbarNav .nav-link');

    function setHeaderScrolled() {
        if (!header) return;
        header.classList.toggle('scrolled', window.scrollY > 80);
    }

    function openMenu() {
        if (!header || !burger || !menu) return;

        header.classList.add('is-menu-open');
        burger.classList.add('is-active');
        menu.classList.add('is-open');

        burger.setAttribute('aria-expanded', 'true');
        document.body.classList.add('menu-open');
    }

    function closeMenu() {
        if (!header || !burger || !menu) return;

        header.classList.remove('is-menu-open');
        burger.classList.remove('is-active');
        menu.classList.remove('is-open');

        burger.setAttribute('aria-expanded', 'false');
        document.body.classList.remove('menu-open');
    }

    function toggleMenu() {
        if (!menu) return;

        if (menu.classList.contains('is-open')) {
            closeMenu();
        } else {
            openMenu();
        }
    }

    setHeaderScrolled();

    window.addEventListener('scroll', setHeaderScrolled);

    if (burger && menu) {
        burger.addEventListener('click', function (event) {
            event.preventDefault();
            toggleMenu();
        });
    }

    menuLinks.forEach(function (link) {
        link.addEventListener('click', closeMenu);
    });

    window.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeMenu();
        }
    });

    window.addEventListener('resize', function () {
        if (window.innerWidth > 991) {
            closeMenu();
        }
    });
});
