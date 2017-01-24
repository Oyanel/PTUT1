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
    var screenHeight = $( window ).height() - (80 + $('footer .panel-footer').height());
    $('.map_container').attr("style","height:"+screenHeight + "px");

    var filterCommuneWidth = $('button.filter_commune').width() + 40;
    var filterStationWidth = $('button.filter_station').width() + 40;

    var filterHeight = 26 * 6;

    $('ul.filter_commune').attr("style","width:"+filterCommuneWidth + "px; height:"+filterHeight + "px");
    $('ul.filter_station').attr("style","width:"+filterStationWidth + "px; height:"+filterHeight + "px");
});

