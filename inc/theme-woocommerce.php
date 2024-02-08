<?php 
function get_language_shortcode() {
    return apply_filters( 'wpml_current_language', null );
}
add_shortcode( 'language', 'get_language_shortcode' );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
add_action('woocommerce_product_price', 'woocommerce_template_single_price', 10);
add_action('woocommerce_product_add_to_cart', 'woocommerce_template_single_add_to_cart', 30);
add_action('woocommerce_product_images', 'woocommerce_show_product_images', 20);

add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_home_text' );
function wcc_change_breadcrumb_home_text( $defaults ) {
    if(get_language_shortcode() == 'it'){
        $defaults['home'] = 'Negozio';
    }elseif(get_language_shortcode() == 'en'){
    	$defaults['home'] = 'Shop';
    }
	return $defaults;
}

add_filter( 'woocommerce_breadcrumb_home_url', 'woo_custom_breadrumb_home_url' );
function woo_custom_breadrumb_home_url() {
    return get_home_url(  ) . '/shop';
}

add_filter( 'woocommerce_breadcrumb_defaults', 'wcc_change_breadcrumb_delimiter' );
function wcc_change_breadcrumb_delimiter( $defaults ) {
	// Change the breadcrumb delimeter from '/' to '>'
	$defaults['delimiter'] = '';
	return $defaults;
}


add_action('woocommerce_register_form_start', 'custom_register_fields');

function custom_register_fields() {
    ?>
    

	<p class="form-row woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <input type="text" class="input-text" name="first_name" id="first_name" placeholder="<?php _e('Name *', 'woocommerce_custom_text'); ?>" value="<?php if (!empty($_POST['first_name'])) echo esc_attr($_POST['first_name']); ?>" />
    </p>

    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <input type="text" class="input-text" name="last_name" id="last_name" placeholder="<?php _e('Surname *', 'woocommerce_custom_text'); ?>" value="<?php if (!empty($_POST['last_name'])) echo esc_attr($_POST['last_name']); ?>" />
    </p>
	<?php if(is_account_page()): ?>
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <input type="text" class="input-text" name="billing_country" id="billing_country" placeholder="<?php _e('Country *', 'woocommerce_custom_text'); ?>" value="<?php if (!empty($_POST['billing_country'])) echo esc_attr($_POST['billing_country']); ?>" />
    </p>
    <?php endif; ?>
	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <input type="text" class="input-text" name="fiscal_code" id="fiscal_code" placeholder="<?php _e('Fiscal code *', 'woocommerce_custom_text'); ?>" value="<?php if (!empty($_POST['fiscal_code'])) echo esc_attr($_POST['fiscal_code']); ?>" />
    </p>
	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <input type="tel" class="input-text" name="billing_phone" id="billing_phone" placeholder="<?php _e('Cellphone *', 'woocommerce_custom_text'); ?>" value="<?php if (!empty($_POST['billing_phone'])) echo esc_attr($_POST['billing_phone']); ?>" />
    </p>
    <?php
}

add_filter('woocommerce_registration_errors', 'custom_registration_errors', 10, 3);

function custom_registration_errors($errors, $username, $email) {
    
	if (isset($_POST['first_name']) && empty($_POST['first_name'])) {
        $errors->add('first_name_error', __('Please, enter your name.', 'woocommerce'));
    }
    if (isset($_POST['last_name']) && empty($_POST['last_name'])) {
        $errors->add('last_name_error', __('Please, enter your surname.', 'woocommerce'));
    }
    if(is_account_page()):
        if (isset($_POST['billing_country']) && empty($_POST['billing_country'])) {
            $errors->add('billing_country_error', __('Please, enter your country.', 'woocommerce'));
        }
    endif;
	if (isset($_POST['fiscal_code']) && empty($_POST['fiscal_code'])) {
        $errors->add('fiscal_code_error', __('Please, enter your fiscal code.', 'woocommerce'));
    }
	if (isset($_POST['billing_phone']) && empty($_POST['billing_phone'])) {
        $errors->add('billing_phone_error', __('Please, enter your phone number.', 'woocommerce'));
    }


    return $errors;
}

