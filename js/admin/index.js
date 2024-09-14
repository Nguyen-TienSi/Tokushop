var buttons = document.querySelectorAll(".nav-item button");
buttons.forEach((button) => {
  button.addEventListener("click", () => {
    var subMenu = button.nextElementSibling;
    subMenu.classList.toggle("show");
  });
});
