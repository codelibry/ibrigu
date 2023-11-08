<!--<a class="back_to_top text--center py-2 py-md-5 d-flex align-items-center justify-content-center" title="">-->
<!--	<svg xmlns="http://www.w3.org/2000/svg" width="26.006" height="24.764" viewBox="0 0 26.006 24.764">-->
<!--  <g id="Icon_feather-arrow-up" data-name="Icon feather-arrow-up" transform="translate(-5.379 -6)">-->
<!--    <path id="Контур_8" data-name="Контур 8" d="M18,29.264V7.5" transform="translate(0.382 0)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>-->
<!--    <path id="Контур_9" data-name="Контур 9" d="M7.5,18.382,18.382,7.5,29.264,18.382" transform="translate(0 0)" fill="none" stroke="#000" stroke-linecap="round" stroke-linejoin="round" stroke-width="3"/>-->
<!--  </g>-->
<!--</svg>-->
<!--</a>-->
<?php 
	$menu_location = 'footer-menu-1';
	$menu_locations = get_nav_menu_locations();
	$menu_object = (isset($menu_locations[$menu_location]) ? wp_get_nav_menu_object($menu_locations[$menu_location]) : null);
	$menu_name = (isset($menu_object->name) ? $menu_object->name : '');

	$menu_location_2 = 'footer-menu-2';
	$menu_locations_2 = get_nav_menu_locations();
	$menu_object_2 = (isset($menu_locations_2[$menu_location_2]) ? wp_get_nav_menu_object($menu_locations_2[$menu_location_2]) : null);
	$menu_name_2 = (isset($menu_object_2->name) ? $menu_object_2->name : '');

	$menu_location_3 = 'footer-menu-3';
	$menu_locations_3 = get_nav_menu_locations();
	$menu_object_3 = (isset($menu_locations_3[$menu_location_3]) ? wp_get_nav_menu_object($menu_locations_3[$menu_location_3]) : null);
	$menu_name_3 = (isset($menu_object_3->name) ? $menu_object_3->name : '');

	$footer_text = get_field('footer_text','option');
?>
<footer id="footer" class="footer">

	<div class="footer__main bg--white">

			<div class="container">
				<div class="row">

                    <div class="col-12 col-lg-2 col-md-4 footer__main__col footer__main__col-3">
                        <?php
                            $footerSocials = get_field('footer_socials','option');
                            if($footerSocials):
                                ?>
                                <div class="footer__main__social">
                                    <ul class="footer__main__social__list">
                                        <?php foreach($footerSocials as $item):
                                            $icon = $item['icon'];
                                            $link = $item['link'];
                                            if($icon && $link) :
                                                ?>
                                                <li>
                                                    <a href="<?php echo esc_url( $link['url'] ); ?>" target="<?php echo esc_attr( $link['target'] ? : '_self' ); ?>" title="<?php echo esc_html( $link['title'] ); ?>">
                                                        <img src="<?php echo esc_url($icon['url']);?>" alt="<?php echo esc_attr($icon['title']);?>">
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>

                                </div>
                            <?php endif; ?>
                    </div>

                    <div class="col-12 col-lg-2 col-md-4 col-sm-6 footer__main__col footer__main__col-1">
						<nav class="footer__main__nav font-weight-600">
							<h4 class="font-weight-400 footer__menu__title"><?php echo esc_html($menu_name); ?></h4>
							<?php wp_nav_menu( array('menu_id'=>'footer-nav_1','container_class' => 'footer-nav','theme_location' => 'footer-menu-1') ); ?>
						</nav>
					</div>
					
					<div class="col-12 col-lg-2 col-md-4 col-sm-6 footer__main__col footer__main__col-2">
						<nav class="footer__main__nav font-weight-600">
							<h4 class="footer__menu__title"><?php echo esc_html($menu_name_2); ?></h4>
							<?php wp_nav_menu( array('menu_id'=>'footer-nav','container_class' => 'footer-nav','theme_location' => 'footer-menu-2') ); ?>
						</nav>
					</div>

					<div class="col-12 col-lg-4 offset-lg-2 footer__main__col footer__main__col-4">
						
						<?php 
						$enableFooterNewsletter = get_field('enable_footer_newsletter','option');
						$footereNewsletter = get_field('footer_newsletter_form','option');
						$footereNewsletterTitle = get_field('footer_newsletter_title','option');
						if($enableFooterNewsletter && $footereNewsletter):
						?>
							<div class="form form--newsletter footer__main__newsletter">
								<?php if($footereNewsletterTitle): ?>
									<?php echo $footereNewsletterTitle; ?>
								<?php endif; ?>
								<?php echo do_shortcode($footereNewsletter); ?>
							</div>
						<?php endif; ?>
						
					</div>
				</div>
			</div>
		</div>

		<div class="footer__bottom bg--white--light">
			<div class="container footer__bottom__inner">
                    <div class="text--opacity footer__bottom__copyright">
                        <?php echo __('IBRIGU') . ' ' . date('Y');?>©
                    </div>

					<div class="footer__bottom__nav">
						<?php
						$menu = wp_nav_menu(
							array (
								'menu_id'=>'footer-nav',
								'container_class' => 'footer-nav',
								'theme_location' => 'footer-bottom-menu',
								'echo' => FALSE,
								'fallback_cb' => '__return_false'
							)
						);

						if ( ! empty ( $menu ) )
						{
							echo $menu;
						}?>
					</div>

			</div>
		</div>

</footer>	
	