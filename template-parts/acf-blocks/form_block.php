<?php 
$content = get_sub_field('text');
$image = get_sub_field('image');
$backgroundColor = get_sub_field('background_color');
$form = get_sub_field('form_shortcode');
$hideLabel = get_sub_field('hide_parallax_label');
$wideContent = get_sub_field('wide_content');
$paddingTop = get_sub_field('paddingTop');
$paddingBottom = get_sub_field('paddingBottom');
$paddingTop_mobile = get_sub_field('paddingTop_mobile');
$paddingBottom_mobile = get_sub_field('paddingBottom_mobile');

$blockID = get_sub_field('block_id');
$id = $blockID?'id="'.$blockID.'"':'id="request_a_quote"';
?>
<section <?php echo $id; ?> class="pt-<?php echo $paddingTop_mobile ?> pb-<?php echo $paddingBottom_mobile ?> pt-md-<?php echo $paddingTop ?> pb-md-<?php echo $paddingBottom ?> section formImageBlock formImageBlock--<?php echo $imagePosition; ?>" style="background-color: <?php echo $backgroundColor; ?>">
    <div class="container animate fade-up">
        <div class="row row--y--midle">
            <div class="col-lg-6 offset-lg-3<?php echo $contentClasses; ?> formImageBlock__content text-color-white">
                    <div class="formImageBlock__content__inner">
                        <?php if($content): ?>
                            <div class="content-block animate fade-up"><?php echo $content; ?></div>
                        <?php endif; ?>
                        <?php if($form): ?>
                            <div class="form form--request-demo animate fade-up delay-1"><?php echo do_shortcode($form);?></div>
                        <?php endif; ?>
                    </div>
            </div>
        </div>
    </div>
</section>