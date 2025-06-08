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