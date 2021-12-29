import $  from 'jquery';
import 'slick-carousel';

function testimonialsSlider(){
        $('.testimonials-slider').each(function(){
                let block = $(this);
                let slider = $(this).find('.testimonials-slider__list');


                slider.slick({
                        dots: false,
                        arrows: true,
                        infinite: true,
                        speed: 500,
                        cssEase: 'linear',
                        adaptiveHeight: true,
                        autoplay: true,
                        autoplaySpeed: 3000,
                        prevArrow: block.find('.testimonials-slider__nav__prev'),
                        nextArrow: block.find('.testimonials-slider__nav__next')
                });
                
                slider.on('init', function(){
                  $(window).trigger('heightChanges');
                });

                
                
        });
}

export { testimonialsSlider };