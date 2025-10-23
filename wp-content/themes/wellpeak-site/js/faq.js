document.addEventListener("DOMContentLoaded", () => {
  const items = document.querySelectorAll(".faq-item");

  items.forEach((item) => {
    const btn = item.querySelector(".faq-question");
    const panel = item.querySelector(".faq-answer");

    btn.addEventListener("click", () => {
      const isOpen = item.classList.toggle("is-open");
      btn.setAttribute("aria-expanded", String(isOpen));
      panel.hidden = !isOpen;
    });
  });
});
