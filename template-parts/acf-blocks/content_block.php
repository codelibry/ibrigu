<?php
$content = get_sub_field('content');
$contentMobile = get_sub_field('content_mob');

$backgroundColor = get_sub_field('background_color');
$backgroundImage = get_sub_field('background_image');

$blockID = get_sub_field('block_id');
$id = $blockID?'id="'.$blockID.'"':'';

$blockLayout = get_sub_field('block_layout');

$paddingTop = get_sub_field('paddingTop');
$paddingBottom = get_sub_field('paddingBottom');
$paddingTop_mobile = get_sub_field('paddingTop_mobile');
$paddingBottom_mobile = get_sub_field('paddingBottom_mobile');

$contentClasses = '';
if($blockLayout=='wrapped'):
    $contentClasses.= 'col-lg-8 offset-lg-2';
else:
    $contentClasses.= 'col-12';
endif;

if($content || $contentMobile):
    ?>
    <div <?php echo $id; ?> class="section contentBlock pt-<?php echo $paddingTop_mobile ?> pb-<?php echo $paddingBottom_mobile ?> pt-md-<?php echo $paddingTop ?> pb-md-<?php echo $paddingBottom ?>" style="background-color: <?php echo $backgroundColor; ?>;background-image: url(<?php echo $backgroundImage; ?>);">
        <div class="container">
            <div class="row">
                <div class="<?php echo $contentClasses?>">
                    <?php if(!$contentMobile) :?>
                        <div class="content-block content--desk">
                            <?php echo $content; ?>
                        </div>
                        <div class="content-block content--mobile">
                            <?php echo $content; ?>
                        </div>
                    <?php else :?>
                        <div class="content-block content--desk">
                            <?php echo $content; ?>
                        </div>
                        <div class="content-block content--mobile">
                            <?php echo $contentMobile; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php
endif;