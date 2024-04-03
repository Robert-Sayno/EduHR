document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById("container");
    let startX;
    let currentCard = 0;

    container.addEventListener("touchstart", (e) => {
        startX = e.touches[0].clientX;
    });

    container.addEventListener("touchmove", (e) => {
        const diffX = e.touches[0].clientX - startX;
        container.style.transform = `translateX(${-currentCard * 100 + diffX}px)`;
    });

    container.addEventListener("touchend", () => {
        const threshold = 50; // Adjust the threshold for swipe sensitivity

        if (Math.abs(startX - event.changedTouches[0].clientX) < threshold) {
            return;
        }

        if (startX > event.changedTouches[0].clientX && currentCard < 1) {
            currentCard++;
        } else if (startX < event.changedTouches[0].clientX && currentCard > 0) {
            currentCard--;
        }

        container.style.transform = `translateX(${-currentCard * 100}%)`;
    });
});
