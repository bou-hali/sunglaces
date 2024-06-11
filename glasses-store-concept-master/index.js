const navbar = document.querySelector(".navbar");
const menuBtn = document.querySelector(".menu-icon");
const menu = document.querySelector(".menu");

let menuOpen = false;

window.addEventListener("scroll", () => {
  if (menuOpen) {
    console.log("menu open")
  } else {
    if (window.scrollY >= 5) {
      navbar.style.transform = "translateY(0)";
      navbar.style.opacity = "1";
      navbar.style.transition = "all 0.5s ease";
    } else {
      // if (menu) {
      //   menu.style.display = "none";
      // }
      navbar.style.transform = "translateY(-100%)";
      navbar.style.opacity = "0.8";
      navbar.style.transition = "all 0.5s ease";
    }
  }
});

if (menuBtn) {
  menuBtn.addEventListener("click", () => {
    menuOpen = !menuOpen;
    if (menuBtn.innerText === "close") {
      menuBtn.innerText = "menu";
      menu.style.transform = "translateX(100%)";
    } else {
      menuBtn.innerText = "close";
      menu.style.transform = "translateX(-100%)";
    }
  });
}