add_action('woocommerce_created_customer', 'save_custom_registration_fields');

function save_custom_registration_fields($customer_id) {
    
	if (isset($_POST['first_name'])) {
        update_user_meta($customer_id, 'first_name', sanitize_text_field($_POST['first_name']));
    }

    if (isset($_POST['last_name'])) {
        update_user_meta($customer_id, 'last_name', sanitize_text_field($_POST['last_name']));
    }
    if(is_account_page()):
        if (isset($_POST['billing_country'])) {
            update_user_meta($customer_id, 'billing_country', sanitize_text_field($_POST['billing_country']));
        }
    endif;

	if (isset($_POST['fiscal_code'])) {
        update_user_meta($customer_id, 'fiscal_code', sanitize_text_field($_POST['fiscal_code']));
    }

	if (isset($_POST['billing_phone'])) {
        update_user_meta($customer_id, 'billing_phone', sanitize_text_field($_POST['billing_phone']));
    }
}


//Password Chnage Form
add_action('woocommerce_account_change_password', 'custom_account_password_form');

function custom_account_password_form() {
    ?>
    <div class="woocommerce-MyAccount-content myAccount__changePasswordForm">
		<div class="myAccount__changePasswordForm__title woocommerce-text editAccount__form__title">
			<?php _e('Change password', 'woocommerce_custom_text'); ?>
		</div>
        <form action="" method="post" id="chnagePassword">
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password_current" id="password_current" placeholder="<?php _e('Current password *', 'woocommerce_custom_text'); ?>" />
            </p>
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password_1" id="password_1" placeholder="<?php _e('New password *', 'woocommerce_custom_text'); ?>" />
            </p>
			<p class="woocommerce-form-text woocommerce-text chnage-password-text">
				<?php _e('8-15 characters', 'woocommerce_custom_text'); ?>
			</p>
            <p class="submitBtn__wrapper">
                <input type="hidden" name="action" value="change_password" />
                <?php wp_nonce_field('change_password', 'change_password_nonce'); ?>
                <button type="submit" class="woocommerce-Button button button--size--md button--black button--fz--md" name="save_password" value="<?php _e('Change Password', 'woocommerce_custom_text'); ?>"><?php _e('SAVE', 'woocommerce_custom_text'); ?></button>
            </p>
        </form>
    </div>
    <?php
}

add_action('init', 'process_password_change');

function process_password_change() {
    if (isset($_POST['action']) && $_POST['action'] === 'change_password') {
        if (isset($_POST['change_password_nonce']) && wp_verify_nonce($_POST['change_password_nonce'], 'change_password')) {
            $user = wp_get_current_user();

            $password_current = isset($_POST['password_current']) ? sanitize_text_field($_POST['password_current']) : '';
            $password_1 = isset($_POST['password_1']) ? sanitize_text_field($_POST['password_1']) : '';

            if (!wp_check_password($password_current, $user->user_pass, $user->ID)) {
                wc_add_notice('Поточний пароль введено невірно.', 'error');
                return;
            }

            wp_set_password($password_1, $user->ID);
            wc_add_notice('Пароль успішно змінено.', 'success');
        }
    }
}


//Edit Account Data Form
add_action('woocommerce_edit_account', 'custom_account_profile_form');

