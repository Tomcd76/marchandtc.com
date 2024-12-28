var radioButtons = document.querySelectorAll('input[name="carousel-css"]');

radioButtons.forEach(function(radioButton) {
    radioButton.addEventListener('change', function() {
        var slideNumber = this.value.split('-')[1];
        var video = document.querySelector('.carousel-slide:nth-child(' + slideNumber + ') video');

        document.querySelectorAll('.carousel-slide video').forEach(function(video) {
            video.pause();
        });

        video.play();
    });
});

