const burgerCheckbox = document.querySelector('.burger-checkbox');
const mobileNav = document.querySelector('.nav-liens.mobile');

if (burgerCheckbox && mobileNav) {
  mobileNav.addEventListener('click', (e) => {
    if (e.target === mobileNav) {
      burgerCheckbox.checked = false;
    }
  });

  window.addEventListener('resize', () => {
    if (window.innerWidth > 768 && burgerCheckbox.checked) {
      burgerCheckbox.checked = false;
    }
  });
}
