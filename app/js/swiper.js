document.addEventListener("DOMContentLoaded", function() {
    const swiper = document.getElementById("swiper");
    let isDown = false;
    let startX;
    let scrollLeft;

    swiper.addEventListener("touchstart", (e) => {
        isDown = true;
        startX = e.touches[0].pageX - swiper.offsetLeft;
        scrollLeft = swiper.scrollLeft;
    });
    
    swiper.addEventListener("touchend", () => {
        isDown = false;
        const sections = document.querySelectorAll(".swiper .container");
        const swiperRect = swiper.getBoundingClientRect();
        let closestSection;
        let minDistance = Infinity;
        sections.forEach(section => {
            const sectionRect = section.getBoundingClientRect();
            const distance = Math.abs(sectionRect.left - swiperRect.left);
            if (distance < minDistance) {
                minDistance = distance;
                closestSection = section;
            }
        });
        if (closestSection) {
            swiper.scrollLeft = closestSection.offsetLeft;
        }
    });
    
    swiper.addEventListener("touchmove", (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.touches[0].pageX - swiper.offsetLeft;
        const walk = (x - startX) * 3;
        swiper.scrollLeft = scrollLeft - walk;
    });
});