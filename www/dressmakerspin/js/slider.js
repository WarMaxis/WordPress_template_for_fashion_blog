var $ = jQuery.noConflict();
function tick() {
    var $obj = $(".blog-header .slider-box .slides");
    $obj.first().fadeIn().delay(3000).fadeOut(function () {
        $obj.first().insertAfter($obj.last());
        tick();
    });
}
tick();
