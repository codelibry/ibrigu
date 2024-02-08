import $  from 'jquery';

//import { lazy } from './lazy';
//import { lottie } from './lottie';

import { header } from './template-parts/header/header';
import { footer } from './template-parts/footer/footer';


//animations
import { scrollToAnchor,scrollToHash, requestQuoteLink } from './animations/scroll-to-anchor';
// import { appearence } from './animations/appearence';

//blocks
// import { videoBlock } from './template-parts/blocks/video';
import { categoriesList } from './template-parts/blocks/categories-list';
// import { heroSlider } from './template-parts/blocks/hero-slider';
import { shopFilters } from './template-parts/blocks/shop-filters';
import { singleProduct } from './template-parts/blocks/single-product';
import { wishlist } from './template-parts/blocks/wishlist';
import { loginForm } from './template-parts/blocks/login-form';
import { cart } from './template-parts/blocks/cart';
import { checkout } from './template-parts/blocks/checkout';
import { dropdown } from './template-parts/blocks/dropdown';
import { form } from './template-parts/blocks/form';
import { sideCart } from './template-parts/blocks/sideCart';
import { appearOnScroll } from './template-parts/blocks/appearOnScroll';

header();
footer();
//lazy();
//lottie();

//animations
// appearence();

//blocks
// videoBlock();
shopFilters();
categoriesList();
singleProduct();
wishlist();
loginForm();
cart();
checkout();
dropdown();
form();
sideCart();
appearOnScroll();
// heroSlider();
