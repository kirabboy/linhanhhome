var elm = $("#homepage ul.nav a.nav-link"), elm_fix = $(".header-main ul.nav a.nav-link"), 
url_current = window.location.href, 
url_origin   = $("meta[name='url-home']").attr("content");
activeMenuFix(elm_fix);
activeMenu(elm);
function activeMenuFix(elm) {
    if(url_current == url_origin + '/'){
        $(elm[0]).addClass("active");
        
    }else{
        elm.map(function(index, item) {
            if(url_current == item.href) {
                $(item).addClass("active");
        
            }
        });
    }
}

function activeMenu(elm) {
    if(url_current == url_origin + '/'){
        $(elm[0]).addClass("active");
        
    }else{
        elm.map(function(index, item) {
            if(url_current == item.href) {
                $(item).addClass("active");
        
            }
        });
    }
}


$(function() {
    var header = $(".header-main");
    $(window).scroll(function() {
        var scroll = $(window).scrollTop();
        if (scroll >= 500) {
            header.addClass("stuck");
        } else {
            header.removeClass("stuck");
        }
    });
});