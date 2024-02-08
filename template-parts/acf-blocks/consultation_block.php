<?php
    $consultationTitle = get_sub_field('consultation_title');
    $consultationText = get_sub_field('consultation_text');
    $consultationImage = get_sub_field('consultation_image');
    $consultationImageMob = get_sub_field('consultation_image_mobile');
    $consultationButton = get_sub_field('consultation_button');
    
    $backgroundColor = get_sub_field('background_color');
    $paddingTop = get_sub_field('paddingTop');
    $paddingBottom = get_sub_field('paddingBottom');
    $paddingTop_mobile = get_sub_field('paddingTop_mobile');
    $paddingBottom_mobile = get_sub_field('paddingBottom_mobile');
?>
<?php if ($consultationTitle && $consultationImage && $consultationImageMob) : ?>
    <section
            class="consultation-block <?php echo 'pt-' . $paddingTop_mobile . ' pb-' . $paddingBottom_mobile . ' pt-md-' . $paddingTop . ' pb-md-' . $paddingBottom; ?>"
            style="background-color: <?php echo $backgroundColor; ?>"
    >
        <div class="container">
            <div class="consultation-block__wrap">
                <div class="consultation-block__title">
                    <h3 class="h5 text--center fw-bold">
                        <?php echo $consultationTitle; ?>
                    </h3>
                </div>
                <?php if ($consultationText) : ?>
                    <div class="consultation-block__text text--center">
                        <?php echo $consultationText; ?>
                    </div>
                <?php endif; ?>
                <div class="consultation-block__image">
                    <?php image_acf($consultationImage); ?>
                </div>
                <div class="consultation-block__image image--mobile">
                    <?php image_acf($consultationImageMob); ?>
                </div>
                <?php if ($consultationButton) : ?>
                    <div class="consultation-block__btn">
                        <a href="<?php echo esc_url($consultationButton['url']); ?>" class="button button--black button--size--xl"
                           target="<?php echo $consultationButton['target'] ?: '_self'; ?>">
                            <?php echo $consultationButton['title']; ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>
