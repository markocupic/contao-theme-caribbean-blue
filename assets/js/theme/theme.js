/** Scroll to top button **/
document.addEventListener("DOMContentLoaded", function () {
  // Create the scroll-to-top button
  var scrollBtn = document.createElement("div");
  scrollBtn.classList.add("scroll-to-top");
  scrollBtn.innerHTML = '<a href="#"><span class="fa fa-regular fa-chevron-up"></span></a>';
  document.body.appendChild(scrollBtn);

  // Show or hide button based on scroll position
  window.addEventListener("scroll", function () {
    if (window.scrollY > 100) {
      scrollBtn.style.display = "flex";
    } else {
      scrollBtn.style.display = "none";
    }
  });

  // Scroll to top on click
  scrollBtn.addEventListener("click", function (event) {
    event.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  });
});

// Inject fontawesome icons to handorgel
document.addEventListener('DOMContentLoaded', () => {
  const elements = document.querySelectorAll('.handorgel__header__button');
  for (const el of elements) {
    el.insertAdjacentHTML('afterbegin', '<i class="icon-expand fa-light fa-plus-large"></i><i class="icon-collapse fa-light fa-dash"></i>');
  }
});

// Inject fontawesome icons to the sidebar navigation
document.addEventListener('csn:initialized', (e) => {
  const navigation = e.detail.nav_element;

  const elements = navigation.querySelectorAll('.toggle-submenu.csn--dropdown-toggle');
  for (const el of elements) {
    el.insertAdjacentHTML('afterbegin', '<i class="fa-regular fa-angle-right"></i>');
  }
});
