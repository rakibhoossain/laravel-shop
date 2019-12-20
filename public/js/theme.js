; (function ($) {
    "use strict"


    var nav_offset_top = $('header').height() + 50;
    /*-------------------------------------------------------------------------------
	  Navbar 
	-------------------------------------------------------------------------------*/

    //* Navbar Fixed  
    function navbarFixed() {
        if ($('.header_area').length) {
            $(window).scroll(function () {
                var scroll = $(window).scrollTop();
                if (scroll >= nav_offset_top) {
                    $(".header_area").addClass("navbar_fixed");
                } else {
                    $(".header_area").removeClass("navbar_fixed");
                }
            });
        };
    };
    navbarFixed();

    /*----------------------------------------------------*/
    /*  Parallax Effect js
    /*----------------------------------------------------*/
    // function parallaxEffect() {
    //     $('.bg-parallax').parallax();
    // }
    // parallaxEffect();

    // var dropToggle = $('.widgets_inner .list li').has('ul').children('a');
    // dropToggle.on('click', function () {
    //     dropToggle.not(this).closest('li').find('ul').slideUp(200);
    //     $(this).closest('li').children('ul').slideToggle(200);
    //     return false;
    // });

    /*----------------------------------------------------*/
    /*  Isotope Fillter js
    /*----------------------------------------------------*/
    //	function gallery_isotope(){
    //        if ( $('.gallery_f_inner').length ){
    //            // Activate isotope in container
    //			$(".gallery_f_inner").imagesLoaded( function() {
    //                $(".gallery_f_inner").isotope({
    //                    layoutMode: 'fitRows',
    //                    animationOptions: {
    //                        duration: 750,
    //                        easing: 'linear'
    //                    }
    //                }); 
    //            });
    //			
    //            // Add isotope click function
    //            $(".gallery_filter li").on('click',function(){
    //                $(".gallery_filter li").removeClass("active");
    //                $(this).addClass("active");
    //
    //                var selector = $(this).attr("data-filter");
    //                $(".gallery_f_inner").isotope({
    //                    filter: selector,
    //                    animationOptions: {
    //                        duration: 450,
    //                        easing: "linear",
    //                        queue: false,
    //                    }
    //                });
    //                return false;
    //            });
    //        }
    //    }
    //    gallery_isotope();
    //	

    /*----------------------------------------------------*/
    /*  MailChimp Slider
    /*----------------------------------------------------*/
    // function mailChimp() {
    //     $('#mc_embed_signup').find('form').ajaxChimp();
    // }
    // mailChimp();

    $('select').niceSelect();

    /*----------------------------------------------------*/
    /*  Simple LightBox js
    /*----------------------------------------------------*/
    // $('.imageGallery1 .light').simpleLightbox();

    // $('.counter').counterUp({
    //     delay: 10,
    //     time: 1000
    // });


    /*----------------------------------------------------*/
    /*  Members Slider
    /*----------------------------------------------------*/
    //    function members_slider(){
    //        if ( $('.member_slider').length ){
    //            $('.member_slider').owlCarousel({
    //                loop:true,
    //                margin: 30,
    //                items: 3,
    //                nav: false,
    //                autoplay: false,
    //                smartSpeed: 1500,
    //                dots:true, 
    //				navContainer: '.testimonials_area',
    //                navText: ['<i class="lnr lnr-arrow-up"></i>','<i class="lnr lnr-arrow-down"></i>'],
    //                responsiveClass: true,
    //                responsive: {
    //                    0: {
    //                        items: 1,
    //                    },
    //                    768: {
    //                        items: 2,
    //                    },
    //                    992: {
    //                        items: 3,
    //                    },
    //                }
    //            })
    //        }
    //    }
    //    members_slider();


    /*----------------------------------------------------*/
    /*  Cart item update
    /*----------------------------------------------------*/
    $(document).ready(function(){

        $('.cart_u.increase').click(function(){
            cart_count_update(this, 'add');
        });

        $('.cart_u.reduced').click(function(){
            cart_count_update(this, '');
        });

        $('.product_count>.qty').keyup(function(){
            cart_update_keyup(this);
        });

        //payment option
        $('input[name=paymentoption]').click(function(){
            $(this).parents('.payment_item').removeClass('bKash cash rocket').addClass($(this).val() +' active');
        });
        $('.shipping select[name=shipping]').change(function(){
            let cost = parseFloat( $(this).find('option:selected').data('price') ) || 0;
            let subtotal = parseFloat( $('.order_sutotal').data('price') ); 
            let currency = $('.order_sutotal').data('currency'); 
            $('#order_total_price span').text( (subtotal + cost).toFixed(2) + currency );
        });

    });

    function cart_count_update(el, opt){
        let single_cart_item = $(el).parent().parent().parent('.single_cart_item');

        let cart_single_price = $(single_cart_item).find('.cart_single_price>.money');
        let cart_single_total = $(single_cart_item).find('.cart_single_total>.money');

        let single_price = parseFloat($(cart_single_price).text());
        let single_total = parseFloat($(cart_single_total).text());

        let qty = $(el).parent('.product_count').children('.qty');
        let val = parseInt( $(qty).val() );
        if(isNaN( val )) return false;

        if (opt=='add') {
            $(qty).val(++val);
            $(cart_single_total).text( (single_total + single_price).toFixed(2));

        }else{
            if(val>1) {
               $(qty).val(--val);
               $(cart_single_total).text( (single_total - single_price).toFixed(2));
           } 
        }

        cart_subtotal();

    }

    function cart_update_keyup(el){
        let single_cart_item = $(el).parent().parent().parent('.single_cart_item');

        let cart_single_price = $(single_cart_item).find('.cart_single_price>.money');
        let cart_single_total = $(single_cart_item).find('.cart_single_total>.money');

        let single_price = parseFloat($(cart_single_price).text());
        let single_total = parseFloat($(cart_single_total).text());

        let val = parseInt( $(el).val() );
        if(isNaN( val )) return false;
        $(cart_single_total).text( (single_price * val).toFixed(2));

        cart_subtotal();
    }

    function cart_subtotal(){
        let total = 0.0;
        $('#cart_item_list>.single_cart_item').each(function(){
            let val = parseFloat($(this).find('.cart_single_total>.money').text());
            if(isNaN( val ) || val == '') return false;
            total += val;
        });

        $('#subtotal_cart_price>.money').text((total).toFixed(2));
    }
    cart_subtotal();

    /*----------------------------------------------------*/
    /*  Members Slider
    /*----------------------------------------------------*/
    // function product_slider() {
    //     if ($('.feature_p_slider').length) {
    //         $('.feature_p_slider').owlCarousel({
    //             loop: true,
    //             margin: 30,
    //             items: 4,
    //             nav: false,
    //             autoplay: false,
    //             smartSpeed: 1500,
    //             dots: true,
    //             //				navContainer: '.testimonials_area',
    //             //                navText: ['<i class="lnr lnr-arrow-up"></i>','<i class="lnr lnr-arrow-down"></i>'],
    //             responsiveClass: true,
    //             responsive: {
    //                 0: {
    //                     items: 1,
    //                 },
    //                 360: {
    //                     items: 2,
    //                 },
    //                 576: {
    //                     items: 3,
    //                 },
    //                 768: {
    //                     items: 4,
    //                 },
    //             }
    //         })
    //     }
    // }
    // product_slider();

    /*----------------------------------------------------*/
    /*  Clients Slider
    /*----------------------------------------------------*/
    // function clients_slider() {
    //     if ($('.clients_slider').length) {
    //         $('.clients_slider').owlCarousel({
    //             loop: true,
    //             margin: 30,
    //             items: 5,
    //             nav: false,
    //             autoplay: false,
    //             smartSpeed: 1500,
    //             dots: false,
    //             responsiveClass: true,
    //             responsive: {
    //                 0: {
    //                     items: 1,
    //                 },
    //                 400: {
    //                     items: 2,
    //                 },
    //                 575: {
    //                     items: 3,
    //                 },
    //                 768: {
    //                     items: 4,
    //                 },
    //                 992: {
    //                     items: 5,
    //                 }
    //             }
    //         })
    //     }
    // }
    // clients_slider();

    /*----------------------------------------------------*/
    /*  Jquery Ui slider js
    /*----------------------------------------------------*/
    if ($("#slider-range").length > 0) {
        const max_value = parseInt( $("#slider-range").data('max') ) || 500;
        const min_value = parseInt($("#slider-range").data('min')) || 0;
        const currency = $("#slider-range").data('currency') || '';
        let price_range = min_value+'-'+max_value;

        if($("#price_range").length > 0 && $("#price_range").val()){
            price_range = $("#price_range").val().trim();
        }
        
        let price = price_range.split('-');
        $("#slider-range").slider({
            range: true,
            min: min_value,
            max: max_value,
            values: price,
            slide: function (event, ui) {
                $("#amount").val(currency + ui.values[0] + " -  "+currency+ ui.values[1]);
                $("#price_range").val(ui.values[0] + "-" + ui.values[1]);
            }
        });
    }
    if ($("#amount").length > 0) {
        const m_currency = $("#slider-range").data('currency') || '';
        $("#amount").val(m_currency + $("#slider-range").slider("values", 0) +
            "  -  "+m_currency + $("#slider-range").slider("values", 1));
    }
    // if ($("#price_range").length > 0) {
    //     $("#price_range").val($("#slider-range").slider("values", 0) +
    //         "-" + $("#slider-range").slider("values", 1));
    // }

    /*----------------------------------------------------*/
    /*  Google map js
    /*----------------------------------------------------*/

    // if ($('#mapBox').length) {
    //     var $lat = $('#mapBox').data('lat');
    //     var $lon = $('#mapBox').data('lon');
    //     var $zoom = $('#mapBox').data('zoom');
    //     var $marker = $('#mapBox').data('marker');
    //     var $info = $('#mapBox').data('info');
    //     var $markerLat = $('#mapBox').data('mlat');
    //     var $markerLon = $('#mapBox').data('mlon');
    //     var map = new GMaps({
    //         el: '#mapBox',
    //         lat: $lat,
    //         lng: $lon,
    //         scrollwheel: false,
    //         scaleControl: true,
    //         streetViewControl: false,
    //         panControl: true,
    //         disableDoubleClickZoom: true,
    //         mapTypeControl: false,
    //         zoom: $zoom,
    //         styles: [
    //             {
    //                 "featureType": "water",
    //                 "elementType": "geometry.fill",
    //                 "stylers": [
    //                     {
    //                         "color": "#dcdfe6"
    //                     }
    //                 ]
    //             },
    //             {
    //                 "featureType": "transit",
    //                 "stylers": [
    //                     {
    //                         "color": "#808080"
    //                     },
    //                     {
    //                         "visibility": "off"
    //                     }
    //                 ]
    //             },
    //             {
    //                 "featureType": "road.highway",
    //                 "elementType": "geometry.stroke",
    //                 "stylers": [
    //                     {
    //                         "visibility": "on"
    //                     },
    //                     {
    //                         "color": "#dcdfe6"
    //                     }
    //                 ]
    //             },
    //             {
    //                 "featureType": "road.highway",
    //                 "elementType": "geometry.fill",
    //                 "stylers": [
    //                     {
    //                         "color": "#ffffff"
    //                     }
    //                 ]
    //             },
    //             {
    //                 "featureType": "road.local",
    //                 "elementType": "geometry.fill",
    //                 "stylers": [
    //                     {
    //                         "visibility": "on"
    //                     },
    //                     {
    //                         "color": "#ffffff"
    //                     },
    //                     {
    //                         "weight": 1.8
    //                     }
    //                 ]
    //             },
    //             {
    //                 "featureType": "road.local",
    //                 "elementType": "geometry.stroke",
    //                 "stylers": [
    //                     {
    //                         "color": "#d7d7d7"
    //                     }
    //                 ]
    //             },
    //             {
    //                 "featureType": "poi",
    //                 "elementType": "geometry.fill",
    //                 "stylers": [
    //                     {
    //                         "visibility": "on"
    //                     },
    //                     {
    //                         "color": "#ebebeb"
    //                     }
    //                 ]
    //             },
    //             {
    //                 "featureType": "administrative",
    //                 "elementType": "geometry",
    //                 "stylers": [
    //                     {
    //                         "color": "#a7a7a7"
    //                     }
    //                 ]
    //             },
    //             {
    //                 "featureType": "road.arterial",
    //                 "elementType": "geometry.fill",
    //                 "stylers": [
    //                     {
    //                         "color": "#ffffff"
    //                     }
    //                 ]
    //             },
    //             {
    //                 "featureType": "road.arterial",
    //                 "elementType": "geometry.fill",
    //                 "stylers": [
    //                     {
    //                         "color": "#ffffff"
    //                     }
    //                 ]
    //             },
    //             {
    //                 "featureType": "landscape",
    //                 "elementType": "geometry.fill",
    //                 "stylers": [
    //                     {
    //                         "visibility": "on"
    //                     },
    //                     {
    //                         "color": "#efefef"
    //                     }
    //                 ]
    //             },
    //             {
    //                 "featureType": "road",
    //                 "elementType": "labels.text.fill",
    //                 "stylers": [
    //                     {
    //                         "color": "#696969"
    //                     }
    //                 ]
    //             },
    //             {
    //                 "featureType": "administrative",
    //                 "elementType": "labels.text.fill",
    //                 "stylers": [
    //                     {
    //                         "visibility": "on"
    //                     },
    //                     {
    //                         "color": "#737373"
    //                     }
    //                 ]
    //             },
    //             {
    //                 "featureType": "poi",
    //                 "elementType": "labels.icon",
    //                 "stylers": [
    //                     {
    //                         "visibility": "off"
    //                     }
    //                 ]
    //             },
    //             {
    //                 "featureType": "poi",
    //                 "elementType": "labels",
    //                 "stylers": [
    //                     {
    //                         "visibility": "off"
    //                     }
    //                 ]
    //             },
    //             {
    //                 "featureType": "road.arterial",
    //                 "elementType": "geometry.stroke",
    //                 "stylers": [
    //                     {
    //                         "color": "#d6d6d6"
    //                     }
    //                 ]
    //             },
    //             {
    //                 "featureType": "road",
    //                 "elementType": "labels.icon",
    //                 "stylers": [
    //                     {
    //                         "visibility": "off"
    //                     }
    //                 ]
    //             },
    //             {},
    //             {
    //                 "featureType": "poi",
    //                 "elementType": "geometry.fill",
    //                 "stylers": [
    //                     {
    //                         "color": "#dadada"
    //                     }
    //                 ]
    //             }
    //         ]
    //     });
    // }


})(jQuery)