function custom_account_profile_form() {
    ?>
    <div class="woocommerce-MyAccount-content">
		<div class="myAccount__editData__title woocommerce-text editAccount__form__title"><?php _e('Edit account', 'woocommerce_custom_text'); ?></div>
        <form action="" method="post" id="editAccountData">
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <input type="email" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="<?php _e('Email', 'woocommerce_custom_text'); ?>" name="account_email" id="account_email" value="" />
            </p>
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="<?php _e('Name', 'woocommerce_custom_text'); ?>" name="first_name" id="first_name" value="" />
            </p>
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="<?php _e('Surname', 'woocommerce_custom_text'); ?>" name="last_name" id="last_name" value="" />
            </p>
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide country">
                <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="<?php _e('Country', 'woocommerce_custom_text'); ?>" name="billing_country" id="billing_country" value="" />
            </p>
            <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
                <input type="tel" class="woocommerce-Input woocommerce-Input--text input-text" placeholder="<?php _e('Cellphone', 'woocommerce_custom_text'); ?>" name="billing_phone" id="billing_phone" value="" />
            </p>
            <p class="submitBtn__wrapper">
                <input type="hidden" name="action" value="update_profile" />
                <?php wp_nonce_field('update_profile', 'update_profile_nonce'); ?>
                <button type="submit" class="woocommerce-Button button button button--size--md button--black button--fz--md" name="save_profile" value="<?php _e('Update Profile', 'woocommerce_custom_text'); ?>"><?php _e('Save', 'woocommerce_custom_text'); ?></button>
            </p>
        </form>
    </div>
    <?php
}

add_action('init', 'process_profile_update');

function process_profile_update() {
    if (isset($_POST['action']) && $_POST['action'] === 'update_profile') {
        if (isset($_POST['update_profile_nonce']) && wp_verify_nonce($_POST['update_profile_nonce'], 'update_profile')) {
            $user_id = get_current_user_id();

            if (isset($_POST['account_email'])) {
                $account_email = sanitize_email($_POST['account_email']);
                wp_update_user(array('ID' => $user_id, 'user_email' => $account_email));
            }

            if (isset($_POST['first_name'])) {
                $first_name = sanitize_text_field($_POST['first_name']);
                update_user_meta($user_id, 'first_name', $first_name);
            }

            if (isset($_POST['last_name'])) {
                $last_name = sanitize_text_field($_POST['last_name']);
                update_user_meta($user_id, 'last_name', $last_name);
            }

            if (isset($_POST['billing_country'])) {
                $billing_country = sanitize_text_field($_POST['billing_country']);
                update_user_meta($user_id, 'billing_country', $billing_country);
            }

            if (isset($_POST['billing_phone'])) {
                $billing_phone = sanitize_text_field($_POST['billing_phone']);
                update_user_meta($user_id, 'billing_phone', $billing_phone);
            }

            wc_add_notice('Your profile has successfully been updated.', 'success');
        }
    }
}


if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_get_items_count' ) ) {
	function yith_wcwl_get_items_count() {
	  ob_start();
	  ?>
		<?php echo esc_html( yith_wcwl_count_all_products() ); ?>
	  <?php
	  return ob_get_clean();
	}
  
	add_shortcode( 'yith_wcwl_items_count', 'yith_wcwl_get_items_count' );
}
  
if ( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_ajax_update_count' ) ) {
	function yith_wcwl_ajax_update_count() {
	  wp_send_json( array(
		'count' => yith_wcwl_count_all_products()
	  ) );
	}
  
	add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
	add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
}
  

//Remove Attributes From Product Title On Cart Page
function remove_variation_from_product_title( $title, $cart_item, $cart_item_key ) {
	$_product = $cart_item['data'];
	$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

	if ( $_product->is_type( 'variation' ) ) {
        return $_product->get_title();
	}

	return $title;
}
add_filter( 'woocommerce_cart_item_name', 'remove_variation_from_product_title', 10, 3 );







//checkout guestLogin
add_action( 'wp_ajax_add_order_expense_cf', 'add_order_expense_custom_fields' );
add_action('wp_ajax_nopriv_add_order_expense_cf', 'add_order_expense_custom_fields');

