window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
    require('jquery.easing');

} catch (e) {}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo'

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    authEndpoint : baseURL+'/broadcasting/auth',
    encrypted: true
});


(function($) {
  "use strict"; // Start of use strict

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
        if( $('#discount_price').length ) {
            let discount = parseFloat($('#discount_price>.money').text());
            if(isNaN( discount ) || discount == '') return false;

            let price = total-discount;
            if(price<0) price = 0;
            $('#total_price>.money').text((price).toFixed(2));
        }
    }
    cart_subtotal();
    
})(jQuery); // End of use strict