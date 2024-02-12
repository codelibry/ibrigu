import $ from 'jquery';

function registerForm(){
    $(document).ready(function(){
        const w = $(window).width();
        $('.registerAccountBtn').click(function(){
            const selected = $('.phone-country-code select').val();
            $('.phone-country-code-pseudo-el').html($('.phone-country-code').find(`option[selected="selected"]`).html());
            $('.phone-country-code').css({
                width: $('.phone-country-code-pseudo-el').outerWidth(),
            });
        })
        $('#billing_phone_country_code').on('change', function(){
            const selected = $(this).val();
            $('.phone-country-code-pseudo-el').html($(this).find(`option[value="${selected}"]`).html());
            let width = $('.phone-country-code-pseudo-el').outerWidth();

            if(w < 770 && $('.phone-country-code-pseudo-el').outerWidth() > $('.woocommerce-form-register').width() * 0.8){
                width = $('.woocommerce-form-register').width();
                setTimeout(function(){
                    $('.phone-country-code').addClass('full-width');
                }, 300);
            } else{
                $('.phone-country-code').removeClass('full-width');
            }
            $('.phone-country-code').animate({
                width: width,
            }, 300);
        });
    });
}
export {registerForm}