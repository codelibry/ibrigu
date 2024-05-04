<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);
?>
<?php $customer = new WC_Customer( get_current_user_id() ); 
if($customer->first_name != "" or $customer->last_name != ""): 
    $customer_name = $customer->last_name . " " . $customer->first_name; 
else: 
    $customer_name = $customer->display_name; 
endif;
?>
<section class="myAccount">
	<div class="container woocommerce-container-mb">
		<div class="myAccount__top">
			<h1 class="myAccount__title sm woocommerce-title"><?php the_title(); ?></h1>
			<h4 class="myAccount__userName sm"><?php echo 'Welcome ' . $customer_name . '!'; ?></h4>
		</div>
		<div class="myAccount__forms">
			<div class="myAccount__editData editAccount__formWrapper">
				<div class="account__menu myAccount__menu">
					<h5 class="account__menuItem current desktop-lg">
						<?php _e('Le mie informazioni', 'woocommerce_custom_text'); ?>
					</h5>
					<h5 class="account__menuItem desktop-lg">
						<a href="<?php echo get_home_url() . '/wishlist'; ?>"><?php _e('La mia wishlist', 'woocommerce_custom_text'); ?></a>
					</h5>
				</div>
				<?php do_action('woocommerce_edit_account'); ?>
			</div>
			<div class="myAccount__changePasswordForm__wrapper editAccount__formWrapper">
				<?php do_action('woocommerce_account_change_password'); ?>
			</div>
		</div>
	</div>
</section>

