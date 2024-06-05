var swiper = new Swiper(".mySwiperTesti", {
  spaceBetween: 20,
  slidesPerView: 5,
  pagination: {
    el: ".swiper-pagination",
    dynamicBullets: true,
  },
  autoplay: {
    delay: 1200,
  },
  breakpoints: {
    350: {
      slidesPerView: 1,
    },
    600: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1200: {
      slidesPerView: 3,
    },
  },
});
