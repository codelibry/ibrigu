import $ from 'jquery';

function checkout(){
    $('.formResult .edit').click(function(){
        $('.formResult').slideUp();
        $('.checkoutUserInfoTab__forms').slideDown();
    });
    $(document).ready(function(){
        $('#customer_details .woocommerce-billing-fields .validate-required').each(function(){
            if($(this).find('input').val() != ''){
                $(this).addClass('filled');
            }
        });
    });
    $('.checkoutTabs__listItem__sublistTitle').click(function(){
        $('.checkoutTabs__listItem__sublist').not($(this).closest('.checkoutTabs__listItem__sublist')).slideUp();
        $('.checkoutTabs__listItem__sublistContent').slideDown();
        $(this).closest('.checkoutTabs__listItem__sublist').find('.checkoutTabs__listItem__sublistContent').slideDown();
        $(this).closest('.checkoutTabs__listItem__sublist').addClass('active');
    });
    $('.checkoutContent .registerFormLink .link').click(function(){
        $(this).closest('.checkoutTabs__listItem__sublist').slideUp().removeClass('active');
        $(this).closest('.checkoutTabs__listItem').find('.new-account').addClass('active').slideDown();
    });
    
    $('.checkoutContent .loginFormLink .link').click(function(){
        $(this).closest('.checkoutTabs__listItem__sublist').slideUp().removeClass('active');
        $(this).closest('.checkoutTabs__listItem').find('.login-tab').addClass('active').slideDown();
    });

    $('#customer_details .validate-required input').on('input', function(){
        if($(this).val().trim() != ''){
            $(this).closest('.form-row').removeClass('empty');
        }else{
            $(this).closest('.form-row').addClass('empty');
        }
    });

    $('.checkoutShipping__continue').click(function(){
        let checkFieldsCValid = true;
        $('#customer_details .woocommerce-billing-fields .validate-required').each(function(){
            if(!$(this).hasClass('woocommerce-validated') && !$(this).hasClass('filled') || $(this).find('input').val().trim() == ''){
                checkFieldsCValid = false;
                $(this).addClass('empty');
                return;
            }
        });

        if($('#ship-to-different-address-checkbox').is(':checked')){
            $('#customer_details .woocommerce-shipping-fields .validate-required').each(function(){
                if(!$(this).hasClass('woocommerce-validated') && !$(this).hasClass('filled') || $(this).find('input').val().trim() == ''){
                    checkFieldsCValid = false;
                    $(this).addClass('empty');
                }
            });
        } 
        if(checkFieldsCValid == true){
            let wrapper = $('#customer_details');
            $('.checkoutShipping').slideUp();
            $('.checkoutPayment .checkoutTabs__listItem__sublist').slideDown();
            const billingUserData = {
                name: wrapper.find('#billing_first_name').val(),
                surname: wrapper.find('#billing_last_name').val(),
                email: wrapper.find('#billing_email').val(),
                country: wrapper.find('#billing_country').val(),
                phone: wrapper.find('#billing_phone').val(),
                address1: wrapper.find('#billing_address_1').val(),
                address2: wrapper.find('#billing_address_2').val(),
            },
            shippingUser = {
                name: wrapper.find('#shipping_first_name').val(),
                surname: wrapper.find('#shipping_last_name').val(),
                email: wrapper.find('#billing_email').val(),
                country: wrapper.find('#shipping_country').val(),
                phone: wrapper.find('#shipping_phone').val(),
                address1: wrapper.find('#shipping_address_1').val(),
                address2: wrapper.find('#shipping_address_2').val(),
            };
            const result = `<div class="checkoutShipping__resultContent__item name">Sig. ${billingUserData['name']} ${billingUserData['surname']}</div>
            <div class="checkoutShipping__resultContent__item email">${billingUserData['email']}</div>
            <div class="checkoutShipping__resultContent__item address1">Via ${billingUserData['address1']}</div>
            <div class="checkoutShipping__resultContent__item address2">${billingUserData['address2']}</div>
            <div class="checkoutShipping__resultContent__item country">${billingUserData['country']}</div>
            <div class="checkoutShipping__resultContent__item phone">${billingUserData['phone']}</div>
            `;
            if($('#ship-to-different-address-checkbox').is(':checked')){
                const shippingResult = `<div class="checkoutShipping__resultContent__item name">Sig. ${shippingUser['name']} ${shippingUser['surname']}</div>
                <div class="checkoutShipping__resultContent__item email">${shippingUser['email']}</div>
                <div class="checkoutShipping__resultContent__item address1">Via ${shippingUser['address1']}</div>
                <div class="checkoutShipping__resultContent__item address2">${shippingUser['address2']}</div>
                <div class="checkoutShipping__resultContent__item country">${shippingUser['country']}</div>
                <div class="checkoutShipping__resultContent__item phone">${shippingUser['phone']}</div>
                `;
                $('.checkoutShipping__resultBilling .checkoutShipping__resultContent').html(shippingResult);
                $('.checkoutShipping__resultBilling').addClass('show');
            }
            $('.checkoutShipping__resultShipping .checkoutShipping__resultContent').html(result);
            $('.checkoutShipping__result').slideDown();
            $('.checkoutPayment .checkoutTabs__listItem__sublistContent').slideDown();
        }
    });

    $('.guestLogin').on('submit', function(e){
		e.preventDefault();
        $('.error-msg').removeClass('show');
        let checkFieldValid = '',
            checkbox = $(this).find('.form-privacy-checkbox input');
        if(checkbox.is(':checked')){
            $('.guestLogin input').each(function(){
                if($(this).val() == ''){
                    checkFieldValid = 'empty';
                    $(this).addClass('empty');
                }
                else{
                    $(this).removeClass('empty');
                }
            });

            if(checkFieldValid != 'empty'){
                $('.notice').addClass('hide');
                const guestLoginData = {
                    email: $('.guestLogin .email').val(),
                    name: $('.guestLogin .name').val(),
                    surname: $('.guestLogin .surname').val(),
                    phoneNumber: $('.guestLogin .phoneNumber').val(),
                    // fiscalCode: $('.guestLogin .fiscalCode').val(),
                }
                $('.woocommerce-billing-fields #billing_first_name').val(guestLoginData['name']);
                $('.woocommerce-billing-fields #billing_last_name').val(guestLoginData['surname']);
                $('.woocommerce-billing-fields #billing_email').val(guestLoginData['email']);
                $('.woocommerce-billing-fields #billing_phone').val(guestLoginData['phoneNumber']);
                $('.woocommerce-billing-fields #billing_first_name_field').addClass('filled');
                $('.woocommerce-billing-fields #billing_last_name_field').addClass('filled');
                $('.woocommerce-billing-fields #billing_email_field').addClass('filled');
                $('.woocommerce-billing-fields #billing_phone_field').addClass('filled');
                // $('.woocommerce-billing-fields #billing_first_name').val(name);
        
                $.ajax({
                    url: customjs_ajax_object.ajax_url,
                    type: 'POST',
                    data: {
                        action:   'add_order_expense_cf',
                        email: guestLoginData['email'],
                        name:  guestLoginData['name'],
                        surname:  guestLoginData['surname'],
                        phoneNumber: guestLoginData['phoneNumber'],
                        // fiscalCode: fiscalCode,
                    },
                    success: function( response ) {
                        $('.guestLogin').addClass('hide');
                    },
                });
                $('.checkoutUserInfoTab .formResult__content').html(`<div class="formResult__contentTitle name">${guestLoginData['name']} ${guestLoginData['surname']}</div><div class="formResult__contentTitle email">${guestLoginData['email']}</div>`)
                $('.checkoutUserInfoTab__forms').slideUp();
                $('.formResult, .checkoutShipping .checkoutTabs__listItem__sublist').slideDown();
                $('.checkoutShipping').addClass('active');
            } else{
                $('.emptyFields').addClass('show');
            }
        }else{
            $('.checkbox').addClass('show');
        }
	});
    $('.checkoutUserInfoTab span.edit').click(function(){
        $('.checkoutUserInfoTab__forms').slideDown();
        $('.formResult').slideUp();
    });
    $('.guestLogin input').on('input', function(){
        if($(this).val().trim() != ''){
            $(this).removeClass('empty');
        }else{
            $(this).addClass('empty');
        }
    });
    
    //Show order comment 
    $(document).ready(function(){
        // console.log($(this).find('input[type="checkbox"]').is(':checked'));

    })
    
    $('.giftComment').click(function(){
        const orderComment = $('#order_comments_field');
        if($(this).find('input[type="checkbox"]').is(':checked')){
            orderComment.slideUp();           
        }else{
            orderComment.slideDown();
        }
    });

    $(document).ready(function(){
        const form = $('.checkoutTabs__listItem__sublistContent .register'),
              btn = form.find('.btn'),
              checkbox = form.find('.form-privacy-checkbox input');
        btn.click(function(e){
            const pass1 = form.find('#reg_password').val().trim(),
                  pass2 = form.find('#reg_confirm_password').val().trim();
            form.find('.errors .error-msg').removeClass('show');
            if(pass1 == '' || pass2 == ''){
                e.preventDefault();
                form.find('.errors .passFill').addClass('show');
                return;
            }
            if(pass1 !== pass2){
                e.preventDefault();
                form.find('.errors .passMatch').addClass('show');
                return;
            }
            if(!checkbox.is(':checked')){
                e.preventDefault();
                form.find('.errors .checkbox').addClass('show');
                return;
            }
        })
    });
    $('#ship-to-different-address').click(function(){
        $('.shipping_address .form-row').each(function(){
            if($(this).find('input').val().trim() != ''){
                $(this).closest('.form-row').addClass('filled');
            }
        });
    });
    $('.checkoutShipping__result .edit').click(function(){
        $('.checkoutShipping__result').slideUp();
        $('.checkoutTabs__listItem').slideDown();
    });
    $('.checkoutContent .createAccount .create').click(function(){
        $(this).closest('.guestLogin__tab').slideUp().removeClass('active');
        $(this).closest('.checkoutTabs__listItem').find('.new-account').addClass('active').slideDown();
    });


    //Desktop checkout grid 
    $(document).ready(function(){
        const totalHeight = $('.cartTotals__wrapper .cartTotals__title').outerHeight() + $('.cartTotals__wrapper .cartTotals__list').outerHeight() + $('.cartAdditionalInfo').outerHeight() + $('.cartTotals__wrapper').outerHeight() - $('.cartTotals__wrapper').height() + $('.cartTotals__productsList').outerHeight();
        $('.checkoutContent__wrapper').css('min-height', totalHeight);
    });
    $(document).ready(function(){
        message();
    })
    $(document).on('ajaxComplete', function(){
        message();
    })
}

function message() {
    if($('body').hasClass('woocommerce-checkout') && $('.woocommerce-error').length > 0){
        $('<div class="scroller"></div>').prependTo('.woocommerce-error');
        setTimeout(() => {
            $('.woocommerce-error').addClass('show');
            $('.scroller').animate({
                right: '100%',
            }, 10000, function() {
                $('.woocommerce-error').remove();
            });
        }, 300);
    }
    if($('body').hasClass('woocommerce-cart') && $('.woocommerce-message').length > 0){
        $('<div class="scroller"></div>').prependTo('.woocommerce-message');
        setTimeout(() => {
            $('.scroller').animate({
                right: '100%',
            }, 10000, function() {
                $('.woocommerce-message').remove();
            });
        }, 300);
    }
}
export {checkout}