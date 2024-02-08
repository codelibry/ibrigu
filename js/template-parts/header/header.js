import $ from 'jquery';

function header() {
    let headerToggle = false;

    $('.header__toggle').on('click',function(e){
        e.preventDefault();

        if(headerToggle) {
            $('body').addClass('header-unactive').removeClass('header-active');
            headerToggle = !headerToggle;
            $('header .sub-menu').slideUp();
            $('.menu-item-has-children').removeClass('menu-active');
        } else {
            $('body').addClass('header-active').removeClass('header-unactive');
            headerToggle = !headerToggle;
        }
    });

    $(document).on('click', '.menu-item__parent a', function (e) {
        e.preventDefault();

        const menuItem = $(this).closest('.menu-item-has-children');
        const subMenu = menuItem.find('.sub-menu');

        menuItem.toggleClass('menu-active');

        subMenu.stop().slideToggle();
    })

    // add class to header on scrolling
    $(document).on('scroll', function () {
        if ($(window).scrollTop() > 46) {
            $('.header').addClass('header--scrolled').removeClass('header--unscrolled');
        } else {
            $('.header').addClass('header--unscrolled').removeClass('header--scrolled');

        }
    })

    //header hide on scrolling
    // Hide Header on on scroll down
    var didScroll;
    var lastScrollTop = 0;
    var delta = 5;
    var navbarHeight = $('.header__main').outerHeight();
    var footerHeight = $('footer').outerHeight();


    $(window).scroll(function (event) {
        didScroll = true;
    });

    setInterval(function () {
        if (didScroll) {
            hasScrolled();
            didScroll = false;
        }
    }, 50);

    function hasScrolled() {
        var st = $(document).scrollTop();

        // Make sure they scroll more than delta
        if (Math.abs(lastScrollTop - st) <= delta)
            return;

        // If they scrolled down and are past the navbar, add class .nav-up.
        // This is necessary so you never see what is "behind" the navbar.
        if (st > lastScrollTop && st > navbarHeight) {
            // Scroll Down
            $('body').removeClass('nav-down').addClass('nav-up');
        } else {
            // Scroll Up
            if (st + $(window).height() < $(document).height()) {
                $('body').removeClass('nav-up').addClass('nav-down');
            }
        }


        if ($('footer').offset().top < st + $(window).height() || st < 50) {
            $('.bottomBar').addClass('hidden');
            //$('.bottomBar').css('bottom',$('footer').height());
        } else {
            $('.bottomBar').removeClass('hidden');
            //$('.bottomBar').css('bottom',0);
        }

        lastScrollTop = st;
    }
}


export {header};