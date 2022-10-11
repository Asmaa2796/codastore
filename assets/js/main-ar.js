/*global $*/
$(function () {
    "use strict";
    
    $('.navbar .nav-link[data-scroll]').click(function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: $('.' + $(this).data('scroll')).offset().top - 70
        }, 900);
    });

    // $('footer .links a').click(function (e) {
    //     e.preventDefault();
    //     $('html,body').animate({
    //         scrollTop: $('#' + $(this).data('scroll')).offset().top - 70
    //     }, 900);
    // });


    // scroll up
    $(window).scroll(function () {
        if ($(window).scrollTop() >= 100) {
          $('.scroll_up').fadeIn(500);
          $('.top').addClass('fixed-top');
        } else {
          $('.scroll_up').fadeOut(500);
          $('.top').removeClass('fixed-top');
        }
    });
    $('.scroll_up').click(function (e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, 1000);
    });

 

    function validateEmail($email) {
      var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test($email);
    }

    var cleanError = (function(){
        $(".has_error").removeClass("has_error").css('border', 'solid 2px green');
        $(".error_message").remove();
    });
    
    var showError = (function(Element,Message){
        Element.after( "<p class=\"error_message text-danger\" style=\"padding:10px 20px 3px 20px;font-size:13px\" >"+Message+"</p>" );
        Element.focus();
        Element.addClass("has_error");
        Element.css('border', 'solid 2px red');
    });


    // Increment & Decrement
    $(document).on('click','.increment-btn',function(e){
        e.preventDefault();
        var input_qty = $(this).closest(".product_data").find(".input-qty").val();
        var value = parseInt(input_qty,10);
        value = isNaN(value) ? 0 : value;
        var testQty = $('.testQty').val();
        
        if (value < testQty) {
            value++;
            $(this).closest(".product_data").find(".input-qty").val(value);
        }
        // check product qty [database] with input value [cart]
        else {
            alertify.success("Product Quantity less than this number");
            $(".increment-btn").prop("disabled", true);
        }
        $(".increment-btn").prop("disabled", false);
    });
    $(document).on('click','.decrement-btn',function(e){
        e.preventDefault();
        var input_qty = $(this).closest(".product_data").find(".input-qty").val();
        var value = parseInt(input_qty,10);
        value = isNaN(value) ? 0 : value;

        if(value > 1) {
            value--;
            $(this).closest(".product_data").find(".input-qty").val(value);
        }
    
    });

    // add to cart
    $('.add_to_cart').click(function(e){
        e.preventDefault();
        var input_qty = $(this).closest(".product_data").find(".input-qty").val();
        var product_id = $(this).val();
        // alert(product_id);

        $.ajax({
            method: "POST",
            url: "functions/handleCart.php",
            data: {
                "product_id" : product_id,
                "product_qty" : input_qty,
                "scope" : "add"
            },
            success: function (response) {
                if(response == 201) {
                    alertify.success("تمت إضافة المنتج إلى السلة");
                    $(".cart_table").load(location.href + " .cart_table");
                    $(".li-cart").load(location.href + " .li-cart");
                }
                else if(response == "existing") {
                    alertify.success("المنتج موجود بالفعل");
                }
                else if(response == 401) {
                    alertify.success("فم بتسجيل الدخول للاستمرار");
                }
                else if(response == 500) {
                    alertify.success("حدث خطأ ما");
                }
            }
        });
    });

    // update qty
    $(document).on('click','.updateQty',function(){
        var input_qty = $(this).closest(".product_data").find(".input-qty").val();
        var product_id = $(this).closest(".product_data").find(".hidden_id").val();
        $.ajax({
            method: "POST",
            url: "functions/handleCart.php",
            data: {
                "product_id" : product_id,
                "product_qty" : input_qty,
                "scope" : "update"
            },
            success: function (response) {
                if(response == 201) {
                    alertify.success("تم تحديث الكمية");
                }
            }
        });
    });

    // delete item
    $(document).on('click','.delete_item',function(){
        var cart_id = $(this).val();
        $.ajax({
            method: "POST",
            url: "functions/handleCart.php",
            data: {
                "cart_id" : cart_id,
                "scope" : "delete"
            },
            success: function (response) {
                if(response == 201) {
                    if($('.cart-section').length) {
                        window.location.reload();
                    }
                    else {
                        $(".cart_table").load(location.href + " .cart_table");
                        $(".li-cart").load(location.href + " .li-cart");
                        alertify.success("تم حذف المنتج بنجاح");
                    }
                }
                else {
                    alertify.success(response);
                }
            }
        });
    });

    // switch lang    
    // const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');

    // function switchTheme(e) {
    // if (e.target.checked) {
    //     document.documentElement.setAttribute("data-theme", "dark");
    // } else {
    //     document.documentElement.setAttribute("data-theme", "light");
    // }
    // }

    // toggleSwitch.addEventListener("change", switchTheme, false);

    // function switchTheme(e) {
    // if (e.target.checked) {
    //     document.documentElement.setAttribute("data-theme", "dark");
    //     localStorage.setItem("theme", "dark"); //add this
    // } else {
    //     document.documentElement.setAttribute("data-theme", "light");
    //     localStorage.setItem("theme", "light"); //add this
    // }
    // }

    // const currentTheme = localStorage.getItem("theme") ? localStorage.getItem("theme") : null;

    // if (currentTheme) {
    // document.documentElement.setAttribute("data-theme", currentTheme);

    // if (currentTheme === "dark") {
    //     toggleSwitch.checked = true;
    // }
    // }

    // loading
    $(window).ready(function () {
		$('.loading-overlay').delay(4000).fadeOut(2000);
	});

    $('#products').owlCarousel({
        // loop:true,
        margin:0,
        nav:true,
        dots:false,
        rtl:true,
        autoplaySpeed: 1400,
        navText: [
            '<i class="fas fa-arrow-right"></i>',
            '<i class="fas fa-arrow-left"></i>',
            ],
        navSpeed: 1400,
        autoplay:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    });
    $('#testimonials').owlCarousel({
        loop:true,
        margin:20,
        nav:false,
        dots:true,
        rtl:true,
        autoplaySpeed: 1400,
        navText: [
            '<i class="fas fa-arrow-right"></i>',
            '<i class="fas fa-arrow-left"></i>',
            ],
        navSpeed: 1400,
        autoplay:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:3
            }
        }
    });
    $('#related_products').owlCarousel({
        // loop:true,
        margin:0,
        nav:true,
        dots:false,
        rtl:true,
        autoplaySpeed: 1400,
        navText: [
            '<i class="fas fa-arrow-right"></i>',
            '<i class="fas fa-arrow-left"></i>',
            ],
        navSpeed: 1400,
        autoplay:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    });

    $('.li-cart').click(function(){
        $('.side-container').fadeIn();
        $('.side-container .side-menu').css('left','0px');
    });
    $('.side-container .overlay ,.side-container .times').click(function(){
        $('.side-container').fadeOut();
        $('.side-container .side-menu').css('left','-320px');
    });
    
    $(document).on('click','.product .add_to_cart',function(){
        $(".li-cart").load(location.href + " .li-cart");
        $(".cart_table").load(location.href + " .cart_table");
    });
});
