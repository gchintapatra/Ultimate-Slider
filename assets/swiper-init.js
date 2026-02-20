document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.uss-slider').forEach(function (slider) {
        new Swiper(slider, USS_SETTINGS);
    });
});
