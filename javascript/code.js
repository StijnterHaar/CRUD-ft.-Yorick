// Fade in elements
function fadeIn(element, transitionTime, delayInMs) {
    setTimeout(
        function() {
            document.querySelector(element).style.transition = transitionTime;
            document.querySelector(element).style.opacity = "1";
        }, delayInMs);
}

// Run when page loaded
window.onload = function() {
    fadeIn("html", "0.5s", 1 );
    fadeIn(".coverlabel", "3s", 1 );
};

