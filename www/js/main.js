(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    
    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.sticky-top').addClass('bg-white shadow-sm').css('top', '0px');
            $('.navbar').removeClass('header-border-bottom');
        } else {
            $('.sticky-top').removeClass('bg-white shadow-sm').css('top', '-150px');
            $('.navbar').addClass('header-border-bottom');
        }
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Header carousel
    $(".header-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        loop: true,
        dots: true,
        items: 1
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        items: 1,
        autoplay: true,
        smartSpeed: 1000,
        animateIn: 'fadeIn',
        animateOut: 'fadeOut',
        dots: true,
        loop: true,
        nav: false
    });
    
})(jQuery);

$(document).ready(function(){
    $("form[name='frm-contact']").submit(function(e){
        e.preventDefault();
        var formData = $(this).serializeArray();
        $.ajax({
            url: "frm-email.php",
            type: "POST",
            data: formData,
            dataType: "json",
            success: function(response){
                if(response.status == "success"){
                    $("#form-message").html("<div class='alert alert-success'>Your request has been submitted. We will contact you soon!</div>");
                    $("form[name='frm-contact']")[0].reset();
                }else{
                    $("#form-message").html("<div class='alert alert-danger'>Error: " + response.message + "</div>");
                }
            },
            error: function(){
                $("#form-message").html("<div class='alert alert-danger'>Server error! Please try again.</div>");
            }
        });
    });
});
