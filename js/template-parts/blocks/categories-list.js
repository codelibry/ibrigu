import $ from 'jquery';

function categoriesList() {
    $(document).ready(function(){
        addSliderItemsClass();
        sliderInit();
        slidesChange();
    });
}
function addSliderItemsClass(){
    const w = $(window).width();
    let activeSlides,
        i = 0;
    if(w <= 768){
        activeSlides = 3;
    } else{
        activeSlides = 4;
    }
    $('.catalog__categoriesList .catalog__categoriesList__itemWrapper').each(function(){
        if(i < activeSlides){
            $(this).addClass('active');
        } else if(i == activeSlides){
            $(this).addClass('next-slide');
            $('.catalog__categoriesList__next').removeClass('disabled');
        }
        i++;
    });
}
function sliderInit() {
    let sliderWidth = 0;
    $(window).on('load', function(){
        $('.catalog__categoriesList .catalog__categoriesList__itemWrapper.active').each(function(){
            console.log($(this).outerWidth());
            sliderWidth += $(this).outerWidth();
        });
        $('.catalog__categoriesList').animate(
            {
                width: sliderWidth
            }, 300);
    });
}

function slidesChange(){
    const w = $(window).width();
    let slidesCount;
    if(w <= 768){
        slidesCount = 3;
    } else{
        slidesCount = 4;
    }
    if($('.catalog__categoriesList__itemWrapper').length > slidesCount){
        $('.catalog__categoriesList__arrow').click(function(){
            const nextSlide = $('.catalog__categoriesList__itemWrapper.active').last().index() + 1,
                  prevSlide = $('.catalog__categoriesList__itemWrapper.active').first().index() - 1,
                  prevSlideWidth = $('.catalog__categoriesList__itemWrapper').eq(prevSlide).outerWidth(),
                  nextSlideWidth = $('.catalog__categoriesList__itemWrapper').eq(nextSlide - slidesCount).outerWidth(),
                  slideRange = $('.catalog__categoriesList__slider').css('left').split('px');
            
            if($(this).hasClass('catalog__categoriesList__next')){
                let newSlideRange = +slideRange[0] - nextSlideWidth;
                $('.catalog__categoriesList__itemWrapper.active').first().removeClass('active');
                $('.catalog__categoriesList__itemWrapper').eq(nextSlide).addClass('active');
                $('.catalog__categoriesList__slider').css('left', newSlideRange);
            } else if($(this).hasClass('catalog__categoriesList__prev')){
                let newSlideRange = +slideRange[0] + prevSlideWidth;
                $('.catalog__categoriesList__itemWrapper.active').last().removeClass('active');
                $('.catalog__categoriesList__itemWrapper').eq(prevSlide).addClass('active');
                $('.catalog__categoriesList__slider').css('left', newSlideRange);
            }
            
    
            if($('.catalog__categoriesList__itemWrapper').last().hasClass('active')){
                $('.catalog__categoriesList__next').addClass('disabled');
            } else{
                $('.catalog__categoriesList__next').removeClass('disabled');
            }
    
            if($('.catalog__categoriesList__itemWrapper').first().hasClass('active')){
                $('.catalog__categoriesList__prev').addClass('disabled');
            } else{
                $('.catalog__categoriesList__prev').removeClass('disabled');
            }
            let sliderWidth = 0;
            $('.catalog__categoriesList .catalog__categoriesList__itemWrapper.active').each(function(){
                console.log($(this).outerWidth());
                sliderWidth += $(this).outerWidth();
                $('.catalog__categoriesList').css('width', sliderWidth);
            });
        })
    }
}

export {categoriesList};