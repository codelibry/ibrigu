import $ from 'jquery';

function singleProduct(){
    
    $(document).ready(function(){



        const btnHeight = $('.single_add_to_cart_button').outerHeight(),
              sliderHeight = $(window).innerHeight() - $('header').outerHeight() - $('.singleProduct__breadcrumbsWrapper .woocommerce-breadcrumb').outerHeight() - btnHeight,
              w = $(window).width();
        $('.singleProduct__buttonLeftCol, .singleProduct__attributesPicker__itemTitle').css('height', btnHeight);
        console.log(sliderHeight);
        $('.singleProduct__imagesList .woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image, .singleProduct__imagesList .woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image--placeholder').css('height', sliderHeight);
        if($('body').hasClass('single-product')){
            $(window).scrollTop(0);
            let descHeight;
            if(w > 769){
                descHeight = $('.desktop .singleProduct__description .singleProduct__descriptionText').outerHeight() + $('.desktop .singleProduct__description .attributesItem__list').outerHeight();
            }
            else{
                descHeight = $('.mobile .singleProduct__description .singleProduct__descriptionText').outerHeight() + $('.mobile .singleProduct__description .attributesItem__list').outerHeight();
            }
            $('.showContentBtn').click(function(){
                $('.singleProduct__description__wrapper').toggleClass('opened');
                if($(this).hasClass('more')){
                    $('.singleProduct__description').animate({'max-height': descHeight}, 300);
                }
                else{
                    $('.singleProduct__description').animate({'max-height': '3.5em'}, 300);
                }
            });
            $('.singleProduct__infoTab__title').click(function(){
                $(this).closest('.singleProduct__infoTab__wrapper').find('.singleProduct__infoTab__popup').addClass('opened');
            });
            $('.singleProduct__infoTab__popupClose').click(function(){
                $(this).parent().removeClass('opened');
            });
        }
        if($('body').hasClass('woocommerce-wishlist')){
            let sliderOptions = {
                slidesToScroll: 1,
                slidesToShow: 3,
                responsive: [
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                            arrows: false,
                            dots: true,
                        },
                    },
                ],
            };
            $('.relatedProducts__list').slick(sliderOptions);
        } else{
            let sliderOptions = {
                slidesToScroll: 1,
                slidesToShow: 4,
                arrows: false,
                dots: true,
                infinite: false,
                responsive: [
                    {
                        breakpoint: 993,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        },
                    },
                ],
            };
            $('.relatedProducts__list').slick(sliderOptions);
        };
        $('.singleProduct__imagesList .woocommerce-product-gallery__wrapper').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            dots: true,
            arrows: false,
            vertical: true,
            verticalSwiping: true,
            infinite: false,
        });
        if($('.productAddTocart').hasClass('variable')){
            const attrsTop = $('.singleProduct__description__wrapper .singleProduct__attributesPicker').offset().top + $('.singleProduct__description__wrapper .singleProduct__attributesPicker').outerHeight() - $('.singleProduct__description__wrapper .singleProduct__attributesPicker').height();
            if(attrsTop < $('.single_add_to_cart_button').offset().top){
                $('.single_add_to_cart_button').addClass('absolute');
                $('.single_add_to_cart_button').css('top', attrsTop);
            }
        }
        $('.singleProduct__mainSlider .woocommerce-product-gallery__wrapper').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            dots: true,
            asNavFor: '.singleProduct__sideSlider'
        });
        $('.singleProduct__sideSlider').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            asNavFor: '.singleProduct__mainSlider .woocommerce-product-gallery__wrapper',
            focusOnSelect: true,
            vertical: true,
            verticalSwiping: true,
            arrows: false,
        });
    });
    $(window).scroll(function(){
        if($('.productAddTocart').hasClass('variable')){
            const attrsTop = $('.singleProduct__description__wrapper .singleProduct__attributesPicker').offset().top + $('.singleProduct__description__wrapper .singleProduct__attributesPicker').outerHeight() - $('.singleProduct__description__wrapper .singleProduct__attributesPicker').height();
            if(attrsTop < $('.single_add_to_cart_button').offset().top){
                $('.single_add_to_cart_button').addClass('absolute');
                $('.single_add_to_cart_button').css('top', attrsTop);
            }
            if($('.singleProduct__attributesPicker').outerHeight() > $(window).scrollTop()) {
                $('.single_add_to_cart_button').removeClass('absolute');
                $('.single_add_to_cart_button').css('top', 'auto');
            }
        }
    });
    $('.singleProduct__attributesPicker__itemTitle').click(function(){
        if(!$(this).parent().find('.singleProduct__attributesPicker__itemPopup').hasClass('opened')){
            $('.singleProduct__attributesPicker__itemPopup').removeClass('opened');
            $(this).parent().find('.singleProduct__attributesPicker__itemPopup').toggleClass('opened');
        }else{
            $('.singleProduct__attributesPicker__itemPopup').removeClass('opened');
        }
    });
    $('.singleProduct__attributesPicker__itemPopup__close').click(function(){
        $(this).parent().removeClass('opened');
    });
    $('.singleProduct__attributesPicker__itemPopup__guide .popup-toggle').click(function(){
        $('.singleProduct__attributesPicker__itemPopup__guide').toggleClass('openedPopup');
    });
    $(document).ready(function(){
        if($('.variations_form').length >= 1 && $('body').hasClass('single-product')){
            $('form.variations_form .variations tr').each(function(){
                console.log($(this).find('select option').length);
                if($(this).find('select option').length == 2){
                    $(this).find('select option').last().attr('selected', 'selected');
                }
            })
        }
    });
    $('.singleProduct__attributesPicker__itemPopup__listItem').click(function(){
        const element = $(this),
              elementAttr = element.find('.singleProduct__attributesPicker__itemPopup__listItem__title').attr('data-item'),
              attr = element.closest('.singleProduct__attributesPicker__item').attr('data-attribute');
        element.parent().find('.singleProduct__attributesPicker__itemPopup__listItem').not(element).removeClass('active');
        element.toggleClass('active');
        if(element.hasClass('active')){
            $(`#${attr} option[value="${elementAttr}"]`).attr('selected', 'selected').change();
        } else{
            $(`#${attr} option:first-child`).attr('selected', 'selected').change();
        }
    });
    if($('body').hasClass('single-product') && $('.woocommerce-notices-wrapper > div').length > 0){
        $('<div class="scroller"></div>').prependTo('.woocommerce-notices-wrapper');
        $('.scroller').animate({
            width: 0,
        }, 10000, function() {
            $('.woocommerce-notices-wrapper > div').remove();
        });
    }
    $('.single_add_to_cart_button').click(function(){
        if(!$(this).hasClass('disabled')){
            $(document).ajaxSuccess(function(event, xhr, settings) {
                let wishlistAction = '';
                if(settings.data.split('action=')[1] != undefined && settings.data.split('action=')[1].split('&')[0]){
                    wishlistAction = settings.data.split('action=')[1].split('&')[0];
                }
                if(settings.data.split('action=')[1] != 'sideCartUpdate' && wishlistAction != 'add_to_wishlist' && wishlistAction != 'delete_item' && wishlistAction != 'load_fragments'){
                    $.ajax({
                        url: customjs_ajax_object.ajax_url,
                        type: 'POST',
                        data: {
                            number: $('.lii-single-product').length,
                            action: 'sideCartUpdate',
                        },
                        success: function( response ) {
                            $('.cartSidebar__content').html(response);
                            $('.cartSidebar').addClass('cart-opened');
                        },
                    });
                }
            });
        }
    });
    $(document).ajaxComplete(function(event, xhr, settings) {
        var actionName = settings.url.split('/?wc-ajax='); 
        if(actionName[1] == 'lii_ajaxcart_update_item_quantity'){
            $.ajax({
                url: customjs_ajax_object.ajax_url,
                type: 'POST',
                data: {
                    action: 'sideCartUpdate',
                },
                success: function( response ) {
                    $('.cartSidebar__list').html(response);
                },
            });
        }
    });


   

    $(document).on('touchstart', function(e) {
        document.addEventListener('touchstart', handleTouchStart, false);        
        document.addEventListener('touchmove', handleTouchMove, false);
    });
    $('.singleProduct__imagesList').on('touchmove', function(e) {
        e.stopPropagation();
    });

    var xDown = null;                                                        
    var yDown = null;

    function getTouches(evt) {
    return evt.touches ||             
            evt.originalEvent.touches; 
    }                                                     
                                                                            
    function handleTouchStart(evt) {
        if($(window).width() < 770){
            const firstTouch = getTouches(evt)[0];                                      
            xDown = firstTouch.clientX;                                      
            yDown = firstTouch.clientY; 
        }                                     
    };                                                
    

    function handleTouchMove(evt) {
        if($(window).width() < 770){
            const itemOffset = $('.singleProduct__attributesPicker').offset().top - 140;
        

            if ( ! xDown || ! yDown ) {
                return;
            }

            var xUp = evt.touches[0].clientX;                                    
            var yUp = evt.touches[0].clientY;

            var xDiff = xDown - xUp;
            var yDiff = yDown - yUp;
                                                                                
            if ( Math.abs( xDiff ) < Math.abs( yDiff ) ) {
                if ( yDiff > 0 ) {
                    
                    if($(window).scrollTop() < 100){
                        $('html, body').animate({
                            scrollTop: itemOffset,
                        }, 100);
                    }
                } else { 
                    
                    if($(window).scrollTop() <= itemOffset + 10 || $(window).scrollTop() <= itemOffset - 10){
                        $('html, body').animate({
                            scrollTop: 0,
                        }, 100);
                    } 
                }   
            } 
            
            xDown = null;
            yDown = null;   
        }                                          
    };

    $(document).ready(function(){
        const w = $(window).width();
        if(w > 769){
            $('.singleProduct__imagesList').remove();
        }
    });


    let imageUrl = $('.woocommerce-product-gallery__image[data-slick-index="-1"] a').attr('href');
    $('.attributes-picker-item').click(function(){
        setTimeout(function(){
            if($('.woocommerce-product-gallery__image[data-slick-index="-1"] a').attr('href') != imageUrl) {
                $('.woocommerce-product-gallery__image[data-slick-index="0"]').attr('data-thumb', $('.woocommerce-product-gallery__image[data-slick-index="-1"] a').attr('href'));
                $('.woocommerce-product-gallery__image[data-slick-index="0"] a').attr('href', $('.woocommerce-product-gallery__image[data-slick-index="-1"] a').attr('href'));
                $('.woocommerce-product-gallery__image[data-slick-index="0"] img').attr('srcset', $('.woocommerce-product-gallery__image[data-slick-index="-1"] a').attr('href'));

                imageUrl = $('.woocommerce-product-gallery__image[data-slick-index="-1"] a').attr('href');
            }
        }, 100)
    });

    const w = $(window).width();
    $(document).ajaxSuccess(function(event, xhr, settings) {
        if(settings.data.split('action=')[1] != undefined && settings.data.split('action=')[1].split('&')[0] == 'load_fragments'){
            let descId = $('.singleProduct__wishlist .yith-wcwl-add-button > a').attr('data-product-id'),
                tabDescId = $('.singleProduct__wishlist .yith-wcwl-add-button > a').attr('data-product-id');

            if($(`.singleProduct__descriptionText .product-desc-${descId}`).length == 0){
                descId = 'simple';
            }
            if($(`.singleProduct__infoTab__popupText.desc.product-desc-${tabDescId}`).length == 0){
                tabDescId = 'simple';
            }
            $(`.singleProduct__descriptionText .singleProduct__descriptionText__item`).removeClass('active');
            $(`.singleProduct__descriptionText .product-desc-${descId}`).addClass('active');

            $(`.singleProduct__infoTab__popupText.desc`).removeClass('active');
            $(`.singleProduct__infoTab__popupText.desc.product-desc-${tabDescId}`).addClass('active');


            $(`.singleProduct__attributesPicker__itemPopup__text`).removeClass('active');
            $(`.singleProduct__attributesPicker__itemPopup__text-${$('.singleProduct__wishlist .yith-wcwl-add-button > a').attr('data-product-id')}`).addClass('active');

            let descHeight;
            if(w > 769){
                descHeight = $('.desktop .singleProduct__description .singleProduct__descriptionText').outerHeight() + $('.desktop .singleProduct__description .attributesItem__list').outerHeight();
            }
            else{
                descHeight = $('.mobile .singleProduct__description .singleProduct__descriptionText').outerHeight() + $('.mobile .singleProduct__description .attributesItem__list').outerHeight();
            }
            $('.showContentBtn').off('click').click(function(){
                $('.singleProduct__description__wrapper').toggleClass('opened');
                if($(this).hasClass('more')){
                    $('.singleProduct__description').animate({'max-height': descHeight}, 300);
                }
                else{
                    $('.singleProduct__description').animate({'max-height': '3.5em'}, 300);
                }
            });
        }

    });
    //Change Available Attributes 
    $('.singleProduct__attributesPicker__itemPopup__listItem').click(function(){
        const attributeName = $(this).closest('.singleProduct__attributesPicker__item').attr('data-attribute');
        let attributes = [];

        $(document).ajaxSuccess(function(event, xhr, settings){
            if(settings.data.split('action=')[1] != undefined && settings.data.split('action=')[1].split('&')[0] == 'load_fragments'){
                if(attributeName == 'pa_size'){
                    $('.mobile #pa_color option').each(function(){
                        attributes.push($(this).attr('value'));
                    });
                    
                    $('.singleProduct__attributesPicker__item[data-attribute="pa_color"] .singleProduct__attributesPicker__itemPopup__list .singleProduct__attributesPicker__itemPopup__listItem').removeClass('disabled');

                    $('.singleProduct__attributesPicker__item[data-attribute="pa_color"] .singleProduct__attributesPicker__itemPopup__list .singleProduct__attributesPicker__itemPopup__listItem').each(function(){
                        if($.inArray($(this).find('.singleProduct__attributesPicker__itemPopup__listItem__title').attr('data-item'), attributes) === -1){
                            $(this).addClass('disabled');
                        }
                    });
                }
                if(attributeName == 'pa_color'){
                    $('.mobile #pa_size option').each(function(){
                        attributes.push($(this).attr('value'));
                    });
                    
                    $('.singleProduct__attributesPicker__item[data-attribute="pa_size"] .singleProduct__attributesPicker__itemPopup__list .singleProduct__attributesPicker__itemPopup__listItem').removeClass('disabled');

                    $('.singleProduct__attributesPicker__item[data-attribute="pa_size"] .singleProduct__attributesPicker__itemPopup__list .singleProduct__attributesPicker__itemPopup__listItem').each(function(){
                        if($.inArray($(this).find('.singleProduct__attributesPicker__itemPopup__listItem__title').attr('data-item'), attributes) === -1){
                            $(this).addClass('disabled');
                        }
                    });
                }
            }
        });
    })

}


export {singleProduct}