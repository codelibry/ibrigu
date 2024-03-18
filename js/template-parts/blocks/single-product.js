import $ from 'jquery';

function singleProduct(){
    $(document).ready(function(){
        const btnHeight = $('.single_add_to_cart_button').outerHeight(),
              sliderHeight = $(window).height() - btnHeight - $('header').outerHeight() - $('.woocommerce-breadcrumb').outerHeight() - 10,
              w = $(window).width();
        $('.singleProduct__buttonLeftCol, .singleProduct__attributesPicker__itemTitle').css('height', btnHeight);
        $('.singleProduct__imagesList .singleProduct__imagesList__item').css('height', sliderHeight);
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
        $('.singleProduct__imagesList').slick({
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
        $('.singleProduct__mainSlider').slick({
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
            asNavFor: '.singleProduct__mainSlider',
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
        element.parent().find('.singleProduct__attributesPicker__itemPopup__listItem').removeClass('active');
        element.addClass('active');
        $(`#${attr} option[value="${elementAttr}"]`).attr('selected', 'selected').change();
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
        $(document).ajaxSuccess(function(event, xhr, settings) {
            if(settings.data.split('action=')[1] != 'sideCartUpdate'){
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

}


export {singleProduct}