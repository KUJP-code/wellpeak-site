document.addEventListener("DOMContentLoaded", function () {
  var el = document.querySelector(".news-thumbs-swiper");
  if (!el || typeof Swiper === "undefined") return;

  new Swiper(".news-thumbs-swiper", {
    slidesPerView: 4,
    spaceBetween: 16,
    speed: 450,
    loop: false,
    navigation: {
      nextEl: ".news-controls .news-next",
      prevEl: ".news-controls .news-prev",
    },

    breakpoints: {
      0: { slidesPerView: 1.2, spaceBetween: 12 },
      576: { slidesPerView: 2.2, spaceBetween: 14 },
      768: { slidesPerView: 3, spaceBetween: 16 },
      1024: { slidesPerView: 4, spaceBetween: 20 },
    },
  });
});
