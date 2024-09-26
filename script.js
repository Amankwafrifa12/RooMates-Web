/* Header Hide and Show */
let lastScrollTop = 0;
const header = document.getElementById("header");
const banner = document.getElementById("banner");

window.addEventListener("scroll", function() {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    let documentHeight = document.documentElement.scrollHeight - window.innerHeight;
    let threshold = documentHeight * 0.05; // 5% of the total scrollable height

    if (scrollTop > lastScrollTop) {
        // Scroll Down
        banner.style.transform = "translateY(-100%)"; // Hide header
        banner.style.display = "none";
    } else {
        // Scroll Up
        if (scrollTop <= threshold) {
            banner.style.transform = "translateY(0)"; // Show header
            banner.style.display = "flex";
        }
    }

    lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // For Mobile or negative scrolling
});