function add_order_expense_custom_fields() {
    if (isset($_POST['name'])) {
        update_user_meta(get_current_user_id(), 'first_name', sanitize_text_field($_POST['name']));
    }

    if (isset($_POST['surname'])) {
        update_user_meta(get_current_user_id(), 'last_name', sanitize_text_field($_POST['surname']));
    }
    if (isset($_POST['email'])) {
        $account_email = sanitize_email($_POST['email']);
        wp_update_user(array('ID' => $user_id, 'user_email' => $account_email));
    }


	if (isset($_POST['fiscalCode'])) {
        update_user_meta(get_current_user_id(), 'fiscal_code', sanitize_text_field($_POST['fiscalCode']));
    }

	if (isset($_POST['phoneNumber'])) {
        update_user_meta(get_current_user_id(), 'billing_phone', sanitize_text_field($_POST['phoneNumber']));
    }
    die;
}



//Change fields placeholders
function ace_remove_checkout_fields( $fields ) {
	unset( $fields['billing']['billing_state'] );
	unset( $fields['shipping']['shipping_state'] );

    $fields['billing']['billing_country']['type'] = 'text';
    $fields['order']['order_comments']['type'] = 'text';
    $fields['order']['order_comments']['maxlength'] = '250';
    $fields['order']['order_comments']['placeholder'] = __('Write your message here', 'woocommerce_custom_text');

    $fields['shipping']['shipping_first_name']['placeholder'] = __('Name *', 'woocommerce_custom_text');
    $fields['shipping']['shipping_last_name']['placeholder'] = __('Surname *', 'woocommerce_custom_text');
    $fields['shipping']['shipping_address_1']['placeholder'] = __('Address 1 *', 'woocommerce_custom_text');
    $fields['shipping']['shipping_address_2']['placeholder'] = __('Address 2', 'woocommerce_custom_text');
    $fields['shipping']['shipping_country']['placeholder'] = __('Country *', 'woocommerce_custom_text');
    $fields['shipping']['shipping_city']['placeholder'] = __('City *', 'woocommerce_custom_text');
    $fields['shipping']['shipping_postcode']['placeholder'] = __('Zip Code *', 'woocommerce_custom_text');

    $fields['shipping']['shipping_address_1']['priority'] = 30;
    $fields['shipping']['shipping_address_2']['priority'] = 40;
    $fields['shipping']['shipping_postcode']['priority'] = 60;
    $fields['shipping']['shipping_city']['priority'] = 80;
    $fields['shipping']['shipping_country']['priority'] = 90;
    
    
    $fields['shipping']['shipping_country']['type'] = 'text';


	return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'ace_remove_checkout_fields' );




//add pasword fields

function add_password_fields_to_registration() {
    if (is_checkout()) { ?>
    <p class="form-row woocommerce-form-row form-row-wide">
        <input type="password" class="input-text" name="password" id="reg_password" placeholder="<?php _e('Password *', 'woocommerce'); ?>" value="<?php if (!empty($_POST['password'])) echo esc_attr($_POST['password']); ?>" required/>
    </p>
    <span class="underPasswordText woocommerce-text "><?php _e('8-15 characters', 'woocommerce_custom_text'); ?></span>
    <p class="form-row woocommerce-form-row form-row-wide">
        <input type="password" class="input-text" name="confirm_password" id="reg_confirm_password" placeholder="<?php _e('Confirm password *', 'woocommerce'); ?>" value="<?php if (!empty($_POST['confirm_password'])) echo esc_attr($_POST['confirm_password']); ?>" required/>
    </p>
    <div class="form-row woocommerce-form-row form-row-wide form-privacy-checkbox-wrapper form-checkbox-wrapper">
        <div class="form-privacy-checkbox form-checkbox"><input type="checkbox" name="privacy"></div>
        <span class="woocommerce-text sm"><?php _e('Having read the privacy policy I authorize Ibrigu to process my personal data.', 'woocommerce_custom_text'); ?></span>
    </div>
    <div class="errors">
        <div class="error-msg checkbox"><?php _e('Please confirm that you have read the Privacy Policy', 'woocommerce_custom_text'); ?></div>
        <div class="error-msg passMatch"><?php _e("Passwords doesn't match", 'woocommerce_custom_text'); ?></div>
        <div class="error-msg passFill"><?php _e('Please enter your password', 'woocommerce_custom_text'); ?></div>
    </div>
    <?php }
}

