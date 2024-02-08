<?php
    $content = get_sub_field('content');
    
    $imageLayout = get_sub_field('media_layout');
    $imagePosition = get_sub_field('image_position');
    $imageType = get_sub_field('image_type');
    $image = get_sub_field('image');
    $video = get_sub_field('video_file');
    $lottie = get_sub_field('lottie_svg');
    $button = get_sub_field('button');
    
    $parallaxLogo = get_sub_field('show_parallax_logo');
    
    $backgroundColor = get_sub_field('background_color');
    
    $checkbox = get_sub_field('checkbox');
    
    $additionalImage = get_sub_field('additional_image');
    $paddingTop = get_sub_field('paddingTop');
    $paddingBottom = get_sub_field('paddingBottom');
    $paddingTop_mobile = get_sub_field('paddingTop_mobile');
    $paddingBottom_mobile = get_sub_field('paddingBottom_mobile');
    $block_title = get_sub_field('block_title');
    
    $blockID = get_sub_field('block_id');
    $id = $blockID ? 'id="' . $blockID . '"' : '';
?>

<?php if ($content) : ?>
    <section <?php echo $id; ?>
            class="section  contentImageBlock  pt-<?php echo $paddingTop_mobile ?> pb-<?php echo $paddingBottom_mobile ?> pt-md-<?php echo $paddingTop ?> pb-md-<?php echo $paddingBottom ?> contentImageBlock--<?php echo $imagePosition; ?> contentImageBlock--<?php echo $imageLayout; ?>"
            style="background-color: <?php echo $backgroundColor; ?>">
        <div class="container <?php echo $imageLayout == 'full' ? 'container--full' : '';?>">
            <div class="row contentImageBlock__row">
                <?php if ($block_title) : ?>
                    <div class="contentImageBlock__title__mobile">
                        <h2><?php echo $block_title; ?></h2>
                    </div>
                <?php endif; ?>
                <div class="contentImageBlock__content">
                    <div class="contentImageBlock__content__inner">
                        <div class="content-block">
                            <?php if ($block_title): ?>
                                <div class="contentImageBlock__title"><h2><?php echo $block_title; ?></h2></div>
                            <?php endif; ?>
                            <?php echo $content; ?>
                            <?php if ($button) : ?>
                                <div class="contentImageBlock__btn">
                                    <a href="<?php echo esc_url($button['url']); ?>" class="button button--black"
                                       target="<?php echo $button['target'] ?: '_self'; ?>">
                                        <?php echo $button['title']; ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php if ($checkbox) : ?>
                            <img class="content-image"
                                 src="<?php echo esc_url($additionalImage['url']); ?>"
                                 alt="<?php echo esc_attr($additionalImage['alt']); ?>"/>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="contentImageBlock__image image--<?php echo $imagePosition; ?>">
                    <div class="contentImageBlock__image__inner">
                        <?php if ($imageType == 'image'): ?>
                            <?php if ($image): ?>
                                <img class="contentImageBlock__image__item" src="<?php echo esc_url($image['url']); ?>"
                                     alt="<?php echo esc_attr($image['alt']); ?>"/>
                            <?php endif; ?>
                        <?php elseif ($imageType == 'video'): ?>
                            <?php if ($video): ?>
                                <div class="videoBlock">
                                    <video loop width="100%" height="auto" class="video">
                                        <source src="<?php echo $video['url']; ?>" type="video/mp4">
                                        <?php _e('Your browser does not support the video tag.', 'ibrigu'); ?>
                                    </video>
                                </div>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if ($lottie): ?>
                                <div class="lottie" data-path="<?php echo $lottie['url']; ?>"></div>
                            <?php endif; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>
