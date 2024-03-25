import $ from 'jquery';

function wishlist(){
    $(window).on('load', function(){
        updateContent();
        $('.wishlist__itemRemove').click(function(){
            const item = $(this);
            $(document).on('ajaxComplete', function(){
                item.closest('.wishlist__itemWrapper').remove();
                updateContent();
            });
        });
    });
}
function updateContent(){ 
    let wishlistItems = $('.wishlist__itemWrapper').length;
    if(wishlistItems < 1) {
        $('.wishlist').addClass('empty');
        $('.wishlist').removeClass('hasItems');
    }
    else{
        $('.wishlist').removeClass('empty');
        $('.wishlist').addClass('hasItems');
    }
}

export{ wishlist }