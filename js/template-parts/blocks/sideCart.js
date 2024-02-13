import $ from 'jquery';

function sideCart(){
    //Close
    $('.cartSidebar__close, .cartSidebar__overlay').click(function(){
        $('.cartSidebar').removeClass('cart-opened');
    });
}

export {sideCart};