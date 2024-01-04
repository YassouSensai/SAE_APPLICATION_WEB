document.addEventListener("DOMContentLoaded", function() {
    var header = document.querySelector(".header-page-générale");
    var lastScroll = 0;

    window.addEventListener("scroll", function() {
        var currentScroll = window.pageYOffset || document.documentElement.scrollTop;

        if (currentScroll > lastScroll && currentScroll > 60) {
            header.classList.add("header-hidden");
        } else {
            header.classList.remove("header-hidden");
        }
        lastScroll = currentScroll;
    });
});