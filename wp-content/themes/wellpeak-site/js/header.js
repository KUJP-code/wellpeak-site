document.addEventListener("DOMContentLoaded", () => {
  const toggle = document.querySelector(".nav-toggle");
  const nav = document.getElementById("primary-nav");
  const navInner = nav?.querySelector(".nav-inner");
  const mq = window.matchMedia("(max-width: 991.98px)");
  if (!toggle || !nav || !navInner) return;

  let isAnimating = false;

  function openNav() {
    if (isAnimating || !mq.matches) return;
    isAnimating = true;

    const innerHeight = navInner.scrollHeight;
    nav.classList.add("is-open");
    nav.style.height = "0px";

    requestAnimationFrame(() => {
      nav.style.height = innerHeight + "px";
      toggle.setAttribute("aria-expanded", "true");
    });
  }

  function closeNav() {
    if (isAnimating || !mq.matches) return;
    isAnimating = true;

    const currentHeight = navInner.scrollHeight;
    nav.style.height = currentHeight + "px";

    requestAnimationFrame(() => {
      nav.style.height = "0px";
      toggle.setAttribute("aria-expanded", "false");
    });
  }

  nav.addEventListener("transitionend", (e) => {
    if (e.propertyName !== "height" || !mq.matches) return;
    const expanded = toggle.getAttribute("aria-expanded") === "true";

    if (expanded) {
      // stay at full height for resizing
      nav.style.height = "auto";
    } else {
      nav.classList.remove("is-open");
      nav.style.height = "0";
    }
    isAnimating = false;
  });

  toggle.addEventListener("click", () => {
    if (isAnimating || !mq.matches) return;
    const expanded = toggle.getAttribute("aria-expanded") === "true";
    expanded ? closeNav() : openNav();
  });

  mq.addEventListener("change", () => {
    // Reset when resizing back to desktop
    nav.style.height = "";
    nav.classList.remove("is-open");
    toggle.setAttribute("aria-expanded", "false");
  });
});
