function inRad(num) {
    return num * Math.PI / 180;
}

function drawTimer(progressPercentage, $slider) {
    var canvas = $slider.closest('.featured-brand-carousel').find('.canvas-timer')[0];
    if (!canvas) return;
    var ctx = canvas.getContext('2d');

    ctx.setTransform(1, 0, 0, 1, 0, 0); // restore default transform
    ctx.clearRect(0, 0, canvas.width, canvas.height); // clear the canvas

    // rotate the stage (to start drawing the arc from the top)
    ctx.rotate(inRad(-90));
    ctx.translate(-canvas.width, 0);

    // draw the full circle
    ctx.beginPath();
    ctx.lineWidth = 4;
    ctx.strokeStyle = 'rgba(255, 255, 255, 0.5)';
    ctx.arc(canvas.width/2, canvas.height/2, canvas.width/2 - ctx.lineWidth, inRad(0), inRad(360));
    ctx.stroke();

    // draw the timer line
    var progressAngle = progressPercentage * 360 / 100;
    ctx.beginPath();
    ctx.strokeStyle = '#fff';
    ctx.arc(canvas.width/2, canvas.height/2, canvas.width/2 - ctx.lineWidth, inRad(0), inRad(progressAngle));
    ctx.stroke();
}

function startTimer(time, $slider, slidesInfo) {
    var $timerWrap = $slider.closest('.featured-brand-carousel').find('.timer-wrap');
    if ($timerWrap.length && slidesInfo.total > 1) {
        $timerWrap.removeClass('d-none');
        $timerWrap.find('.total').text(slidesInfo.total);
        $timerWrap.find('.current').text(slidesInfo.current);
    }

    var startTime = new Date().getTime();
    var endTime = startTime + time;
    var intervalId = setInterval(function () {
        var currentTime = new Date().getTime();
        var timeToTheEnd = endTime - currentTime;
        if (timeToTheEnd <= 0) {
            drawTimer(100, $slider);
            clearInterval(intervalId);
            $slider.slick('slickNext');
        } else {
            var progressPercentage = (currentTime - startTime) * 100 / time;
            drawTimer(progressPercentage, $slider);
        }
    }, 10);

    return intervalId;
}

function init() {
    var $sliders = $('.featured-brand-carousel .region-wrap');
    $sliders.each(function() {
        var $slider = $(this);
        var intervalId = '';
        var autoplaySpeed = 10000;

        $slider.on('init', function(event, slick) {
            var slidesInfo = {
                total: slick.slideCount,
                current: slick.currentSlide + 1
            };
            intervalId = startTimer(autoplaySpeed, $slider, slidesInfo);
        });

        $slider.on('beforeChange', function(event, slick) {
            clearInterval(intervalId);
            var slidesInfo = {
                total: slick.slideCount,
                // the slick.currentSlide doesn't update properly on 'beforeChange' event
                current: slick.currentSlide + 2 > slick.slideCount ? 1 : slick.currentSlide + 2
            };
            intervalId = startTimer(autoplaySpeed, $slider, slidesInfo);
        });

        $slider.slick({
            slidesToShow: 1,
            initialSlide: 0,
            fade: true,
            autoplay: false,
            speed: 1000,
            arrows: false,
            dots: false
        });
    });
}

$(function() {
    init();
})
