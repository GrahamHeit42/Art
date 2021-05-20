$(document).ready(function() {


$('.gallertab').owlCarousel({
    loop:true,
    nav :true,
    navText :["<i class='fas fa-chevron-left'></i>","<i class='fas fa-chevron-right'></i>"],
    dots:false,
    responsive:{
        0:{
            items:1
        },
        400:{
            items:2
        },
        500:{
            items:3
        },
        600:{
            items:3
        },
        700:{
            items:4
        },
        800:{
            items:4
        },
        900:{
            items:5
        },
        1000:{
            items:5
        },
        1100:{
            items:6
        },
        1200:{
            items:7
        },
        1300:{
            items:7
        },
        1400:{
            items:8
        }
    }
});

$('.postslider').owlCarousel({
    loop:true,
    nav :true,
    navText :["<i class='fas fa-chevron-left'></i>","<i class='fas fa-chevron-right'></i>"],
    dots:false,
    items:1
});
/*================= Pop up option js =================*/

    var x = document.getElementById("popup-option");
    if (x.style.display === "none" || x.style.display === "") {
      x.style.display = "inline-block";
    } else {
      x.style.display = "none";
    }

/*================= artist-commissoner dropdown js =================*/

$('.js-example-basic-multiple').select2({});
// $('.subject-matter-dropdown').select2({});
// $('.medium-matter-dropdown').select2({});

// post page tabing js

$( "#postdetails" ).tabs({});


});
