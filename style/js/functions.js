$( window ).scroll(function() {
    if ($(window).scrollTop() >= 60 && $("nav.navbar").hasClass('navbar-default') == false)
        $("nav.navbar").toggleClass('navbar-default');
    else if($(window).scrollTop() <= 60 && $("nav.navbar").hasClass('navbar-default'))
        $("nav.navbar").toggleClass('navbar-default');
});