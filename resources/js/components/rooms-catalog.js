document.addEventListener('DOMContentLoaded', () => {

    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const transitionSpeed = reducedMotion ? 0 : 900;

    const toggleButtons =
        document.querySelectorAll('[data-room-toggle]');

    const roomPanels =
        document.querySelectorAll('[data-room-panel]');


    /*
     * Переключение категорий
     */
    toggleButtons.forEach((button) => {

        button.addEventListener('click', () => {

            const slug =
                button.dataset.roomToggle;


            toggleButtons.forEach((item) => {
                item.classList.remove('is-active');
            });


            roomPanels.forEach((panel) => {
                panel.classList.remove('is-active');
            });


            button.classList.add('is-active');


            const panel =
                document.querySelector(
                    `[data-room-panel="${slug}"]`
                );


            if (!panel) {
                return;
            }


            panel.classList.add('is-active');


            /*
             * Swiper создавался в скрытых блоках,
             * поэтому после открытия обновляем размеры.
             */
            requestAnimationFrame(() => {

                panel
                    .querySelectorAll('.swiper')
                    .forEach((element) => {

                        element.swiper?.update();

                    });

            });

        });

    });


    /*
     * Галереи
     */
    document
        .querySelectorAll('[data-room-slider]')
        .forEach((slider) => {

            if (typeof Swiper === 'undefined') {
                return;
            }


            const mainElement =
                slider.querySelector(
                    '[data-room-main-swiper]'
                );

            const sideElement =
                slider.querySelector(
                    '[data-room-side-swiper]'
                );


            if (!mainElement || !sideElement) {
                return;
            }


            const total =
                mainElement
                    .querySelectorAll('.swiper-slide')
                    .length;


            if (!total) {
                return;
            }


            const prevButton =
                slider.querySelector(
                    '[data-slider-prev]'
                );

            const nextButton =
                slider.querySelector(
                    '[data-slider-next]'
                );

            const counter =
                slider.querySelector(
                    '[data-slider-counter]'
                );


            /*
             * Главное фото
             */
            const mainSwiper =
                new Swiper(mainElement, {

                    slidesPerView: 1,

                    speed: transitionSpeed,

                    loop: total > 1,

                    grabCursor: total > 1,

                    simulateTouch: true,

                    allowTouchMove: total > 1,

                    effect: reducedMotion ? 'fade' : 'creative',

                    fadeEffect: { crossFade: true },

                    parallax: !reducedMotion,

                    creativeEffect: {
                        perspective: true,
                        limitProgress: 1,
                        shadowPerProgress: true,
                        prev: {
                            translate: ['-18%', 0, -280],
                            rotate: [0, -9, 0],
                            scale: .9,
                            opacity: .35,
                            shadow: true,
                        },
                        next: {
                            translate: ['100%', 0, 0],
                            rotate: [0, 8, 0],
                            scale: 1.05,
                            shadow: true,
                        },
                    },

                });


            /*
             * Правое превью.
             * Всегда показывает следующее фото.
             */
            const sideSwiper =
                new Swiper(sideElement, {

                    slidesPerView: 1,

                    speed: transitionSpeed,

                    loop: total > 1,

                    initialSlide:
                        total > 1 ? 1 : 0,

                    allowTouchMove: false,

                    effect: reducedMotion ? 'fade' : 'creative',

                    fadeEffect: { crossFade: true },

                    parallax: !reducedMotion,

                    creativeEffect: {
                        perspective: true,
                        limitProgress: 1,
                        shadowPerProgress: true,
                        prev: {
                            translate: ['-28%', 0, -160],
                            rotate: [0, -6, 0],
                            scale: .94,
                            opacity: .4,
                            shadow: true,
                        },
                        next: {
                            translate: ['100%', 0, 0],
                            rotate: [0, 6, 0],
                            scale: 1.03,
                            shadow: true,
                        },
                    },

                });


            let syncing = false;


            const update = () => {

                const current =
                    mainSwiper.realIndex;

                const next =
                    (current + 1) % total;


                if (counter) {
                    counter.textContent =
                        `${current + 1} / ${total}`;
                }


                if (
                    total > 1 &&
                    sideSwiper.realIndex !== next
                ) {

                    syncing = true;

                    sideSwiper.slideToLoop(
                        next,
                        transitionSpeed
                    );

                    setTimeout(() => {
                        syncing = false;
                    }, transitionSpeed + 20);

                }

            };


            /*
             * Главное фото можно свайпать.
             */
            mainSwiper.on(
                'slideChange',
                update
            );


            /*
             * Стрелки.
             */
            prevButton?.addEventListener(
                'click',
                () => {

                    mainSwiper.slidePrev();

                }
            );


            nextButton?.addEventListener(
                'click',
                () => {

                    mainSwiper.slideNext();

                }
            );


            /*
             * Клик по правому фото =
             * перейти к нему.
             */
            sideElement.addEventListener(
                'click',
                () => {

                    if (
                        total > 1 &&
                        !syncing
                    ) {
                        mainSwiper.slideNext();
                    }

                }
            );


            update();

        });

});
