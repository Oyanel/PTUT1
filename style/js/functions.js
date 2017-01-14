$( window ).scroll(function() {
    if ($(window).scrollTop() >= 60 && $("nav.navbar").hasClass('navbar-default')) {
        $("nav.navbar").toggleClass('navbar-default');
        $("nav.navbar").toggleClass('navbar-inverse');
    }
    else if($(window).scrollTop() <= 60 && $("nav.navbar").hasClass('navbar-inverse')) {
        $("nav.navbar").toggleClass('navbar-default');
        $("nav.navbar").toggleClass('navbar-inverse');
    }
});

$(document).ready(function (){
   var screenHeight = $( window ).height() - (70 + $('footer .panel-footer').height());
   $('.map_container').attr("style","height:"+screenHeight + "px");
});