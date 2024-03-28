import $  from 'jquery';

function footer(){
    
    //mobile dropdown
    $('.footer__main__nav').each(function(){
        let block = $(this);
        let title = $(this).find('.footer__menu__title');
        let dropdown = $(this).find('.footer-nav');
        title.click(function(){
            block.toggleClass('footer-active');
            dropdown.slideToggle(300);
        });
    });
    

    //back to top
    function trackScroll() {
        var scrolled = window.pageYOffset;
        var coords = document.documentElement.clientHeight;
    
        if (scrolled > coords) {
          goTopBtn.classList.add('back_to_top-show');
        }
        if (scrolled < coords) {
          goTopBtn.classList.remove('back_to_top-show');
        }
      }
    
    
      var goTopBtn = document.querySelector('.back_to_top');
    
      window.addEventListener('scroll', trackScroll);

      $('.back_to_top').click(function(){
        $(window).scrollTop(0);
      })
}


export { footer };