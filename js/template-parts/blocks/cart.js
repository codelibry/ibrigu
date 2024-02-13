import $ from 'jquery';

function cart() {
    $('.wishlist_toggle').click(function(){
        let wrapper = $(this).parent();
        wrapper.toggleClass('add_to_wishlistWrapper');
        wrapper.toggleClass('remove_from_wishlistWrapper');
        // if(wrapper.hasClass('remove_from_wishlistWrapper')){
        //     $(document).on('ajaxStop', function(){
                
        //     })
        // }else{
        //     $(document).on('ajaxStop', function(){
        //         wrapper.removeClass('add_to_wishlistWrapper');
        //         wrapper.addClass('remove_from_wishlistWrapper');
        //         console.log('123');
        //     })
        // }
    });
    $(document).ready(function(){
        cartRemove();
    });
    $(document).on('ajaxComplete', function(){
        cartRemove();
        if($('.emptyCart').length > 0){
            $('body').addClass('empty-cart');
        }
    });

    //Quantity
    $(document).ready(function(){
        updateCart();
    });
    $(document).ajaxComplete(function(){
        updateCart(); 
    });
}
function updateCart(){
    $('.decrease').click(function(){
        const item = $(this).parent().find('input[type="number"]');
        item.val(item.val() - 1);
        setTimeout(function(){
            item.focus().submit();
        }, 600);
    });
    $('.increase').click(function(){
        const item = $(this).parent().find('input[type="number"]');
        item.val(parseInt(item.val()) + 1);
        setTimeout(function(){
            item.focus().submit();
        }, 600);
    });
}
function cartRemove(){
    $('.cartContent__itemRemove').click(function(){
        let item = $(this).closest('.cartContent__item');
        item.addClass('hide');
        item.find('.qty').val(0);
        item.find('.qty').trigger( "submit" );
        $('.cartContent__coupon button[name="update_cart"]').click();
        item.find('.qty').focus().submit();
    })
}

export {cart};