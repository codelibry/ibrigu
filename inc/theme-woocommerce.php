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
    <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide phone-country-code">
        <span class="phone-country-code-pseudo-el"></span>
        <select name="billing_phone_country_code" id="billing_phone_country_code">
        <!-- <option value="" <?php selected('', $billing_phone_country_code); ?>><?php _e('Select country code', 'woocommerce_custom_text'); ?></option> 
            <option value="+93" <?php selected('+93', $billing_phone_country_code); ?>>Afghanistan +93</option>
            <option value="+355" <?php selected('+355', $billing_phone_country_code); ?>>Albania +355</option> 
            <option value="+213" <?php selected('+213', $billing_phone_country_code); ?>>Algeria +213</option>
            <option value="+1-684" <?php selected('+1-684', $billing_phone_country_code); ?>>American Samoa +1-684</option>
            <option value="+376" <?php selected('+376', $billing_phone_country_code); ?>>Andorra +376</option>
            <option value="+244" <?php selected('+244', $billing_phone_country_code); ?>>Angola +244</option>
            <option value="+1-264" <?php selected('+1-264', $billing_phone_country_code); ?>>Anguilla +1-264</option>
            <option value="+672" <?php selected('+672', $billing_phone_country_code); ?>>Antarctica +672</option>
            <option value="+1-268" <?php selected('+1-268', $billing_phone_country_code); ?>>Antigua and Barbuda +1-268</option>
            <option value="+54" <?php selected('+54', $billing_phone_country_code); ?>>Argentina +54</option>
            <option value="+374" <?php selected('+374', $billing_phone_country_code); ?>>Armenia +374</option>
            <option value="+297" <?php selected('+297', $billing_phone_country_code); ?>>Aruba +297</option>
            <option value="+61" <?php selected('+61', $billing_phone_country_code); ?>>Australia +61</option>
            <option value="+43" <?php selected('+43', $billing_phone_country_code); ?>>Austria +43</option>
            <option value="+994" <?php selected('+994', $billing_phone_country_code); ?>>Azerbaijan +994</option>
            <option value="+1-242" <?php selected('+1-242', $billing_phone_country_code); ?>>Bahamas +1-242</option>
            <option value="+973" <?php selected('+973', $billing_phone_country_code); ?>>Bahrain +973</option>
            <option value="+880" <?php selected('+880', $billing_phone_country_code); ?>>Bangladesh +880</option>
            <option value="+1-246" <?php selected('+1-246', $billing_phone_country_code); ?>>Barbados +1-246</option>
            <option value="+375" <?php selected('+375', $billing_phone_country_code); ?>>Belarus +375</option>
            <option value="+32" <?php selected('+32', $billing_phone_country_code); ?>>Belgium +32</option>
            <option value="+501" <?php selected('+501', $billing_phone_country_code); ?>>Belize +501</option>
            <option value="+229" <?php selected('+229', $billing_phone_country_code); ?>>Benin +229</option>
            <option value="+1-441" <?php selected('+1-441', $billing_phone_country_code); ?>>Bermuda +1-441</option>
            <option value="+975" <?php selected('+975', $billing_phone_country_code); ?>>Bhutan +975</option>
            <option value="+591" <?php selected('+591', $billing_phone_country_code); ?>>Bolivia +591</option>
            <option value="+387" <?php selected('+387', $billing_phone_country_code); ?>>Bosnia and Herzegovina +387</option>
            <option value="+267" <?php selected('+267', $billing_phone_country_code); ?>>Botswana +267</option>
            <option value="+55" <?php selected('+55', $billing_phone_country_code); ?>>Brazil +55</option>
            <option value="+246" <?php selected('+246', $billing_phone_country_code); ?>>British Indian Ocean Territory +246</option>
            <option value="+1-284" <?php selected('+1-284', $billing_phone_country_code); ?>>British Virgin Islands +1-284</option>
            <option value="+673" <?php selected('+673', $billing_phone_country_code); ?>>Brunei +673</option>
            <option value="+359" <?php selected('+359', $billing_phone_country_code); ?>>Bulgaria +359</option>
            <option value="+226" <?php selected('+226', $billing_phone_country_code); ?>>Burkina Faso +226</option>
            <option value="+257" <?php selected('+257', $billing_phone_country_code); ?>>Burundi +257</option>
            <option value="+855" <?php selected('+855', $billing_phone_country_code); ?>>Cambodia +855</option>
            <option value="+237" <?php selected('+237', $billing_phone_country_code); ?>>Cameroon +237</option>
            <option value="+1" <?php selected('+1', $billing_phone_country_code); ?>>Canada +1</option>
            <option value="+238" <?php selected('+238', $billing_phone_country_code); ?>>Cape Verde +238</option>
            <option value="+1-345" <?php selected('+1-345', $billing_phone_country_code); ?>>Cayman Islands +1-345</option>
            <option value="+236" <?php selected('+236', $billing_phone_country_code); ?>>Central African Republic +236</option>
            <option value="+235" <?php selected('+235', $billing_phone_country_code); ?>>Chad +235</option>
            <option value="+56" <?php selected('+56', $billing_phone_country_code); ?>>Chile +56</option>
            <option value="+86" <?php selected('+86', $billing_phone_country_code); ?>>China +86</option>
            <option value="+61" <?php selected('+61', $billing_phone_country_code); ?>>Christmas Island +61</option>
            <option value="+61" <?php selected('+61', $billing_phone_country_code); ?>>Cocos Islands +61</option>
            <option value="+57" <?php selected('+57', $billing_phone_country_code); ?>>Colombia +57</option>
            <option value="+269" <?php selected('+269', $billing_phone_country_code); ?>>Comoros +269</option>
            <option value="+682" <?php selected('+682', $billing_phone_country_code); ?>>Cook Islands +682</option>
            <option value="+506" <?php selected('+506', $billing_phone_country_code); ?>>Costa Rica +506</option>
            <option value="+385" <?php selected('+385', $billing_phone_country_code); ?>>Croatia +385</option>
            <option value="+53" <?php selected('+53', $billing_phone_country_code); ?>>Cuba +53</option>
            <option value="+599" <?php selected('+599', $billing_phone_country_code); ?>>Curacao +599</option>
            <option value="+357" <?php selected('+357', $billing_phone_country_code); ?>>Cyprus +357</option>
            <option value="+420" <?php selected('+420', $billing_phone_country_code); ?>>Czech Republic +420</option>
            <option value="+243" <?php selected('+243', $billing_phone_country_code); ?>>Democratic Republic of the Congo +243</option>
            <option value="+45" <?php selected('+45', $billing_phone_country_code); ?>>Denmark +45</option>
            <option value="+253" <?php selected('+253', $billing_phone_country_code); ?>>Djibouti +253</option>
            <option value="+1-767" <?php selected('+1-767', $billing_phone_country_code); ?>>Dominica +1-767</option>
            <option value="+1-809" <?php selected('+1-809', $billing_phone_country_code); ?>>Dominican Republic +1-809</option>
            <option value="+1-829" <?php selected('+1-829', $billing_phone_country_code); ?>>Dominican Republic +1-829</option>
            <option value="+1-849" <?php selected('+1-849', $billing_phone_country_code); ?>>Dominican Republic +1-849</option>
            <option value="+670" <?php selected('+670', $billing_phone_country_code); ?>>East Timor +670</option>
            <option value="+593" <?php selected('+593', $billing_phone_country_code); ?>>Ecuador +593</option>
            <option value="+20" <?php selected('+20', $billing_phone_country_code); ?>>Egypt +20</option>
            <option value="+503" <?php selected('+503', $billing_phone_country_code); ?>>El Salvador +503</option>
            <option value="+240" <?php selected('+240', $billing_phone_country_code); ?>>Equatorial Guinea +240</option>
            <option value="+291" <?php selected('+291', $billing_phone_country_code); ?>>Eritrea +291</option>
            <option value="+372" <?php selected('+372', $billing_phone_country_code); ?>>Estonia +372</option>
            <option value="+251" <?php selected('+251', $billing_phone_country_code); ?>>Ethiopia +251</option>
            <option value="+500" <?php selected('+500', $billing_phone_country_code); ?>>Falkland Islands +500</option>
            <option value="+298" <?php selected('+298', $billing_phone_country_code); ?>>Faroe Islands +298</option>
            <option value="+679" <?php selected('+679', $billing_phone_country_code); ?>>Fiji +679</option>
            <option value="+358" <?php selected('+358', $billing_phone_country_code); ?>>Finland +358</option>
            <option value="+33" <?php selected('+33', $billing_phone_country_code); ?>>France +33</option>
            <option value="+689" <?php selected('+689', $billing_phone_country_code); ?>>French Polynesia +689</option>
            <option value="+241" <?php selected('+241', $billing_phone_country_code); ?>>Gabon +241</option>
            <option value="+220" <?php selected('+220', $billing_phone_country_code); ?>>Gambia +220</option>
            <option value="+995" <?php selected('+995', $billing_phone_country_code); ?>>Georgia +995</option>
            <option value="+49" <?php selected('+49', $billing_phone_country_code); ?>>Germany +49</option>
            <option value="+233" <?php selected('+233', $billing_phone_country_code); ?>>Ghana +233</option>
            <option value="+350" <?php selected('+350', $billing_phone_country_code); ?>>Gibraltar +350</option>
            <option value="+30" <?php selected('+30', $billing_phone_country_code); ?>>Greece +30</option>
            <option value="+299" <?php selected('+299', $billing_phone_country_code); ?>>Greenland +299</option>
            <option value="+1-473" <?php selected('+1-473', $billing_phone_country_code); ?>>Grenada +1-473</option>
            <option value="+1-671" <?php selected('+1-671', $billing_phone_country_code); ?>>Guam +1-671</option>
            <option value="+502" <?php selected('+502', $billing_phone_country_code); ?>>Guatemala +502</option>
            <option value="+44" <?php selected('+44', $billing_phone_country_code); ?>>Guernsey +44</option>
            <option value="+224" <?php selected('+224', $billing_phone_country_code); ?>>Guinea +224</option>
            <option value="+245" <?php selected('+245', $billing_phone_country_code); ?>>Guinea-Bissau +245</option>
            <option value="+592" <?php selected('+592', $billing_phone_country_code); ?>>Guyana +592</option>
            <option value="+509" <?php selected('+509', $billing_phone_country_code); ?>>Haiti +509</option>
            <option value="+504" <?php selected('+504', $billing_phone_country_code); ?>>Honduras +504</option>
            <option value="+852" <?php selected('+852', $billing_phone_country_code); ?>>Hong Kong +852</option>
            <option value="+36" <?php selected('+36', $billing_phone_country_code); ?>>Hungary +36</option>
            <option value="+354" <?php selected('+354', $billing_phone_country_code); ?>>Iceland +354</option>
            <option value="+91" <?php selected('+91', $billing_phone_country_code); ?>>India +91</option>
            <option value="+62" <?php selected('+62', $billing_phone_country_code); ?>>Indonesia +62</option>
            <option value="+98" <?php selected('+98', $billing_phone_country_code); ?>>Iran +98</option>
            <option value="+964" <?php selected('+964', $billing_phone_country_code); ?>>Iraq +964</option>
            <option value="+353" <?php selected('+353', $billing_phone_country_code); ?>>Ireland +353</option>
            <option value="+44" <?php selected('+44', $billing_phone_country_code); ?>>Isle of Man +44</option>
            <option value="+972" <?php selected('+972', $billing_phone_country_code); ?>>Israel +972</option> -->
            <option value="+39" selected="selected" <?php selected('+39', $billing_phone_country_code); ?>>Italy +39</option>
            <!-- <option value="+225" <?php selected('+225', $billing_phone_country_code); ?>>Ivory Coast +225</option>
            <option value="+1-876" <?php selected('+1-876', $billing_phone_country_code); ?>>Jamaica +1-876</option>
            <option value="+81" <?php selected('+81', $billing_phone_country_code); ?>>Japan +81</option>
            <option value="+44" <?php selected('+44', $billing_phone_country_code); ?>>Jersey +44</option>
            <option value="+962" <?php selected('+962', $billing_phone_country_code); ?>>Jordan +962</option>
            <option value="+7" <?php selected('+7', $billing_phone_country_code); ?>>Kazakhstan +7</option>
            <option value="+254" <?php selected('+254', $billing_phone_country_code); ?>>Kenya +254</option>
            <option value="+686" <?php selected('+686', $billing_phone_country_code); ?>>Kiribati +686</option>
            <option value="+383" <?php selected('+383', $billing_phone_country_code); ?>>Kosovo +383</option>
            <option value="+965" <?php selected('+965', $billing_phone_country_code); ?>>Kuwait +965</option>
            <option value="+996" <?php selected('+996', $billing_phone_country_code); ?>>Kyrgyzstan +996</option>
            <option value="+856" <?php selected('+856', $billing_phone_country_code); ?>>Laos +856</option>
            <option value="+371" <?php selected('+371', $billing_phone_country_code); ?>>Latvia +371</option>
            <option value="+961" <?php selected('+961', $billing_phone_country_code); ?>>Lebanon +961</option>
            <option value="+266" <?php selected('+266', $billing_phone_country_code); ?>>Lesotho +266</option>
            <option value="+231" <?php selected('+231', $billing_phone_country_code); ?>>Liberia +231</option>
            <option value="+218" <?php selected('+218', $billing_phone_country_code); ?>>Libya +218</option>
            <option value="+423" <?php selected('+423', $billing_phone_country_code); ?>>Liechtenstein +423</option>
            <option value="+370" <?php selected('+370', $billing_phone_country_code); ?>>Lithuania +370</option>
            <option value="+352" <?php selected('+352', $billing_phone_country_code); ?>>Luxembourg +352</option>
            <option value="+853" <?php selected('+853', $billing_phone_country_code); ?>>Macao +853</option>
            <option value="+389" <?php selected('+389', $billing_phone_country_code); ?>>Macedonia +389</option>
            <option value="+261" <?php selected('+261', $billing_phone_country_code); ?>>Madagascar +261</option>
            <option value="+265" <?php selected('+265', $billing_phone_country_code); ?>>Malawi +265</option>
            <option value="+60" <?php selected('+60', $billing_phone_country_code); ?>>Malaysia +60</option>
            <option value="+960" <?php selected('+960', $billing_phone_country_code); ?>>Maldives +960</option>
            <option value="+223" <?php selected('+223', $billing_phone_country_code); ?>>Mali +223</option>
            <option value="+356" <?php selected('+356', $billing_phone_country_code); ?>>Malta +356</option>
            <option value="+692" <?php selected('+692', $billing_phone_country_code); ?>>Marshall Islands +692</option>
            <option value="+222" <?php selected('+222', $billing_phone_country_code); ?>>Mauritania +222</option>
            <option value="+230" <?php selected('+230', $billing_phone_country_code); ?>>Mauritius +230</option>
            <option value="+262" <?php selected('+262', $billing_phone_country_code); ?>>Mayotte +262</option>
            <option value="+52" <?php selected('+52', $billing_phone_country_code); ?>>Mexico +52</option>
            <option value="+691" <?php selected('+691', $billing_phone_country_code); ?>>Micronesia +691</option>
            <option value="+373" <?php selected('+373', $billing_phone_country_code); ?>>Moldova +373</option>
            <option value="+377" <?php selected('+377', $billing_phone_country_code); ?>>Monaco +377</option>
            <option value="+976" <?php selected('+976', $billing_phone_country_code); ?>>Mongolia +976</option>
            <option value="+382" <?php selected('+382', $billing_phone_country_code); ?>>Montenegro +382</option>
            <option value="+1-664" <?php selected('+1-664', $billing_phone_country_code); ?>>Montserrat +1-664</option>
            <option value="+212" <?php selected('+212', $billing_phone_country_code); ?>>Morocco +212</option>
            <option value="+258" <?php selected('+258', $billing_phone_country_code); ?>>Mozambique +258</option>
            <option value="+95" <?php selected('+95', $billing_phone_country_code); ?>>Myanmar +95</option>
            <option value="+264" <?php selected('+264', $billing_phone_country_code); ?>>Namibia +264</option>
            <option value="+674" <?php selected('+674', $billing_phone_country_code); ?>>Nauru +674</option>
            <option value="+977" <?php selected('+977', $billing_phone_country_code); ?>>Nepal +977</option>
            <option value="+31" <?php selected('+31', $billing_phone_country_code); ?>>Netherlands +31</option>
            <option value="+599" <?php selected('+599', $billing_phone_country_code); ?>>Netherlands Antilles +599</option>
            <option value="+687" <?php selected('+687', $billing_phone_country_code); ?>>New Caledonia +687</option>
            <option value="+64" <?php selected('+64', $billing_phone_country_code); ?>>New Zealand +64</option>
            <option value="+505" <?php selected('+505', $billing_phone_country_code); ?>>Nicaragua +505</option>
            <option value="+227" <?php selected('+227', $billing_phone_country_code); ?>>Niger +227</option>
            <option value="+234" <?php selected('+234', $billing_phone_country_code); ?>>Nigeria +234</option>
            <option value="+683" <?php selected('+683', $billing_phone_country_code); ?>>Niue +683</option>
            <option value="+672" <?php selected('+672', $billing_phone_country_code); ?>>Norfolk Island +672</option>
            <option value="+850" <?php selected('+850', $billing_phone_country_code); ?>>North Korea +850</option>
            <option value="+1-670" <?php selected('+1-670', $billing_phone_country_code); ?>>Northern Mariana Islands +1-670</option>
            <option value="+47" <?php selected('+47', $billing_phone_country_code); ?>>Norway +47</option>
            <option value="+968" <?php selected('+968', $billing_phone_country_code); ?>>Oman +968</option>
            <option value="+92" <?php selected('+92', $billing_phone_country_code); ?>>Pakistan +92</option>
            <option value="+680" <?php selected('+680', $billing_phone_country_code); ?>>Palau +680</option>
            <option value="+970" <?php selected('+970', $billing_phone_country_code); ?>>Palestinian Territory +970</option>
            <option value="+507" <?php selected('+507', $billing_phone_country_code); ?>>Panama +507</option>
            <option value="+675" <?php selected('+675', $billing_phone_country_code); ?>>Papua New Guinea +675</option>
            <option value="+595" <?php selected('+595', $billing_phone_country_code); ?>>Paraguay +595</option>
            <option value="+51" <?php selected('+51', $billing_phone_country_code); ?>>Peru +51</option>
            <option value="+63" <?php selected('+63', $billing_phone_country_code); ?>>Philippines +63</option>
            <option value="+870" <?php selected('+870', $billing_phone_country_code); ?>>Pitcairn +870</option>
            <option value="+48" <?php selected('+48', $billing_phone_country_code); ?>>Poland +48</option>
            <option value="+351" <?php selected('+351', $billing_phone_country_code); ?>>Portugal +351</option>
            <option value="+1-787" <?php selected('+1-787', $billing_phone_country_code); ?>>Puerto Rico +1-787</option>
            <option value="+1-939" <?php selected('+1-939', $billing_phone_country_code); ?>>Puerto Rico +1-939</option>
            <option value="+974" <?php selected('+974', $billing_phone_country_code); ?>>Qatar +974</option>
            <option value="+242" <?php selected('+242', $billing_phone_country_code); ?>>Republic of the Congo +242</option>
            <option value="+262" <?php selected('+262', $billing_phone_country_code); ?>>Reunion +262</option>
            <option value="+40" <?php selected('+40', $billing_phone_country_code); ?>>Romania +40</option>
            <option value="+7" <?php selected('+7', $billing_phone_country_code); ?>>Russia +7</option>
            <option value="+250" <?php selected('+250', $billing_phone_country_code); ?>>Rwanda +250</option>
            <option value="+590" <?php selected('+590', $billing_phone_country_code); ?>>Saint Barthelemy +590</option>
            <option value="+290" <?php selected('+290', $billing_phone_country_code); ?>>Saint Helena +290</option>
            <option value="+1-869" <?php selected('+1-869', $billing_phone_country_code); ?>>Saint Kitts and Nevis +1-869</option>
            <option value="+1-758" <?php selected('+1-758', $billing_phone_country_code); ?>>Saint Lucia +1-758</option>
            <option value="+590" <?php selected('+590', $billing_phone_country_code); ?>>Saint Martin +590</option>
            <option value="+508" <?php selected('+508', $billing_phone_country_code); ?>>Saint Pierre and Miquelon +508</option>
            <option value="+1-784" <?php selected('+1-784', $billing_phone_country_code); ?>>Saint Vincent and the Grenadines +1-784</option>
            <option value="+685" <?php selected('+685', $billing_phone_country_code); ?>>Samoa +685</option>
            <option value="+378" <?php selected('+378', $billing_phone_country_code); ?>>San Marino +378</option>
            <option value="+239" <?php selected('+239', $billing_phone_country_code); ?>>Sao Tome and Principe +239</option>
            <option value="+966" <?php selected('+966', $billing_phone_country_code); ?>>Saudi Arabia +966</option>
            <option value="+221" <?php selected('+221', $billing_phone_country_code); ?>>Senegal +221</option>
            <option value="+381" <?php selected('+381', $billing_phone_country_code); ?>>Serbia +381</option>
            <option value="+248" <?php selected('+248', $billing_phone_country_code); ?>>Seychelles +248</option>
            <option value="+232" <?php selected('+232', $billing_phone_country_code); ?>>Sierra Leone +232</option>
            <option value="+65" <?php selected('+65', $billing_phone_country_code); ?>>Singapore +65</option>
            <option value="+1-721" <?php selected('+1-721', $billing_phone_country_code); ?>>Sint Maarten +1-721</option>
            <option value="+421" <?php selected('+421', $billing_phone_country_code); ?>>Slovakia +421</option>
            <option value="+386" <?php selected('+386', $billing_phone_country_code); ?>>Slovenia +386</option>
            <option value="+677" <?php selected('+677', $billing_phone_country_code); ?>>Solomon Islands +677</option>
            <option value="+252" <?php selected('+252', $billing_phone_country_code); ?>>Somalia +252</option>
            <option value="+27" <?php selected('+27', $billing_phone_country_code); ?>>South Africa +27</option>
            <option value="+82" <?php selected('+82', $billing_phone_country_code); ?>>South Korea +82</option>
            <option value="+211" <?php selected('+211', $billing_phone_country_code); ?>>South Sudan +211</option>
            <option value="+34" <?php selected('+34', $billing_phone_country_code); ?>>Spain +34</option>
            <option value="+94" <?php selected('+94', $billing_phone_country_code); ?>>Sri Lanka +94</option>
            <option value="+249" <?php selected('+249', $billing_phone_country_code); ?>>Sudan +249</option>
            <option value="+597" <?php selected('+597', $billing_phone_country_code); ?>>Suriname +597</option>
            <option value="+47" <?php selected('+47', $billing_phone_country_code); ?>>Svalbard and Jan Mayen +47</option>
            <option value="+268" <?php selected('+268', $billing_phone_country_code); ?>>Swaziland +268</option>
            <option value="+46" <?php selected('+46', $billing_phone_country_code); ?>>Sweden +46</option>
            <option value="+41" <?php selected('+41', $billing_phone_country_code); ?>>Switzerland +41</option>
            <option value="+963" <?php selected('+963', $billing_phone_country_code); ?>>Syria +963</option>
            <option value="+886" <?php selected('+886', $billing_phone_country_code); ?>>Taiwan +886</option>
            <option value="+992" <?php selected('+992', $billing_phone_country_code); ?>>Tajikistan +992</option>
            <option value="+255" <?php selected('+255', $billing_phone_country_code); ?>>Tanzania +255</option>
            <option value="+66" <?php selected('+66', $billing_phone_country_code); ?>>Thailand +66</option>
            <option value="+228" <?php selected('+228', $billing_phone_country_code); ?>>Togo +228</option>
            <option value="+690" <?php selected('+690', $billing_phone_country_code); ?>>Tokelau +690</option>
            <option value="+676" <?php selected('+676', $billing_phone_country_code); ?>>Tonga +676</option>
            <option value="+1-868" <?php selected('+1-868', $billing_phone_country_code); ?>>Trinidad and Tobago +1-868</option>
            <option value="+216" <?php selected('+216', $billing_phone_country_code); ?>>Tunisia +216</option>
            <option value="+90" <?php selected('+90', $billing_phone_country_code); ?>>Turkey +90</option>
            <option value="+993" <?php selected('+993', $billing_phone_country_code); ?>>Turkmenistan +993</option>
            <option value="+1-649" <?php selected('+1-649', $billing_phone_country_code); ?>>Turks and Caicos Islands +1-649</option>
            <option value="+688" <?php selected('+688', $billing_phone_country_code); ?>>Tuvalu +688</option>
            <option value="+1-340" <?php selected('+1-340', $billing_phone_country_code); ?>>U.S. Virgin Islands +1-340</option>
            <option value="+256" <?php selected('+256', $billing_phone_country_code); ?>>Uganda +256</option>
            <option value="+380" <?php selected('+380', $billing_phone_country_code); ?>>Ukraine +380</option>
            <option value="+971" <?php selected('+971', $billing_phone_country_code); ?>>United Arab Emirates +971</option>
            <option value="+44" <?php selected('+44', $billing_phone_country_code); ?>>United Kingdom +44</option>
            <option value="+1" <?php selected('+1', $billing_phone_country_code); ?>>United States +1</option>
            <option value="+598" <?php selected('+598', $billing_phone_country_code); ?>>Uruguay +598</option>
            <option value="+998" <?php selected('+998', $billing_phone_country_code); ?>>Uzbekistan +998</option>
            <option value="+678" <?php selected('+678', $billing_phone_country_code); ?>>Vanuatu +678</option>
            <option value="+379" <?php selected('+379', $billing_phone_country_code); ?>>Vatican +379</option>
            <option value="+58" <?php selected('+58', $billing_phone_country_code); ?>>Venezuela +58</option>
            <option value="+84" <?php selected('+84', $billing_phone_country_code); ?>>Vietnam +84</option>
            <option value="+681" <?php selected('+681', $billing_phone_country_code); ?>>Wallis and Futuna +681</option>
            <option value="+212" <?php selected('+212', $billing_phone_country_code); ?>>Western Sahara +212</option>
            <option value="+967" <?php selected('+967', $billing_phone_country_code); ?>>Yemen +967</option>
            <option value="+260" <?php selected('+260', $billing_phone_country_code); ?>>Zambia +260</option>
            <option value="+263" <?php selected('+263', $billing_phone_country_code); ?>>Zimbabwe +263</option> -->
        </select>
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
	if (isset($_POST['billing_phone']) && isset($_POST['billing_phone_country_code'])) {
        update_user_meta($customer_id, 'billing_phone', sanitize_text_field($_POST['billing_phone_country_code']) . sanitize_text_field($_POST['billing_phone']));
    } elseif(isset($_POST['billing_phone'])){
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



//Change Default Products Ordering 
add_filter( 'woocommerce_get_catalog_ordering_args', 'custom_catalog_ordering_args' );

function custom_catalog_ordering_args( $args ) {
    $args['orderby'] = 'date'; 
    $args['order'] = 'DESC'; 
    return $args;
}


//ACF Field for variation
add_action( 'woocommerce_product_after_variable_attributes', 'add_variation_custom_field', 10, 3 );

function add_variation_custom_field( $loop, $variation_data, $variation ) {
    $custom_field_value = get_post_meta( $variation->ID, 'custom_field_name', true );
    ?>
    <tr>
        <td>
            <?php
            echo '<label for="custom_field_name_' . $loop . '">' . __( 'Custom Field', 'woocommerce' ) . '</label>';

            echo '<input type="text" name="custom_field_name[' . $loop . ']" value="' . esc_attr( $custom_field_value ) . '" />';
            ?>
        </td>
    </tr>
    <?php
}

add_action( 'woocommerce_save_product_variation', 'save_variation_custom_field', 10, 2 );

function save_variation_custom_field( $variation_id, $i ) {
    if ( isset( $_POST['custom_field_name'][ $i ] ) ) {
        $custom_field_value = sanitize_text_field( $_POST['custom_field_name'][ $i ] );

        $variation = wc_get_product( $variation_id );

        $variation->update_meta_data( 'custom_field_name', $custom_field_value );

        $variation->save();
    }
}

add_filter( 'woocommerce_available_variation', 'display_variation_custom_field', 10, 3 );

function display_variation_custom_field( $data, $product, $variation ) {
    $custom_field_value = $variation->get_meta( 'custom_field_name' );

    $data['custom_field_name'] = $custom_field_value;

    return $data;
}
