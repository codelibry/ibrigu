import $ from 'jquery';

function shopFilters() {
    $(document).ready(function(){
        const w = $(window).width();
        if(w < 770){
            $('.catalog__filtersList__attributeItem__apply, .catalog__filtersClose').click(function(){
                $('.catalog__filtersList__attributeSublist').parent().removeClass('opened');
                $('.catalog__filtersList__attributeSublist').slideUp();
            })
        }
    })

    $(document).ready(function(){
        filtersSidebar();
        sidebarAttributes();
        $('.catalog__filtersList__attributeSublist__close, .catalog__filtersList__attributeSublist__overlay').click(function(){
            sidebarClose();
        });
    });
    $(document).keyup(function(e) {
        if (e.key === "Escape") { 
            sidebarClose();
        }
   });

   //Categories 
    $('.catalog__categoriesList__itemWrapper').click(function(){
        $('.catalog__categoriesList__itemWrapper').not($(this)).removeClass('checked');
        $(this).toggleClass('checked');

        let slug = $(this).attr('data-slug');
        const color = $('.catalog__list').attr('data-color'),
              size = $('.catalog__list').attr('data-size'),
              order = $('.catalog__list').attr('data-order');

        if(!$(this).hasClass('checked')){
            slug = $('.catalog__categoriesList__slider').attr('data-default-cat');
        }
        $.ajax({
            url: customjs_ajax_object.ajax_url,
            type: 'post',
            data: {
                action: 'product_categories',
                slug: slug,
                order: order,
                size: size,
                color: color,
            },
            success: function(response){
                $('.catalog__list').html(response);
                $('.woocommerce-pagination').remove();
            }
        });
        $('.catalog__list').attr('data-category', slug);
    })
}

function filtersSidebar() {
    //Open Filters List (Mobile)
    $('.catalog__filter').click(function(){
        $('.catalog__filtersMenu').addClass('opened');
    });

    $('.catalog__filtersClose').click(function(){
        $('.catalog__filtersMenu').removeClass('opened');
    });
}
function sidebarAttributes(){
    //Open Filters SubMenu | Filters Menu 
    $('.catalog__filtersList__attributeLabel').click(function(){
        const w = jQuery(window).width();
        $('.catalog__filtersList__attributeSublist').not($( $(this).parent().find('.catalog__filtersList__attributeSublist'))).slideUp();
        $('.catalog__filtersList__attribute').not($(this).parent()).removeClass('opened');
        if(w < 770){
            $(this).parent().find('.catalog__filtersList__attributeSublist').slideToggle();
        }
        $(this).parent().toggleClass('opened');
    });

    //Sort Items 
    $('.catalog__filtersList__attributeItem').click(function(){
        if($(this).closest('.catalog__filtersList__attribute').hasClass('sort')){
            $('.sort .catalog__filtersList__attributeItem').removeClass('active');
        }
        $(this).toggleClass('active');
    });

    //Apply Filters
    $('.catalog__filtersList__attributeItem__apply').click(function(){
        const category = $('.catalog__list').attr('data-category');
        let colors = [],
            sizes = [],
            sort = [];
        
        $('.catalog__filtersList__attribute').each(function(){
            let arr = [];
            $(this).find('.catalog__filtersList__attributeItem').each(function(){
                if($(this).hasClass('active')){
                    arr.push($(this).find('h4').attr('data-slug'));
                }
            });
            if($(this).hasClass('colors')){
                colors.push(arr);
            }
            if($(this).hasClass('size')){
                sizes.push(arr);
            }
            if($(this).hasClass('sort')){
                sort.push(arr);
            }
        });
        $.ajax({
            url: customjs_ajax_object.ajax_url,
            type: 'post',
            data: {
                action: 'products_filter',
                colors: colors,
                sizes: sizes,
                sort: sort.join(),
                category: category,
            },
            success: function(response){
                $('.catalog__list').html(response);
            }
        });
        $('.catalog__filtersMenu').removeClass('opened');

        $('.catalog__list').attr('data-color', colors);
        $('.catalog__list').attr('data-size', sizes);
        $('.catalog__list').attr('data-order', sort);
    });
}
function sidebarClose() {
    $('.catalog__filtersList__attribute.opened').toggleClass('opened');
    $('.catalog__filtersList__attribute.opened .catalog__filtersList__attributeSublist').slideToggle();
}
export { shopFilters };