add_action('woocommerce_register_form_start', 'add_password_fields_to_registration');



function save_password_fields($customer_id) {
    if (!empty($_POST['password'])) {
        wp_update_user(array('ID' => $customer_id, 'user_pass' => $_POST['password']));
    }
}

add_action('woocommerce_created_customer', 'save_password_fields');


//Shipping fields placeholder 
function shipping_fields_placeholder( $fields ) {
    $fields['billing']['billing_first_name']['placeholder'] = __('Name *', 'woocommerce_custom_text');
    $fields['billing']['billing_last_name']['placeholder'] = __('Surname *', 'woocommerce_custom_text');
    $fields['billing']['billing_postcode']['placeholder'] = __('Zip Code *', 'woocommerce_custom_text');
    $fields['billing']['billing_city']['placeholder'] = __('City *', 'woocommerce_custom_text');
    $fields['billing']['billing_country']['placeholder'] = __('Country *', 'woocommerce_custom_text');
    $fields['billing']['billing_phone']['placeholder'] = __('Cellphone *', 'woocommerce_custom_text');
    $fields['billing']['billing_address_1']['placeholder'] = __('Address 1 *', 'woocommerce_custom_text');
    $fields['billing']['billing_address_2']['placeholder'] = __('Address 2', 'woocommerce_custom_text');

    return $fields;
}

add_filter( 'woocommerce_checkout_fields', 'shipping_fields_placeholder' );

//Add Province Field 
add_filter('woocommerce_checkout_fields', 'add_province_to_checkout');

function add_province_to_checkout($fields) {
    $fields['billing']['billing_province'] = array(
        'label'       => __('Province', 'woocommerce'),
        'placeholder' => __('Province', 'woocommerce'),
        'required'    => false,
        'class'       => array('form-row-wide'),
        'clear'       => true,
        'type'        => 'text',
        'priority'    => 95,
    );
    $fields['shipping']['shipping_province'] = array(
        'label'       => __('Province', 'woocommerce'),
        'placeholder' => __('Province', 'woocommerce'),
        'required'    => false,
        'class'       => array('form-row-wide'),
        'clear'       => true,
        'type'        => 'text',
        'priority'    => 60,
    );

    $fields['shipping']['shipping_phone'] = array(
        'label'       => __('Cellphone', 'woocommerce'),
        'placeholder' => __('Cellphone *', 'woocommerce'),
        'required'    => true,
        'class'       => array('form-row-wide'),
        'clear'       => true,
        'type'        => 'text',
        'priority'    => 90,
    );


    return $fields;
}

add_action('woocommerce_checkout_update_order_meta', 'save_province');

function save_province($order_id) {
    if (!empty($_POST['billing_province'])) {
        update_post_meta($order_id, 'Billing Province', sanitize_text_field($_POST['billing_province']));
    }
    if (!empty($_POST['shipping_province'])) {
        update_post_meta($order_id, 'Shipping Province', sanitize_text_field($_POST['shipping_province']));
    }
    if (!empty($_POST['shipping_phone'])) {
        update_post_meta($order_id, 'Shipping Phone', sanitize_text_field($_POST['shipping_phone']));
    }
}

add_action('woocommerce_admin_order_data_after_billing_address', 'display_province_in_admin');

function display_province_in_admin($order) {
    $province = get_post_meta($order->get_id(), 'Billing Province', true);
    echo '<p><strong>Province:</strong> ' . esc_html($province) . '</p>';
}

add_action('woocommerce_admin_order_data_after_shipping_address', 'display_shipping_province_in_admin');

function display_shipping_province_in_admin($order) {
    $province = get_post_meta($order->get_id(), 'Shipping Province', true);
    $phone = get_post_meta($order->get_id(), 'Shipping Phone', true);
    echo '<p><strong>Province:</strong> ' . esc_html($province) . '</p>';
    echo '<p><strong>Phone Number:</strong> ' . esc_html($phone) . '</p>';
}



