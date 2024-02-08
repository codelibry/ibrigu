<?php
    $formShortcode = get_sub_field('form_shortcode');
    $paddingTop = get_sub_field('paddingTop');
    $paddingBottom = get_sub_field('paddingBottom');
    $paddingTop_mobile = get_sub_field('paddingTop_mobile');
    $paddingBottom_mobile = get_sub_field('paddingBottom_mobile');
?>

<?php if($formShortcode) :?>
    <section class="contacts-block section pt-<?php echo $paddingTop_mobile ?> pb-<?php echo $paddingBottom_mobile ?> pt-md-<?php echo $paddingTop ?> pb-md-<?php echo $paddingBottom ?>">
        <div class="container">
            <div class="row">
                <div class="contacts-block__infoWrapper col-lg-6">
                    <?php if( have_rows('offices') ):?>
                        <div class="contacts-block__infoWrapper-col">
                            <ul class="contacts-block__officesList p-0">
                                <?php  while( have_rows('offices') ) : the_row();
                                    $office = get_sub_field('office');
                                    ?>
                                    <?php if($office) :?>
                                        <li class="contacts-block__officesItem">
                                            <?php echo $office ?>
                                        </li>
                                    <?php endif;?>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    <?php endif;?>
                    <div class="horizontal-line color--black"></div>
                    <?php if( have_rows('contacts') ):?>
                        <div class="contacts-block__infoWrapper-col">
                            <h5>
                                <?php _e('TELEPHONE');?>
                            </h5>
                            <ul class="contacts-block__contactsList p-0 d-flex flex-wrap">
                                <?php  while( have_rows('contacts') ) : the_row();
                                    $contacts = get_sub_field('contactsItem');
                                    ?>
                                    <?php if($contacts) :?>
                                        <li class="contacts-block__contactsItem col-6 col-xl-12 p-0">
                                            <?php echo $contacts ?>
                                        </li>
                                    <?php endif;?>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    <?php endif;?>
                </div>
                <div class="contacts-block__formWrapper form col-lg-6">
                    <?php echo do_shortcode($formShortcode) ?>
                </div>
            </div>
            <?php if( have_rows('social_list') ):?>
                <ul class="contacts-block__social pt-5 row d-flex align-items-center justify-content-center">
                    <?php  while( have_rows('social_list') ) : the_row();
                        $social = get_sub_field('social');
                        ?>
                        <li class="contacts-block__socialItem">
                            <?php
                                if( $social ):
                                    $link_url = $social['url'];
                                    $link_title = $social['title'];
                                    $link_target = $social['target'] ? $social['target'] : '_self';
                                    ?>
                                    <a class="contacts-block__socialItemLink" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                <?php endif; ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif;?>
        </div>
    </section>
<?php endif; ?>
