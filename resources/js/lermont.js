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

function checkDates() {}

function searchRooms() {}

function watchVideo() {}

function openBooking() {}

function initSwiper(selector, nextEl, prevEl) {
    const slider = document.querySelector(selector);

    if (!slider || typeof Swiper === 'undefined') {
        return null;
    }

    return new Swiper(selector, {
        slidesPerView: 1,
        spaceBetween: 24,
        loop: false,
        navigation: {
            nextEl: nextEl,
            prevEl: prevEl
        },
        breakpoints: {
            0: {
                slidesPerView: 1.08,
                spaceBetween: 16
            },
            576: {
                slidesPerView: 1.6,
                spaceBetween: 18
            },
            768: {
                slidesPerView: 2.2,
                spaceBetween: 20
            },
            992: {
                slidesPerView: 3,
                spaceBetween: 20
            },
            1200: {
                slidesPerView: 4,
                spaceBetween: 24
            }
        }
    });
}

function updateNavButtons(swiper, prefix) {
    if (!swiper) return;

    const prevBtn = document.getElementById(prefix + '-prev');
    const nextBtn = document.getElementById(prefix + '-next');

    if (!prevBtn || !nextBtn) return;

    if (swiper.activeIndex > 0) {
        prevBtn.classList.remove('d-none');
    } else {
        prevBtn.classList.add('d-none');
    }

    if (swiper.isEnd) {
        nextBtn.classList.add('d-none');
    } else {
        nextBtn.classList.remove('d-none');
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const roomsSwiper = initSwiper('.rooms-slider', '#rooms-next', '#rooms-prev');

    if (roomsSwiper) {
        updateNavButtons(roomsSwiper, 'rooms');
        roomsSwiper.on('slideChange', function () {
            updateNavButtons(roomsSwiper, 'rooms');
        });
    }

    const offersSwiper = initSwiper('.offers-slider', '#offers-next', '#offers-prev');

    if (offersSwiper) {
        updateNavButtons(offersSwiper, 'offers');
        offersSwiper.on('slideChange', function () {
            updateNavButtons(offersSwiper, 'offers');
        });
    }
});