<?php   
    $heading = get_sub_field('heading');
    $paddingTop = get_sub_field('paddingTop');
    $paddingBottom = get_sub_field('paddingBottom');
    $paddingTop_mobile = get_sub_field('paddingTop_mobile');
    $paddingBottom_mobile = get_sub_field('paddingBottom_mobile');
?>
<section class="section collection pt-<?php echo $paddingTop_mobile ?> pb-<?php echo $paddingBottom_mobile ?> pt-md-<?php echo $paddingTop ?> pb-md-<?php echo $paddingBottom ?>">
    <div class="container collection__container">
        <?php if($heading): ?>
            <div class="row">
                <div class="col-lg-6 offset-lg-3 heading content-block text--center">
                    <?php echo $heading; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if( have_rows('collection_row') ):?>
            <div class="collection__list">
                <?php  while( have_rows('collection_row') ) : the_row();
                 $image = get_sub_field('image');
                 $title = get_sub_field('title');
                ?>
                    <div class="collection__item animate fade-up">
                        <?php if( !empty( $image ) ): ?>
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                        <?php endif; ?>
                        <?php if($title): ?>
                            <div class="collection__itemTitle">
                                <?php echo $title; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile;?>
            </div>
        <?php endif; ?>
    </div>
</section>
