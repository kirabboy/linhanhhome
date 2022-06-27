function formatNumber(n) {
    // format number 1000000 to 1,234,567
    return n.toString().replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}
$(document).ready(function() {
    $(".next").click(function() {
        $(".pagination")
            .find(".pageNumber.active")
            .next()
            .addClass("active");
        $(".pagination")
            .find(".pageNumber.active")
            .prev()
            .removeClass("active");
    });
    $(".prev").click(function() {
        $(".pagination")
            .find(".pageNumber.active")
            .prev()
            .addClass("active");
        $(".pagination")
            .find(".pageNumber.active")
            .next()
            .removeClass("active");
    });
});


$(function() {
    var slide_range = $("#sliderRange"), 
    price_min = parseInt(slide_range.data("min")), 
    price_max = parseInt(slide_range.data("max")), 
    price_min_current = parseInt(slide_range.data("min_current")), 
    price_max_current = parseInt(slide_range.data("max_current")), 
    price_step = parseInt(slide_range.data("step"));
    slide_range.slider({
      step: price_step,
      range: true, 
      min: price_min, 
      max: price_max, 
      values: [price_min_current, price_max_current], 
      slide: function(event, ui){
        $('input[name="price_min"]').val(ui.values[0]);
        $('input[name="price_max"]').val(ui.values[1]);
        $('.slider-time').html(formatNumber(ui.values[0]) + 'đ');
        $('.slider-time2').html(formatNumber(ui.values[1]) + 'đ');


      }
    });

  });

$(".sub-menu a").click(function() {
    $(this).parent(".sub-menu").children("ul").slideToggle("100");
    $(this).find(".right").toggleClass("fa-caret-up fa-caret-down");
});