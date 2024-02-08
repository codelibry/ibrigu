import $ from 'jquery';

function appearOnScroll() {
    $(document).ready(function() {
        function isElementInViewport(el) {
            const rect = el.getBoundingClientRect(),
                  windowHeight = (window.innerHeight || document.documentElement.clientHeight),
                  windowWidth = (window.innerWidth || document.documentElement.clientWidth);
        
            const topVisible = rect.top <= windowHeight * 0.8,
                  bottomVisible = rect.bottom >= windowHeight * 0.2,
                  leftVisible = rect.left <= windowWidth * 0.8,
                  rightVisible = rect.right >= windowWidth * 0.2;
        
            return topVisible && bottomVisible && leftVisible && rightVisible;
        }
    
        function checkElements() {
            var elements = $('.animate');
    
            elements.each(function() {
                if (isElementInViewport(this)) {
                    $(this).addClass('in');
                }
            });
        }
    
        $(window).on('load scroll resize', checkElements);
    });
}

export {appearOnScroll}